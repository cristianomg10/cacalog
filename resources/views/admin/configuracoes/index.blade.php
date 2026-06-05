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
                        Ao confirmar a designação, o sistema enviará as entregas pendentes para esta URL. Use <code>{numero_entregadores}</code> na URL para substituir pela quantidade de motoboys disponíveis. Deixe em branco para não utilizar.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="opencage_api_key" class="form-label">Chave da API OpenCage (Geocoding)</label>
                    <input type="text" name="opencage_api_key" id="opencage_api_key"
                           class="form-control @error('opencage_api_key') is-invalid @enderror"
                           value="{{ old('opencage_api_key', $opencageApiKey) }}"
                           placeholder="sua_chave_aqui">
                    @error('opencage_api_key')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Utilizada para converter endereços em coordenadas geográficas exibidas no mapa da tela de designação. Obtenha uma chave gratuita em opencagedata.com.
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
