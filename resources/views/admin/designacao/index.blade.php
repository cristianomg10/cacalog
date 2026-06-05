<x-app-layout>
    @section('header', 'Designação de Entregas')

    @section('content')
    @session('success')
        <div class="alert alert-success alert-dismissible fade show">{{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endsession

    @session('error')
        <div class="alert alert-danger alert-dismissible fade show">{{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endsession

    @session('warning')
        <div class="alert alert-warning alert-dismissible fade show">{{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endsession

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Mapa de Entregas</h5>
                    <span class="badge bg-warning">{{ $entregasJson->count() }} no mapa de {{ $entregas->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if($entregasJson->isEmpty())
                        <p class="text-muted text-center py-4 mb-0">
                            Nenhuma entrega com coordenadas disponíveis.
                            @if($entregas->isNotEmpty())
                                Configure a chave OpenCage em Configurações para exibir o mapa.
                            @endif
                        </p>
                    @else
                        <div id="map" style="height: 400px;"></div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Motoboys Disponíveis</h5>
                </div>
                <div class="card-body p-0">
                    @if($motoboys->isEmpty())
                        <p class="text-muted text-center py-4 mb-0">Nenhum motoboy cadastrado.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($motoboys as $motoboy)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $motoboy->nome }}
                                    <span class="badge bg-secondary rounded-pill">#{{ $motoboy->id }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-3">
                        Ao confirmar, o sistema chamará a API externa para designar motoboys,
                        alterará o status para <strong>"Saiu para entrega"</strong> e notificará
                        as empresas parceiras via callback.
                    </p>

                    <form action="{{ route('admin.designacao.designar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100"
                            {{ $entregas->isEmpty() || $motoboys->isEmpty() ? 'disabled' : '' }}>
                            <i class="bi bi-check-lg me-1"></i> Confirmar Designação
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lista de Entregas Pendentes</h5>
                    <span class="badge bg-warning">{{ $entregas->count() }} pendente(s)</span>
                </div>
                <div class="card-body p-0">
                    @if($entregas->isEmpty())
                        <p class="text-muted text-center py-4 mb-0">Nenhuma entrega pendente no momento.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Destinatário</th>
                                        <th>CEP</th>
                                        <th>Cidade</th>
                                        <th>Itens</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($entregas as $entrega)
                                        <tr>
                                            <td>{{ $entrega->id }}</td>
                                            <td>{{ $entrega->cliente->nome ?? '-' }}</td>
                                            <td>{{ $entrega->nome_destinatario }}</td>
                                            <td>{{ $entrega->cep }}</td>
                                            <td>{{ $entrega->cidade?->nome }}/{{ $entrega->cidade?->estado }}</td>
                                            <td>{{ is_array($entrega->conteudo) ? count($entrega->conteudo) . ' item(ns)' : '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($entregasJson->isNotEmpty())
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script>
        var map = L.map('map').setView([-15.7939, -47.8828], 4);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 18,
        }).addTo(map);

        var markers = L.markerClusterGroup({
            maxClusterRadius: 50,
        });

        var entregas = @json($entregasJson);

        entregas.forEach(function(e) {
            var marker = L.marker([e.lat, e.lng]);
            marker.bindPopup(
                '<strong>' + e.destinatario + '</strong><br>' +
                'Cliente: ' + e.cliente + '<br>' +
                'Endereço: ' + e.endereco + '<br>' +
                'CEP: ' + e.cep + '<br>' +
                'Cidade: ' + e.cidade
            );
            markers.addLayer(marker);
        });

        map.addLayer(markers);

        if (entregas.length > 1) {
            var group = L.featureGroup(markers.getLayers());
            map.fitBounds(group.getBounds().pad(0.1));
        }
    </script>
    @endif
    @endsection
</x-app-layout>
