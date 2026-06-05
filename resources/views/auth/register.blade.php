<x-guest-layout>
    <h5 class="card-title text-center mb-4">Criar sua conta</h5>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h6 class="text-muted text-uppercase small fw-bold mb-2">Dados de Acesso</h6>

        <div class="mb-3">
            <label for="name" class="form-label">Nome completo</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar senha</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <hr>
        <h6 class="text-muted text-uppercase small fw-bold mb-2">Dados da Empresa</h6>

        <div class="mb-3">
            <label for="empresa_nome" class="form-label">Nome da empresa</label>
            <input id="empresa_nome" type="text" class="form-control @error('empresa_nome') is-invalid @enderror" name="empresa_nome" value="{{ old('empresa_nome') }}" required>
            @error('empresa_nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input id="cnpj" type="text" class="form-control @error('cnpj') is-invalid @enderror" name="cnpj" value="{{ old('cnpj') }}" required placeholder="00.000.000/0000-00">
            @error('cnpj') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input id="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}" required placeholder="(49) 99999-9999">
            @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; border: none;">
                Cadastrar
            </button>
        </div>

        <p class="text-center mt-3 mb-0">
            Já tem conta? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: #ff6b35;">Entrar</a>
        </p>
    </form>
</x-guest-layout>
