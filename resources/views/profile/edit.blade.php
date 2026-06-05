<x-app-layout>
    @section('header', 'Perfil')

    @section('content')
    <div class="py-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
