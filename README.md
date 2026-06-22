# CaçaLog - API de Entregas

API REST para criação de entregas por empresas parceiras.

---

## Autenticação

Token único enviado no corpo da requisição (`token`). Cada empresa parceira possui um token cadastrado no sistema.

---

## Endpoint

```
POST /api/entregas
```

### Headers

| Header | Valor |
|---|---|
| `Content-Type` | `application/json` |
| `Accept` | `application/json` |

### Corpo da Requisição

| Campo | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `token` | string | sim | Token único da empresa parceira |
| `codigo_pedido` | string | sim | Código do pedido no sistema do parceiro |
| `cep` | string | sim | CEP (com ou sem formatação, ex: 89501-000) |
| `logradouro` | string | sim | Endereço de entrega |
| `numero` | string | sim | Número do endereço |
| `complemento` | string | não | Complemento |
| `bairro` | string | sim | Bairro |
| `nome_destinatario` | string | sim | Nome de quem receberá a entrega |
| `conteudo` | array | sim | Lista de produtos |
| `conteudo[].nome` | string | sim | Nome do produto |
| `conteudo[].quantidade` | integer | sim | Quantidade |

### Exemplo de Requisição

```json
{
    "token": "at-123",
    "codigo_pedido": "PED-001",
    "cep": "89501-000",
    "logradouro": "Rodovia Comendador Primo Tedesco",
    "numero": "500",
    "complemento": "Sala 2",
    "bairro": "Bom Sucesso",
    "nome_destinatario": "Maria Silva",
    "conteudo": [
        { "nome": "Documento Fiscal", "quantidade": 2 },
        { "nome": "Contrato Social", "quantidade": 1 }
    ]
}
```

---

## Respostas

### 201 - Criada com sucesso

```json
{
    "success": true,
    "message": "Entrega criada com sucesso.",
    "data": {
        "id": 1,
        "codigo_pedido": "PED-001",
        "conteudo": [
            { "nome": "Documento Fiscal", "quantidade": 2 },
            { "nome": "Contrato Social", "quantidade": 1 }
        ],
        "status": "Pendente",
        "cidade": "Caçador",
        "uf": "SC",
        "created_at": "2026-06-05T17:57:33+00:00"
    }
}
```

### 401 - Token inválido ou ausente

```json
{
    "success": false,
    "message": "Token de autenticação inválido."
}
```

### 422 - Dados inválidos

```json
{
    "message": "O campo conteudo.0.quantidade é obrigatório.",
    "errors": {
        "conteudo.0.quantidade": [
            "O campo conteudo.0.quantidade é obrigatório."
        ]
    }
}
```

---

## Fluxo da API

1. Valida o token do parceiro
2. Valida os dados da requisição
3. Consulta o CEP na [ViaCep](https://viacep.com.br/)
4. Busca ou cria a cidade com base no CEP
5. Define o status como "Pendente"
6. Cria o registro da entrega
7. Retorna os dados criados com status 201

---

## Webhook / Callback

Sempre que o status de uma entrega é alterado (designação a motoboys ou atualização manual no acompanhamento), o sistema dispara uma requisição HTTP POST para a `url_callback` configurada no cadastro da empresa parceira.

### Requisição enviada

```
POST {url_callback}
Content-Type: application/json

{
    "codigo_pedido": "PED-001",
    "status": "Saiu para entrega"
}
```

| Campo | Tipo | Descrição |
|---|---|---|
| `codigo_pedido` | string | Código do pedido no sistema do parceiro |
| `status` | string | Novo status da entrega |

### Status possíveis

| Status | Descrição |
|---|---|
| `Pendente` | Aguardando designação |
| `Saiu para entrega` | Designado a um motoboy |
| `Em Trânsito` | Em rota de entrega |
| `Entregue` | Entregue ao destinatário |
| `Cancelado` | Cancelado |
| `Devolvido` | Devolvido ao remetente |

### Observações

- O timeout da requisição é de **10 segundos**.
- Falhas no callback **não interrompem** o fluxo principal — apenas são registradas em log.
- Se a empresa parceira não possuir `url_callback` cadastrada, o callback é ignorado silenciosamente.
