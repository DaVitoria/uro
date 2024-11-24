<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class LoginController extends Controller
{
  public function __invoke(Request $request): RedirectResponse
  {
    $credentials = $request->validate([
      'email' => [
        'required',
        'email'
      ],
      'password' => ['required'],
    ], [
      'email.required' => 'O campo e-mail é obrigatório!',
      'email.email' => 'O e-mail fornecido deve ser válido!',
      'password.required' => 'O campo palavra-passe é obrigatório!'
    ]);

    if (auth()->attempt($credentials)) {
      $request->session()->regenerate();
      $user = auth()->user();

      if(is_null($user->two_factor_secret)) {
        return redirect()->route('two-factor.enable');
      }

      return redirect()->intended('/');
    }

    return back()->withErrors([
      'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ])->onlyInput('email');
  }
}
