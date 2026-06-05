<x-app-layout>
    @section('header', 'Cidades')

    @section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Listagem de Cidades</h5>
            <a href="{{ route('admin.cidades.create') }}" class="btn btn-primary btn-sm">Nova Cidade</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Estado (UF)</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cidades as $cidade)
                    <tr>
                        <td>{{ $cidade->nome }}</td>
                        <td>{{ $cidade->estado }}</td>
                        <td>
                            <a href="{{ route('admin.cidades.edit', $cidade) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.cidades.destroy', $cidade) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">Nenhuma cidade encontrada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $cidades->links() }}
        </div>
    </div>
    @endsection
</x-app-layout>
