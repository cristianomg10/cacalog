<x-app-layout>
    @section('header', 'Dashboard')

    @section('content')
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-primary border-4 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Clientes</p>
                        <h3 class="mb-0">{{ $totalClientes }}</h3>
                    </div>
                    <div class="fs-1 text-primary">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-success border-4 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Entregas</p>
                        <h3 class="mb-0">{{ $totalEntregas }}</h3>
                    </div>
                    <div class="fs-1 text-success">
                        <i class="bi bi-truck"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-info border-4 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Motoboys</p>
                        <h3 class="mb-0">{{ $totalMotoboys }}</h3>
                    </div>
                    <div class="fs-1 text-info">
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-warning border-4 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Pendentes</p>
                        <h3 class="mb-0">{{ $entregasPendentes }}</h3>
                    </div>
                    <div class="fs-1 text-warning">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Últimas Entregas</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Motoboy</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimasEntregas as $entrega)
                    <tr>
                        <td>{{ $entrega->id }}</td>
                        <td>{{ $entrega->cliente->nome ?? $entrega->cliente }}</td>
                        <td>
                            @php
                                $badge = match($entrega->status) {
                                    'Pendente' => 'warning',
                                    'Em Trânsito' => 'info',
                                    'Entregue' => 'success',
                                    'Cancelado' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $entrega->status }}</span>
                        </td>
                        <td>{{ $entrega->motoboy->nome ?? $entrega->motoboy }}</td>
                        <td>{{ $entrega->created_at instanceof \Carbon\Carbon ? $entrega->created_at->format('d/m/Y H:i') : $entrega->data }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Nenhuma entrega encontrada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endsection
</x-app-layout>
