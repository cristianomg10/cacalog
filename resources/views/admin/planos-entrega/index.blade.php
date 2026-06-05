<x-app-layout>
    @section('header', 'Planos de Entrega')

    @section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Listagem de Planos</h5>
            <a href="{{ route('admin.planos-entrega.create') }}" class="btn btn-primary btn-sm">Novo Plano</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Valor Mensal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($planos as $plano)
                    <tr>
                        <td>{{ $plano->nome }}</td>
                        <td>{{ $plano->descricao }}</td>
                        <td>R$ {{ number_format($plano->valor_mensal, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.planos-entrega.edit', ['planos_entrega' => $plano]) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.planos-entrega.destroy', ['planos_entrega' => $plano]) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Nenhum plano encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $planos->links() }}
        </div>
    </div>
    @endsection
</x-app-layout>
