
<?php
namespace App\Providers;

use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\Facades\Auth;

class CustomLoginResponse implements LoginResponse
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if ($user->hasRole('admin igd')) {
            return redirect()->intended('/admin/pasien');
        }

        if ($user->hasRole('admin rawat inap')) {
            return redirect()->intended('/admin/kamar');
        }

        return redirect()->intended('/admin');
    }
}