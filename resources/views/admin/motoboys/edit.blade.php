<x-app-layout>
    @section('header', 'Editar Motoboy')

    @section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.motoboys.update', $motoboy) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $motoboy->nome) }}" required>
                    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control @error('cpf') is-invalid @enderror" value="{{ old('cpf', $motoboy->cpf) }}" required>
                    @error('cpf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone', $motoboy->telefone) }}" required>
                    @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="{{ route('admin.motoboys.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>
