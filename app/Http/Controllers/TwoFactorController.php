<?php

namespace App\Http\Controllers;

use App\Http\Requests\TwoFactorRequest;
use App\Services\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TwoFactorController extends Controller
{
    protected $twoFactorService;

    public function __construct(TwoFactorService $twoFactorService)
    {
        $this->twoFactorService = $twoFactorService;
    }

    public function enable()
    {

        $user = Auth::user();
        $secret = $this->twoFactorService->generateSecret();

        session()->put('2fa_secret', $secret);

        $qrCode = $this->twoFactorService->generateQRCode(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('two-factor.qr', compact('qrCode', 'secret'));
    }

    public function verify(TwoFactorRequest $request)
    {
        $user = Auth::user();
        $secret = $request->session()->get('2fa_secret'); // Recupera o segredo temporário da sessão
        $code = $request->input('code');

        if ($this->twoFactorService->verifyCode($secret, $code)) {
            $user->update([
                'two_factor_secret' => encrypt($secret),
                'two_factor_enabled' => true,
            ]);
            $request->session()->forget('2fa_secret'); // Remove o segredo da sessão

            return redirect()->route('/')->with('success', '2FA habilitado com sucesso!');
        }

        return back()->withErrors(['code' => 'Código inválido.']);
    }

    public function disable()
    {
        $user = Auth::user();
        $user->update([
            'two_factor_secret' => null,
            'two_factor_enabled' => false,
        ]);

        return redirect()->route('/')->with('success', '2FA desabilitado com sucesso!');
    }
}
