<!-- resources/views/two-factor/enable.blade.php


<div class="container">
    <h2>Ativar Autenticação de Dois Fatores (2FA)</h2>
    <p>Ao ativar a autenticação de dois fatores, você adicionará uma camada extra de segurança à sua conta.</p>

    <p>Para continuar, clique no botão abaixo para gerar o QR Code.</p>

    <p><strong>Não consegue escanear o QR Code?</strong></p>
    <p>Insira este código manualmente no aplicativo autenticador:</p>
    <p><code>{{ $secret }}</code></p>

    <form action="{{ route('two-factor.verify') }}" method="POST">
    @csrf
    <label for="code">Código do Aplicativo</label>
    <input type="text" name="code" placeholder="Insira o código de 6 dígitos" required>
    <button type="submit">Verificar</button>
</form>
</div>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Courseplus - Professional Learning Management HTML Template">

    <!-- Favicon -->
    <link href="{{ asset('/assets/images/favicon.png') }}" rel="icon" type="image/png">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/night-mode.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/framework.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}">

    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('/assets/css/icons.css') }}">


</head>

<body>


    <!-- Content
    ================================================== -->
    <div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            @if ($errors->any())
                <div class="my-4">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="uk-card-default p-5 rounded">
                <div class="mb-4 uk-text-center">
                    <h3 class="mb-0">Autenticação de 2FA</h3>
                    <p>Ao ativar a autenticação de dois fatores, você adicionará uma camada extra de segurança à sua conta.</p>
                </div>
                <p><code>{{ $secret }}</code></p>
                <form action="{{ route('two-factor.verify') }}" method="POST">
                    @csrf

                    <div class="uk-form-group">
                        <label class="uk-form-label">Código do Aplicativo</label>

                        <div class="uk-position-relative w-100">
                            <span class="uk-form-icon">
                            <i class="icon-feather-lock"></i>
                            </span>
                            <input class="uk-input" type="text" name="code" required
                            value="{{ old('code') }}" placeholder="Insira o código de 6 dígitos">
                        </div>
                    </div>

                    <div class="mt-4 uk-flex-middle uk-grid-small" uk-grid="">
                        <div class="uk-width-auto@s">
                            <button type="submit" class="btn btn-default">Confirmar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>



    <!-- For Night mode -->
    <script>
        (function(window, document, undefined) {
            'use strict';
            if (!('localStorage' in window)) return;
            var nightMode = localStorage.getItem('gmtNightMode');
            if (nightMode) {
                document.documentElement.className += ' night-mode';
            }
        })(window, document);


        (function(window, document, undefined) {

            'use strict';

            // Feature test
            if (!('localStorage' in window)) return;

            // Get our newly insert toggle
            var nightMode = document.querySelector('#night-mode');
            if (!nightMode) return;

            // When clicked, toggle night mode on or off
            nightMode.addEventListener('click', function(event) {
                event.preventDefault();
                document.documentElement.classList.toggle('night-mode');
                if (document.documentElement.classList.contains('night-mode')) {
                    localStorage.setItem('gmtNightMode', true);
                    return;
                }
                localStorage.removeItem('gmtNightMode');
            }, false);

        })(window, document);
    </script>


    <!-- javaScripts
    ================================================== -->
    <script src="{{ asset('/assets/js/framework.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/simplebar.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>

</body>

</html>


