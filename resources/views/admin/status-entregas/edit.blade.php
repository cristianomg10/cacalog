<x-app-layout>
    @section('header', 'Editar Status de Entrega')

    @section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.status-entregas.update', $statusEntrega) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $statusEntrega->nome) }}" required>
                    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="{{ route('admin.status-entregas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>
