<x-app-layout>
    @section('header', 'Entrega #' . $entrega->id)

    @section('content')
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Endereço de Entrega</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Logradouro</dt>
                        <dd class="col-sm-8">{{ $entrega->logradouro ?? '-' }}</dd>

                        <dt class="col-sm-4">Número</dt>
                        <dd class="col-sm-8">{{ $entrega->numero ?? '-' }}</dd>

                        <dt class="col-sm-4">Complemento</dt>
                        <dd class="col-sm-8">{{ $entrega->complemento ?? '-' }}</dd>

                        <dt class="col-sm-4">Bairro</dt>
                        <dd class="col-sm-8">{{ $entrega->bairro ?? '-' }}</dd>

                        <dt class="col-sm-4">CEP</dt>
                        <dd class="col-sm-8">{{ $entrega->cep ?? '-' }}</dd>

                        <dt class="col-sm-4">Cidade</dt>
                        <dd class="col-sm-8">{{ $entrega->cidade->nome ?? '-' }} / {{ $entrega->cidade->estado ?? '' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informações da Entrega</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Conteúdo</dt>
                        <dd class="col-sm-8">
                            @if(is_array($entrega->conteudo))
                                <ul class="list-unstyled mb-0">
                                    @foreach($entrega->conteudo as $item)
                                        <li>{{ $item['nome'] ?? '' }} (x{{ $item['quantidade'] ?? 1 }})</li>
                                    @endforeach
                                </ul>
                            @else
                                {{ $entrega->conteudo ?? '-' }}
                            @endif
                        </dd>

                        <dt class="col-sm-4">Destinatário</dt>
                        <dd class="col-sm-8">{{ $entrega->nome_destinatario ?? '-' }}</dd>

                        <dt class="col-sm-4">Cód. Pedido</dt>
                        <dd class="col-sm-8">{{ $entrega->codigo_pedido ?? '-' }}</dd>

                        <dt class="col-sm-4">Cliente</dt>
                        <dd class="col-sm-8">{{ $entrega->cliente->nome ?? '-' }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
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
                        </dd>

                        <dt class="col-sm-4">Motoboy</dt>
                        <dd class="col-sm-8">{{ $entrega->motoboy->nome ?? '-' }}</dd>

                        <dt class="col-sm-4">Data</dt>
                        <dd class="col-sm-8">{{ $entrega->created_at ? $entrega->created_at->format('d/m/Y H:i') : '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.entregas.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
    @endsection
</x-app-layout>
