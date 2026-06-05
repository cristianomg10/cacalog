<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">Lembrar-me</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                    Esqueceu a senha?
                </a>
            @endif
            <button type="submit" class="btn" style="background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; border: none;">
                Entrar
            </button>
        </div>
    </form>

    <hr>
    <p class="text-center mb-0">
        Ainda não tem conta? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color: #ff6b35;">Cadastre-se</a>
    </p>
</x-guest-layout>
