<x-app-layout>
    @section('header', 'Novo Plano de Entrega')

    @section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.planos-entrega.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" required>
                    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="3" required>{{ old('descricao') }}</textarea>
                    @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="valor_mensal" class="form-label">Valor Mensal (R$)</label>
                    <input type="number" name="valor_mensal" id="valor_mensal" class="form-control @error('valor_mensal') is-invalid @enderror" value="{{ old('valor_mensal') }}" step="0.01" required>
                    @error('valor_mensal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('admin.planos-entrega.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>
