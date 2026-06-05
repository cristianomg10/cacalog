<div class="sidebar border-end col-md-3 col-lg-2 p-0 bg-white" style="min-height: calc(100vh - 56px);">
    <div class="d-flex flex-column p-3">
        <h6 class="text-muted text-uppercase small fw-bold mb-3">Administração</h6>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-dark' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.clientes.index') }}" class="nav-link {{ request()->routeIs('admin.clientes.*') ? 'active' : 'text-dark' }}">
                    <i class="bi bi-building me-2"></i> Clientes
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.planos-entrega.index') }}" class="nav-link {{ request()->routeIs('admin.planos-entrega.*') ? 'active' : 'text-dark' }}">
                    <i class="bi bi-box me-2"></i> Planos de Entrega
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.status-entregas.index') }}" class="nav-link {{ request()->routeIs('admin.status-entregas.*') ? 'active' : 'text-dark' }}">
                    <i class="bi bi-tag me-2"></i> Status de Entrega
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.cidades.index') }}" class="nav-link {{ request()->routeIs('admin.cidades.*') ? 'active' : 'text-dark' }}">
                    <i class="bi bi-geo-alt me-2"></i> Cidades
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.motoboys.index') }}" class="nav-link {{ request()->routeIs('admin.motoboys.*') ? 'active' : 'text-dark' }}">
                    <i class="bi bi-person-badge me-2"></i> Motoboys
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.entregas.index') }}" class="nav-link {{ request()->routeIs('admin.entregas.*') ? 'active' : 'text-dark' }}">
                    <i class="bi bi-truck me-2"></i> Entregas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.configuracoes.index') }}" class="nav-link {{ request()->routeIs('admin.configuracoes.*') ? 'active' : 'text-dark' }}">
                    <i class="bi bi-gear me-2"></i> Configurações
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .sidebar .nav-pills .nav-link {
        border-radius: 0.5rem;
        margin-bottom: 0.25rem;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
    .sidebar .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        color: white !important;
    }
    .sidebar .nav-pills .nav-link:hover:not(.active) {
        background-color: #f8f9fa;
    }
</style>
