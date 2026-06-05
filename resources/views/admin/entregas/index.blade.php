<x-app-layout>
    @section('header', 'Entregas')

    @section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.entregas.create') }}" class="btn btn-primary">
            + Nova Entrega
        </a>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Destinatário</th>
                    <th>Status</th>
                    <th>Motoboy</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entregas as $entrega)
                    <tr>
                        <td>{{ $entrega->id }}</td>
                        <td>{{ $entrega->cliente->nome ?? '-' }}</td>
                        <td>{{ $entrega->nome_destinatario ?? '-' }}</td>
                        <td>
                            @php
                                $badge = match($entrega->status->nome ?? '') {
                                    'Pendente' => 'warning',
                                    'Em Trânsito' => 'info',
                                    'Entregue' => 'success',
                                    'Cancelado' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $entrega->status->nome ?? $entrega->status_entrega_id }}</span>
                        </td>
                        <td>{{ $entrega->motoboy->nome ?? '-' }}</td>
                        <td>{{ $entrega->created_at ? $entrega->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.entregas.show', $entrega) }}" class="btn btn-sm btn-outline-info">
                                Visualizar
                            </a>
                            <a href="{{ route('admin.entregas.edit', $entrega) }}" class="btn btn-sm btn-outline-warning">
                                Editar
                            </a>
                            <form action="{{ route('admin.entregas.destroy', $entrega) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta entrega?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Nenhuma entrega encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $entregas->links() }}
    </div>
    @endsection
</x-app-layout>
