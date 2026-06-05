<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CaçaLog') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family: 'Figtree', sans-serif; background: linear-gradient(135deg, #ff6b35, #f7931e); min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-4">
                    <a href="/" class="text-white text-decoration-none">
                        <h1 class="fw-bold mb-0" style="font-size: 2.5rem;">CaçaLog</h1>
                        <p class="text-white-50">Sua logística em Caçador</p>
                    </a>
                </div>
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        {{ $slot ?? '' }}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
