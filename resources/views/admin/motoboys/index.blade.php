<x-app-layout>
    @section('header', 'Motoboys')

    @section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Listagem de Motoboys</h5>
            <a href="{{ route('admin.motoboys.create') }}" class="btn btn-primary btn-sm">Novo Motoboy</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($motoboys as $motoboy)
                    <tr>
                        <td>{{ $motoboy->nome }}</td>
                        <td>{{ $motoboy->cpf }}</td>
                        <td>{{ $motoboy->telefone }}</td>
                        <td>
                            <a href="{{ route('admin.motoboys.edit', $motoboy) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.motoboys.destroy', $motoboy) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Nenhum motoboy encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $motoboys->links() }}
        </div>
    </div>
    @endsection
</x-app-layout>
