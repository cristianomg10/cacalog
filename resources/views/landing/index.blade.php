<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CaçaLog - Sua logística em Caçador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .bg-gradient-orange {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
        }
        .bg-gradient-dark {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }
        .text-gradient-orange {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border: none;
            color: #fff;
            transition: transform .2s, box-shadow .2s;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, .4);
            color: #fff;
        }
        .btn-outline-gradient {
            background: transparent;
            border: 2px solid #ff6b35;
            color: #ff6b35;
            transition: all .2s;
        }
        .btn-outline-gradient:hover {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border-color: transparent;
            color: #fff;
        }
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,.03);
        }
        .step-card {
            border-radius: 1rem;
            transition: transform .3s, box-shadow .3s;
            border: none;
        }
        .step-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 35px rgba(0,0,0,.1);
        }
        .step-number {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.2rem;
        }
        .feature-icon {
            font-size: 2.8rem;
        }
        .plan-card {
            border: none;
            border-radius: 1rem;
            transition: transform .3s, box-shadow .3s;
        }
        .plan-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(0,0,0,.12);
        }
        .plan-card.featured {
            border: 2px solid #ff6b35;
        }
        .footer a { text-decoration: none; }
        .footer a:hover { text-decoration: underline; }
        .navbar.scrolled {
            background: rgba(26, 26, 46, .95) !important;
            backdrop-filter: blur(10px);
        }
        @media (max-width: 991.98px) {
            .hero { min-height: auto; padding: 120px 0 60px; }
            .navbar-collapse { background: rgba(26, 26, 46, .98); padding: 1rem; border-radius: .75rem; margin-top: .5rem; }
        }
    </style>
</head>
<body>

{{-- ============================================================ NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">
            <i class="bi bi-truck text-warning me-1"></i>CaçaLog
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#inicio">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#como-funciona">Como Funciona</a></li>
                <li class="nav-item"><a class="nav-link" href="#recursos">Recursos</a></li>
                <li class="nav-item"><a class="nav-link" href="#planos">Planos</a></li>
                <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
            </ul>
            <a href="{{ route('login') }}" class="btn btn-gradient rounded-pill px-4 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i>Entrar
            </a>
        </div>
    </div>
</nav>

{{-- ============================================================ HERO --}}
<section id="inicio" class="hero bg-gradient-orange text-white">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <span class="badge bg-white text-warning bg-opacity-25 text-dark mb-3 px-3 py-2 rounded-pill fw-semibold">
                    <i class="bi bi-geo-alt-fill me-1"></i>Caçador & Região
                </span>
                <h1 class="display-3 fw-bold mb-4">Sua logística em Caçador,<br><span class="text-warning">sob controle</span></h1>
                <p class="lead mb-4 fs-5 opacity-90">
                    Conectamos sua empresa aos melhores motoboys de Caçador. Entregas rápidas,
                    rastreio em tempo real e planos que cabem no seu bolso.
                </p>
                <a href="#planos" class="btn btn-lg btn-warning text-dark fw-bold rounded-pill px-5 me-3 mb-2">
                    <i class="bi bi-box-seam me-2"></i>Solicitar Entrega
                </a>
                <a href="#como-funciona" class="btn btn-lg btn-outline-light rounded-pill px-4 mb-2">
                    Saiba mais <i class="bi bi-arrow-down ms-1"></i>
                </a>
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                <i class="bi bi-truck-front" style="font-size:14rem;opacity:.15;"></i>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ COMO FUNCIONA --}}
<section id="como-funciona" class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-orange text-white px-3 py-2 rounded-pill mb-2">Como Funciona</span>
            <h2 class="display-5 fw-bold">Entregas em <span class="text-gradient-orange">4 passos</span></h2>
            <p class="text-muted fs-5 mt-2">Do pedido à confirmação, tudo simples e rápido.</p>
        </div>
        <div class="row g-4 justify-content-center">

            <div class="col-md-6 col-lg-3">
                <div class="step-card card h-100 shadow-sm p-4 text-center">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="step-number bg-gradient-orange text-white shadow">1</div>
                    </div>
                    <i class="bi bi-file-text fs-1 text-warning mb-3"></i>
                    <h5 class="fw-bold">Solicita</h5>
                    <p class="text-muted small mb-0">Registre sua entrega pelo app ou site em segundos.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="step-card card h-100 shadow-sm p-4 text-center">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="step-number bg-gradient-orange text-white shadow">2</div>
                    </div>
                    <i class="bi bi-bicycle fs-1 text-warning mb-3"></i>
                    <h5 class="fw-bold">Coleta</h5>
                    <p class="text-muted small mb-0">O motoboy mais próximo aceita e vai até você.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="step-card card h-100 shadow-sm p-4 text-center">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="step-number bg-gradient-orange text-white shadow">3</div>
                    </div>
                    <i class="bi bi-geo-alt fs-1 text-warning mb-3"></i>
                    <h5 class="fw-bold">Entrega</h5>
                    <p class="text-muted small mb-0">Acompanhe o trajeto ao vivo até o destino final.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="step-card card h-100 shadow-sm p-4 text-center">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="step-number bg-gradient-orange text-white shadow">4</div>
                    </div>
                    <i class="bi bi-check-circle fs-1 text-warning mb-3"></i>
                    <h5 class="fw-bold">Confirma</h5>
                    <p class="text-muted small mb-0">Destinatário confirma e você recebe a notificação.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================ RECURSOS --}}
<section id="recursos" class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-orange text-white px-3 py-2 rounded-pill mb-2">Recursos</span>
            <h2 class="display-5 fw-bold">Por que escolher a <span class="text-gradient-orange">CaçaLog</span>?</h2>
        </div>
        <div class="row g-4">

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-geo-alt-fill text-gradient-orange"></i>
                    </div>
                    <h5 class="fw-bold">Rastreio em Tempo Real</h5>
                    <p class="text-muted small">Acompanhe cada entrega ao vivo no mapa e saiba exatamente onde seu pedido está.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-people-fill text-gradient-orange"></i>
                    </div>
                    <h5 class="fw-bold">Motoboys Cadastrados</h5>
                    <p class="text-muted small">Rede de entregadores verificados e avaliados para garantir segurança e pontualidade.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-card-list text-gradient-orange"></i>
                    </div>
                    <h5 class="fw-bold">Planos Flexíveis</h5>
                    <p class="text-muted small">Escolha entre planos mensais ou pagamento por entrega. Sem fidelidade e sem surpresas.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================ PLANOS --}}
<section id="planos" class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-orange text-white px-3 py-2 rounded-pill mb-2">Planos</span>
            <h2 class="display-5 fw-bold">Escolha o plano <span class="text-gradient-orange">ideal</span></h2>
            <p class="text-muted fs-5 mt-2">Soluções que se adaptam ao seu volume de entregas.</p>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($planos as $plano)
                <div class="col-md-6 col-lg-4">
                    <div class="plan-card card h-100 shadow-sm p-4 text-center {{ $loop->first ? 'featured' : '' }}">
                        @if($loop->first)
                            <span class="badge bg-gradient-orange text-white position-absolute top-0 start-50 translate-middle px-3 py-2 rounded-pill">
                                <i class="bi bi-star-fill me-1"></i>Popular
                            </span>
                        @endif
                        <div class="mt-2">
                            <i class="bi bi-box-seam fs-1 text-warning"></i>
                        </div>
                        <h4 class="fw-bold mt-3">{{ $plano->nome ?? $plano['nome'] }}</h4>
                        <div class="my-3">
                            <span class="display-4 fw-bold text-gradient-orange">
                                R$ {{ number_format($plano->valor_mensal ?? $plano['valor_mensal'], 2, ',', '.') }}
                            </span>
                            <span class="text-muted">/mês</span>
                        </div>
                        <p class="text-muted">{{ $plano->descricao ?? $plano['descricao'] }}</p>
                        <a href="{{ route('login') }}" class="btn btn-gradient rounded-pill w-100 mt-auto fw-semibold">
                            Assinar Agora
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-warning rounded-pill d-inline-block px-5">
                        <i class="bi bi-info-circle me-2"></i>Nenhum plano disponível no momento.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ============================================================ CONTATO / FOOTER --}}
<section id="contato" class="bg-gradient-dark text-white">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-truck text-warning me-1"></i>CaçaLog
                </h5>
                <p class="small text-secondary">
                    Sua logística em Caçador, sob controle. Entregas rápidas e rastreio em tempo real para sua empresa.
                </p>
                <div class="d-flex gap-3 fs-5">
                    <a href="#" class="text-secondary"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 mb-4">
                <h6 class="fw-bold mb-3">Links</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#inicio" class="text-secondary">Home</a></li>
                    <li class="mb-2"><a href="#como-funciona" class="text-secondary">Como Funciona</a></li>
                    <li class="mb-2"><a href="#recursos" class="text-secondary">Recursos</a></li>
                    <li class="mb-2"><a href="#planos" class="text-secondary">Planos</a></li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <h6 class="fw-bold mb-3">Contato</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2 text-secondary"><i class="bi bi-telephone me-2"></i>(49) 99999-9999</li>
                    <li class="mb-2 text-secondary"><i class="bi bi-envelope me-2"></i>contato@cacalog.com.br</li>
                    <li class="mb-2 text-secondary"><i class="bi bi-geo-alt me-2"></i>Caçador, SC</li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <h6 class="fw-bold mb-3">Horários</h6>
                <ul class="list-unstyled small text-secondary">
                    <li class="mb-2">Seg–Sex: 08h – 20h</li>
                    <li class="mb-2">Sáb: 08h – 14h</li>
                    <li class="mb-2 text-warning"><i class="bi bi-lightning-charge me-1"></i>Plantão 24h</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <div class="text-center small text-secondary">
            &copy; {{ date('Y') }} CaçaLog. Todos os direitos reservados.
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', function () {
            nav.classList.toggle('scrolled', window.scrollY > 80);
        });
    });
</script>
</body>
</html>
