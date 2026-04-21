<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekLevel
{
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (in_array($user->level, $levels)) {
            return $next($request);
        }

        if ($user->level === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        return redirect()->route('admin.dashboard');
    }
}