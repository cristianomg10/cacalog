<x-app-layout>
    @section('header', 'Editar Entrega #' . $entrega->id)

    @section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.entregas.update', $entrega) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" name="cep" id="cep" class="form-control @error('cep') is-invalid @enderror" value="{{ old('cep', $entrega->cep) }}">
                        @error('cep')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" name="logradouro" id="logradouro" class="form-control @error('logradouro') is-invalid @enderror" value="{{ old('logradouro', $entrega->logradouro) }}">
                        @error('logradouro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" name="numero" id="numero" class="form-control @error('numero') is-invalid @enderror" value="{{ old('numero', $entrega->numero) }}">
                        @error('numero')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" name="complemento" id="complemento" class="form-control @error('complemento') is-invalid @enderror" value="{{ old('complemento', $entrega->complemento) }}">
                        @error('complemento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control @error('bairro') is-invalid @enderror" value="{{ old('bairro', $entrega->bairro) }}">
                        @error('bairro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="cidade_id" class="form-label">Cidade</label>
                        <select name="cidade_id" id="cidade_id" class="form-select @error('cidade_id') is-invalid @enderror">
                            <option value="">Selecione uma cidade</option>
                            @foreach($cidades as $cidade)
                                <option value="{{ $cidade->id }}" {{ old('cidade_id', $entrega->cidade_id) == $cidade->id ? 'selected' : '' }}>
                                    {{ $cidade->nome }} / {{ $cidade->estado ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('cidade_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
                            <option value="">Selecione um cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id', $entrega->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status_entrega_id" class="form-label">Status</label>
                        <select name="status_entrega_id" id="status_entrega_id" class="form-select @error('status_entrega_id') is-invalid @enderror">
                            <option value="">Selecione um status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ old('status_entrega_id', $entrega->status_entrega_id) == $status->id ? 'selected' : '' }}>
                                    {{ $status->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_entrega_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="motoboy_id" class="form-label">Motoboy</label>
                        <select name="motoboy_id" id="motoboy_id" class="form-select @error('motoboy_id') is-invalid @enderror">
                            <option value="">Selecione um motoboy</option>
                            @foreach($motoboys as $motoboy)
                                <option value="{{ $motoboy->id }}" {{ old('motoboy_id', $entrega->motoboy_id) == $motoboy->id ? 'selected' : '' }}>
                                    {{ $motoboy->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('motoboy_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nome_destinatario" class="form-label">Nome do Destinatário</label>
                        <input type="text" name="nome_destinatario" id="nome_destinatario" class="form-control @error('nome_destinatario') is-invalid @enderror" value="{{ old('nome_destinatario', $entrega->nome_destinatario) }}">
                        @error('nome_destinatario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="codigo_pedido" class="form-label">Código do Pedido</label>
                        <input type="text" name="codigo_pedido" id="codigo_pedido" class="form-control @error('codigo_pedido') is-invalid @enderror" value="{{ old('codigo_pedido', $entrega->codigo_pedido) }}">
                        @error('codigo_pedido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="conteudo" class="form-label">Conteúdo</label>
                        <textarea name="conteudo" id="conteudo" rows="3" class="form-control @error('conteudo') is-invalid @enderror">{{ old('conteudo', is_array($entrega->conteudo) ? json_encode($entrega->conteudo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $entrega->conteudo) }}</textarea>
                        @error('conteudo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.entregas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>
