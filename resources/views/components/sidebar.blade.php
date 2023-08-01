{{-- <x-sidebarPHC>

</x-sidebarPHC> --}}
<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="../../index.html">
        <img class="navbar-brand-dark" src="{{ asset('assets/img/brand/light.svg') }}" alt="Volt logo" /> <img
            class="navbar-brand-light" src="{{ asset('assets/img/brand/dark.svg') }}" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            {{ $head }}
            <x-sidebar.Toolbar />
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            {{ $slot }}
            <x-sidebar.HeaderLogo title="{{ config('app.name') }}" href="#"
                src="{{ asset('assets/img/brand/light.svg') }}" />
            <x-sidebar.sparator />
            @if (Auth::user())
                <x-sidebar.Single icons="fa-solid fa-house-user" title="Home" href="{{ route('home.index') }}"
                    currentsite="{{ Request()->is('/') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-thermometer-three-quarters fa-fw" title="Symptom"
                    href="{{ route('symptom.index') }}" currentsite="{{ Route::is('symptom.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-tasks fa-fw" title="Disease" href="{{ route('disease.index') }}"
                    currentsite="{{ Route::is('disease.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-file-import fa-fw" title="Post" href="{{ route('post.index') }}"
                    currentsite="{{ Route::is('post.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-vial fa-fw" title="Result" href="{{ route('result.index') }}"
                    currentsite="{{ Route::is('result.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-cogs fa-fw" title="Condition"
                    href="{{ route('condition.index') }}"
                    currentsite="{{ Route::is('condition.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-book-open fa-fw" title="Knowledge"
                    href="{{ route('knowledge.index') }}"
                    currentsite="{{ Route::is('knowledge.*') ? true : false }}" />
                <x-sidebar.sparator />
                <x-sidebar.Single icons="fa-solid fa-user fa-fw" title="User Admin" href="{{ route('user.index') }}"
                    currentsite="{{ Route::is('user.*') ? true : false }}" />
            @else
                <x-sidebar.Single icons="fa-solid fa-house-user" title="Home" href="{{ route('guest.home.index') }}"
                    currentsite="{{ Request()->is('/') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-thermometer-three-quarters fa-fw" title="Symptom"
                    href="{{ route('guest.symptom.index') }}"
                    currentsite="{{ Route::is('guest.symptom.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-tasks fa-fw" title="Disease"
                    href="{{ route('guest.disease.index') }}"
                    currentsite="{{ Route::is('guest.disease.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-file-import fa-fw" title="Post"
                    href="{{ route('guest.post.index') }}"
                    currentsite="{{ Route::is('guest.post.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-vial fa-fw" title="Result"
                    href="{{ route('guest.result.index') }}"
                    currentsite="{{ Route::is('guest.result.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-cogs fa-fw" title="Condition"
                    href="{{ route('guest.condition.index') }}"
                    currentsite="{{ Route::is('guest.condition.*') ? true : false }}" />
                <x-sidebar.Single icons="fa-solid fa-book-open fa-fw" title="Knowledge"
                    href="{{ route('guest.knowledge.index') }}"
                    currentsite="{{ Route::is('guest.knowledge.*') ? true : false }}" />
                <x-sidebar.sparator />
                <x-sidebar.Single icons="fa-solid fa-balance-scale fa-fw" title="Research"
                    href="{{ route('guest.diagnose.create') }}"
                    currentsite="{{ Route::is('guest.diagnose.create') ? true : false }}" />
            @endif

        </ul>
    </div>
</nav>
