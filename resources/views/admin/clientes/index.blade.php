@php
    use App\Helpers\MaskHelper;
@endphp

@extends('layouts.app')

@section('header', 'Clientes')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">
            + Novo Cliente
        </a>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ MaskHelper::cnpj($cliente->cnpj) }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ MaskHelper::telefone($cliente->telefone) }}</td>
                        <td>
                            <a href="{{ route('admin.clientes.show', $cliente) }}" class="btn btn-sm btn-outline-info">
                                Visualizar
                            </a>
                            <a href="{{ route('admin.clientes.edit', $cliente) }}" class="btn btn-sm btn-outline-warning">
                                Editar
                            </a>
                            <form action="{{ route('admin.clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Nenhum cliente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $clientes->links() }}
    </div>
@endsection
