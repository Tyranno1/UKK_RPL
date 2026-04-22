<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.pengaduan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $rules = [
            'kategori_id'   => 'required|exists:kategori,id',
            'judul_laporan' => 'required|string|max:255',
            'isi_laporan'   => 'required|string',
            'tgl_pengaduan' => 'required|date',
            'lokasi'        => 'required|string|max:255',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $request->validate($rules);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id'       => Auth::id(),
            'kategori_id'   => $request->kategori_id,
            'judul_laporan' => $request->judul_laporan,
            'isi_laporan'   => $request->isi_laporan,
            'tgl_pengaduan' => $request->tgl_pengaduan,
            'lokasi'        => $request->lokasi,
            'foto'          => $fotoPath,
            'status'        => '0',
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function index()
    {
        $pengaduans = Pengaduan::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('siswa.pengaduan.index', compact('pengaduans'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['kategori', 'tanggapan.petugas'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        return view('siswa.pengaduan.show', compact('pengaduan'));
    }
}