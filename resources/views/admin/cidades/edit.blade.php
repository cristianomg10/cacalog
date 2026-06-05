<x-app-layout>
    @section('header', 'Editar Cidade')

    @section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.cidades.update', $cidade) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $cidade->nome) }}" required>
                    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado (UF)</label>
                    <input type="text" name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $cidade->estado) }}" maxlength="2" style="text-transform: uppercase;" required>
                    @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="{{ route('admin.cidades.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>
