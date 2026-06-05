<x-app-layout>
    @section('header', 'Acompanhamento de Entregas')

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

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Mapa de Entregas em Andamento</h5>
                    <span class="badge bg-info">{{ $entregasJson->count() }} no mapa de {{ $entregas->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if($entregasJson->isEmpty())
                        <p class="text-muted text-center py-4 mb-0">Nenhuma entrega em andamento com coordenadas disponíveis.</p>
                    @else
                        <div id="map" style="height: 450px;"></div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Motoboys em Atividade</h5>
                </div>
                <div class="card-body p-0">
                    @if($motoboys->isEmpty())
                        <p class="text-muted text-center py-4 mb-0">Nenhum motoboy em atividade.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($motoboys as $id => $motoboy)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        @php
                                            $palette = ['#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#42d4f4', '#f032e6', '#bfef45', '#469990'];
                                            $cor = $palette[$id % count($palette)];
                                        @endphp
                                        <span class="d-inline-block rounded-circle me-2" style="width: 12px; height: 12px; background-color: {{ $cor }};"></span>
                                        {{ $motoboy['nome'] }}
                                    </span>
                                    <span class="badge bg-secondary rounded-pill">{{ $motoboy['total'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lista de Entregas em Andamento</h5>
                    <span class="badge bg-info">{{ $entregas->count() }} entrega(s)</span>
                </div>
                <div class="card-body p-0">
                    @if($entregas->isEmpty())
                        <p class="text-muted text-center py-4 mb-0">Nenhuma entrega em andamento.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Destinatário</th>
                                        <th>Motoboy</th>
                                        <th>CEP</th>
                                        <th>Cidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($entregas as $entrega)
                                        <tr>
                                            <td>{{ $entrega->id }}</td>
                                            <td>{{ $entrega->cliente->nome ?? '-' }}</td>
                                            <td>{{ $entrega->nome_destinatario }}</td>
                                            <td>
                                                @php
                                                    $palette = ['#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#42d4f4', '#f032e6', '#bfef45', '#469990'];
                                                    $cor = $palette[$entrega->motoboy_id % count($palette)];
                                                @endphp
                                                <span class="d-inline-block rounded-circle me-1" style="width: 10px; height: 10px; background-color: {{ $cor }};"></span>
                                                {{ $entrega->motoboy->nome ?? '-' }}
                                            </td>
                                            <td>{{ $entrega->cep }}</td>
                                            <td>{{ $entrega->cidade?->nome }}/{{ $entrega->cidade?->estado }}</td>
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-15.7939, -47.8828], 4);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 18,
        }).addTo(map);

        var entregas = @json($entregasJson);
        var markers = [];

        entregas.forEach(function(e) {
            var marker = L.circleMarker([e.lat, e.lng], {
                radius: 10,
                fillColor: e.cor,
                color: '#333',
                weight: 2,
                opacity: 1,
                fillOpacity: 0.8,
            });
            marker.bindPopup(
                '<strong>' + e.destinatario + '</strong><br>' +
                'Cliente: ' + e.cliente + '<br>' +
                'Motoboy: ' + e.motoboy + '<br>' +
                'Endereço: ' + e.endereco + '<br>' +
                'CEP: ' + e.cep + '<br>' +
                'Cidade: ' + e.cidade
            );
            markers.push(marker);
        });

        var group = L.featureGroup(markers);
        group.addTo(map);
        map.fitBounds(group.getBounds().pad(0.1));
    </script>
    @endif
    @endsection
</x-app-layout>
