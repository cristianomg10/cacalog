<x-app-layout>
    @section('header', 'Configurações')

    @section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.configuracoes.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="motoboy_api_url" class="form-label">URL da API de Designação de Motoboy</label>
                    <input type="url" name="motoboy_api_url" id="motoboy_api_url"
                           class="form-control @error('motoboy_api_url') is-invalid @enderror"
                           value="{{ old('motoboy_api_url', $motoboyApiUrl) }}"
                           placeholder="https://api.exemplo.com/designar-motoboy">
                    @error('motoboy_api_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Ao criar uma nova entrega, o sistema chamará esta URL para definir automaticamente qual motoboy será responsável pela entrega. Deixe em branco para não utilizar.
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>
