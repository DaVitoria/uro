<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class SSOController extends Controller
{
    // Redireciona para o GitHub
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    // Trata o retorno da autenticação
    public function handleGitHubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            // Verifica se o usuário já existe
            $user = User::where('email', $githubUser->getEmail())->first();

            if (!$user) {
                // Cria o usuário se não existir
                $user = User::create([
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'email' => $githubUser->getEmail(),
                    'github_id' => $githubUser->getId(),
                ]);
            }

            // Autentica o usuário
            Auth::login($user, true);

            return redirect()->route('/');
            Log::error('Erro ao fazer login com GitHub: '.$e->getMessage());

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Falha na autenticação GitHub');
        }
    }
}

