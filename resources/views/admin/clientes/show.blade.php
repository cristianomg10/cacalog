@extends('layouts.app')

@section('header', 'Detalhes do Cliente')

@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $cliente->nome }}</h5>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9">{{ $cliente->nome }}</dd>

                <dt class="col-sm-3">CNPJ</dt>
                <dd class="col-sm-9">{{ $cliente->cnpj }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $cliente->email }}</dd>

                <dt class="col-sm-3">Telefone</dt>
                <dd class="col-sm-9">{{ $cliente->telefone }}</dd>

                <dt class="col-sm-3">URL de Callback</dt>
                <dd class="col-sm-9">{{ $cliente->url_callback ?? '-' }}</dd>

                <dt class="col-sm-3">Token de Autenticação</dt>
                <dd class="col-sm-9">
                    <code>{{ $cliente->token_autenticacao ?? '-' }}</code>
                </dd>

                <dt class="col-sm-3">Senha</dt>
                <dd class="col-sm-9">••••••••</dd>
            </dl>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Planos Vinculados</h5>
        </div>
        <div class="card-body">
            @if($cliente->planos->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Plano</th>
                                <th>Data Início</th>
                                <th>Data Fim</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cliente->planos as $plano)
                                <tr>
                                    <td>{{ $plano->nome }}</td>
                                    <td>{{ $plano->pivot->data_inicio ? \Carbon\Carbon::parse($plano->pivot->data_inicio)->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $plano->pivot->data_fim ? \Carbon\Carbon::parse($plano->pivot->data_fim)->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.clientes.planos.desvincular', [$cliente, $plano]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja desvincular este plano?')">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Desvincular</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">Nenhum plano vinculado.</p>
            @endif

            <hr>

            <h6>Vincular Novo Plano</h6>
            <form action="{{ route('admin.clientes.planos.vincular', $cliente) }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-4">
                    <label for="plano_id" class="form-label">Plano</label>
                    <select name="plano_id" id="plano_id" class="form-select @error('plano_id') is-invalid @enderror" required>
                        <option value="">Selecione...</option>
                        @foreach($planosDisponiveis as $plano)
                            <option value="{{ $plano->id }}" {{ old('plano_id') == $plano->id ? 'selected' : '' }}>{{ $plano->nome }}</option>
                        @endforeach
                    </select>
                    @error('plano_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="data_inicio" class="form-label">Data Início</label>
                    <input type="date" name="data_inicio" id="data_inicio" class="form-control @error('data_inicio') is-invalid @enderror" value="{{ old('data_inicio') }}">
                    @error('data_inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="data_fim" class="form-label">Data Fim</label>
                    <input type="date" name="data_fim" id="data_fim" class="form-control @error('data_fim') is-invalid @enderror" value="{{ old('data_fim') }}">
                    @error('data_fim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Vincular</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Entregas</h5>
        </div>
        <div class="card-body">
            @if($cliente->entregas->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cliente->entregas as $entrega)
                                <tr>
                                    <td>{{ $entrega->id }}</td>
                                    <td>{{ $entrega->descricao ?? '-' }}</td>
                                    <td>{{ $entrega->status ?? '-' }}</td>
                                    <td>{{ $entrega->created_at ? $entrega->created_at->format('d/m/Y') : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">Nenhuma entrega encontrada.</p>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
