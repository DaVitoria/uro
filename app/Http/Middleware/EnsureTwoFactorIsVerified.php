<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $user = Auth::user();

      // Verifica se o 2FA está habilitado e ainda não foi verificado
      if ($user && $user->two_factor_enabled && !$request->session()->get('2fa_verified')) {
          return redirect()->route('two-factor.verify');
      }
        return $next($request);
    }
}
