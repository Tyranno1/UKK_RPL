<?php
namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['user', 'kategori', 'tanggapan'])->latest();
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul_laporan', 'like', "%$search%")
                  ->orWhereRaw("DATE_FORMAT(tgl_pengaduan, '%b') LIKE ?", ["%$search%"])
                  ->orWhereRaw("DATE_FORMAT(tgl_pengaduan, '%M') LIKE ?", ["%$search%"])
                  ->orWhereRaw("DATE_FORMAT(tgl_pengaduan, '%d %b %Y') LIKE ?", ["%$search%"])
                  
                  ->orWhere('id', 'like', "%$search%")
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$search%"))
                  ->orWhereHas('kategori', fn($q) => $q->where('nama_kategori', 'like', "%$search%"));
            });
        }

        $pengaduans       = $query->paginate(10)->withQueryString();
        $statusFilter     = $request->status ?? 'semua';
        $searchQuery      = $request->search ?? '';
        $total            = Pengaduan::count();
        $menunggu         = Pengaduan::where('status', '0')->count();
        $diproses         = Pengaduan::where('status', '1')->count();
        $selesai          = Pengaduan::where('status', '2')->count();
        $ditolak          = Pengaduan::where('status', '3')->count();
        $selesaiCount     = Pengaduan::where('status', '2')->count();
        $totalAktif = Pengaduan::whereIn('status', ['0', '1', '2'])->count();
        $persenDitanggapi = $totalAktif > 0 ? (int) round(($selesaiCount / $totalAktif) * 100) : 0;
        $ditanggapi       = $selesaiCount;
        $belumDitanggapi  = $total - $selesaiCount;

        return view('admin.dashboard', compact(
            'pengaduans', 'total', 'menunggu', 'diproses', 'selesai', 'ditolak',
            'ditanggapi', 'belumDitanggapi', 'persenDitanggapi', 'totalAktif',
            'statusFilter', 'searchQuery'
        ));
    }

    public function pengaduanIndex(Request $request)
    {
        $query = Pengaduan::with(['user', 'kategori', 'tanggapan'])->latest();
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul_laporan', 'like', "%$search%")
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$search%"))
                  ->orWhereHas('kategori', fn($q) => $q->where('nama_kategori', 'like', "%$search%"));
            });
        }

        $pengaduans   = $query->paginate(10)->withQueryString();
        $statusFilter = $request->status ?? 'semua';
        $searchQuery  = $request->search ?? '';

        return view('admin.pengaduan.index', compact('pengaduans', 'statusFilter', 'searchQuery'));
    }

    public function pengaduanShow($id)
    {
        $pengaduan = Pengaduan::with(['user', 'kategori', 'tanggapan.petugas'])->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function tanggapanStore(Request $request, $id)
    {
        $request->validate(['tanggapan' => 'required|string']);
        $pengaduan = Pengaduan::findOrFail($id);
        Tanggapan::create([
            'pengaduan_id'  => $pengaduan->id,
            'user_id'       => Auth::id(),
            'tgl_tanggapan' => now()->toDateString(),
            'tanggapan'     => $request->tanggapan,
        ]);

        $pengaduan->update([
            'status'       => '1',
            'processed_at' => now(), 
        ]);

        return redirect()->route('admin.pengaduan.show', $id)
            ->with('success', 'Tanggapan berhasil dikirim.');
    }

    public function tanggapanUpdate(Request $request, $id)
    {
        $request->validate(['tanggapan' => 'required|string']);
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status == '2') {
            return back()->with('error', 'Tanggapan tidak bisa diedit, pengaduan sudah selesai.');
        }

        $pengaduan->tanggapan->update([
            'tanggapan'     => $request->tanggapan,
            'tgl_tanggapan' => now()->toDateString(),
        ]);

        return redirect()->route('admin.pengaduan.show', $id)
            ->with('success', 'Tanggapan berhasil diperbarui.');
    }

    public function selesai($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if (!$pengaduan->tanggapan) {
            return back()->with('error', 'Berikan tanggapan terlebih dahulu.');
        }

        $pengaduan->update([
            'status'       => '2',
            'completed_at' => now(),
        ]);

        return redirect()->route('admin.pengaduan.show', $id)
            ->with('success', 'Pengaduan ditandai Selesai.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate(['alasan_tolak' => 'required|string']);
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->tanggapan) {
            $pengaduan->tanggapan->update([
                'tanggapan'     => '[DITOLAK] ' . $request->alasan_tolak,
                'tgl_tanggapan' => now()->toDateString(),
            ]);
        } else {
            Tanggapan::create([
                'pengaduan_id'  => $pengaduan->id,
                'user_id'       => Auth::id(),
                'tgl_tanggapan' => now()->toDateString(),
                'tanggapan'     => '[DITOLAK] ' . $request->alasan_tolak,
            ]);
        }

        $pengaduan->update([
            'status'      => '3',
            'rejected_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Pengaduan berhasil ditolak.');
    }

    public function penggunaIndex(Request $request)
    {
        $query = User::latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('nis_nip', 'like', "%$search%") 
                  ->orWhere('kelas', 'like', "%$search%");
            });
        }

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $users       = $query->paginate(10)->withQueryString();
        $levelFilter = $request->level ?? 'semua';
        $searchQuery = $request->search ?? '';
        $totalSiswa  = User::where('level', 'siswa')->count();
        $totalAdmin  = User::where('level', 'admin')->count();
        $totalSemua  = $totalSiswa + $totalAdmin;

        return view('admin.pengguna.index', compact('users', 'levelFilter', 'searchQuery', 'totalSiswa', 'totalAdmin', 'totalSemua'));
    }

    public function penggunaCreate()
    {
        return view('admin.pengguna.create');
    }

    public function penggunaStore(Request $request)
    {
        $request->validate([
            'nis_nip'  => 'required|string|max:20|unique:users,nis_nip',
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email|unique:users,email',
            'kelas'    => 'nullable|string|max:255',
            'telp'     => 'nullable|string|max:15',
            'level'    => 'required|in:siswa,admin',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ], [
            'password.regex' => 'Password harus mengandung huruf kapital, huruf kecil, angka, dan simbol.',
        ]);

        User::create([
            'nis_nip'  => $request->nis_nip,
            'name'     => $request->name,
            'email'    => $request->email,
            'kelas'    => $request->kelas,
            'telp'     => $request->telp,
            'level'    => $request->level,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function penggunaEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('user'));
    }

    public function penggunaUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'nis_nip'  => 'nullable|string|max:20|unique:users,nis_nip,'. $id,
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email|unique:users,email,'. $id,
            'kelas'    => 'nullable|string|max:255',
            'telp'     => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
        ], [
            'password.regex' => 'Password harus mengandung huruf kapital, huruf kecil, angka, dan simbol.',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'telp'  => $request->telp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function penggunaDestroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        $user->delete();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}