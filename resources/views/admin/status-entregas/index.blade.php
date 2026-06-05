<x-app-layout>
    @section('header', 'Status de Entrega')

    @section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Listagem de Status</h5>
            <a href="{{ route('admin.status-entregas.create') }}" class="btn btn-primary btn-sm">Novo Status</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statuses as $status)
                    <tr>
                        <td>{{ $status->nome }}</td>
                        <td>
                            <a href="{{ route('admin.status-entregas.edit', $status) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.status-entregas.destroy', $status) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted py-4">Nenhum status encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $statuses->links() }}
        </div>
    </div>
    @endsection
</x-app-layout>
