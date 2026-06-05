<x-app-layout>
    @section('header', 'Dashboard')

    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h5 class="card-title">Bem-vindo, {{ Auth::user()->name }}!</h5>
                    <p class="card-text text-muted">Você está logado no sistema CaçaLog.</p>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
