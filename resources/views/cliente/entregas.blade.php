<x-app-layout>
    @section('header', 'Minhas Entregas')

    @section('content')
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Minhas Entregas</h5>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ url()->current() }}" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar por código, destinatário ou conteúdo..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                            @if(request('search'))
                                <a href="{{ url()->current() }}" class="btn btn-outline-danger">Limpar</a>
                            @endif
                        </div>
                    </form>

                    @if($entregas->isEmpty())
                        <div class="alert alert-info mb-0" role="alert">
                            Nenhuma entrega encontrada.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Código Pedido</th>
                                        <th>Destinatário</th>
                                        <th>Conteúdo</th>
                                        <th>Endereço</th>
                                        <th>Cidade</th>
                                        <th>Status</th>
                                        <th>Motoboy</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($entregas as $entrega)
                                        <tr>
                                            <td>{{ $entrega->codigo_pedido ?? $entrega->id }}</td>
                                            <td>{{ $entrega->destinatario }}</td>
                                            <td>{{ $entrega->conteudo }}</td>
                                            <td>
                                                {{ $entrega->logradouro }}, {{ $entrega->numero }}@if($entrega->bairro) - {{ $entrega->bairro }}@endif
                                            </td>
                                            <td>{{ $entrega->cidade->nome ?? $entrega->cidade }}</td>
                                            <td>
                                                @php
                                                    $statusColors = [
                                                        'Pendente' => 'warning',
                                                        'Em Trânsito' => 'info',
                                                        'Entregue' => 'success',
                                                        'Cancelado' => 'danger',
                                                        'Devolvido' => 'secondary',
                                                    ];
                                                    $status = $entrega->status->nome ?? $entrega->status;
                                                    $color = $statusColors[$status] ?? 'secondary';
                                                @endphp
                                                <span class="badge bg-{{ $color }}">{{ $status }}</span>
                                            </td>
                                            <td>{{ $entrega->motoboy->nome ?? $entrega->motoboy ?? '—' }}</td>
                                            <td>{{ $entrega->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 d-flex justify-content-center">
                            {{ $entregas->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
