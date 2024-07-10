<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Chart.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BDoctors') }} - @yield('title')</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header class="navbar navbar-dark sticky-top brand-color-1 flex-md-nowrap p-2 shadow">
            <a class="navbar-brand ms-5 col-md-3 col-lg-2 me-0 px-3 fs-2" href="/">BD<i
                    class="fa-solid fa-stethoscope"></i>ctors</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
            <div class="navbar-nav">
                <div class="nav-item text-nowrap ms-2">
                    <a class="nav-link text-light" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>
        <div class="container-fluid vh-100">
            <div class="row h-100">
                <nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block brand-color-1 navbar-dark sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            @if (Auth::user()->profile)
                                <li class="nav-item">
                                    <a class="nav-link text-white rounded-3 d-flex flex-column align-items-center {{ Route::currentRouteName() === 'admin.profiles.show' ? '' : '' }}"
                                        href="{{ route('admin.profiles.show', ['profile' => Auth::user()->profile->user_slug]) }}">
                                        {{-- immagine che mostra la photo in formato thumbnail --}}
                                        {{-- se presente photo, mostra la photo, altrimenti ne mette una di default --}}
                                        @if (Auth::user()->profile->photo)
                                            <img src="{{ asset('storage/' . Auth::user()->profile->photo) }}"
                                                alt="" class="rounded-circle mb-2 object-fit-cover" width=100
                                                height="100">
                                        @else
                                            <img src="{{ asset('img/default.png') }}" alt=""
                                                class="rounded-circle mb-2 object-fit-cover" width=100 height="100">
                                        @endif
                                        <span class="badge bg-primary rounded-pill">{{ Auth::user()->name }}</span>
                                        {{-- arriva uno sponsor --}}
                                    </a>

                                    {{-- @dd($profileSponsor[Auth::Id()-1]->end_date) --}}
                                    @if (isset($profileSponsor[Auth::Id() - 1]))
                                        @if ($profileSponsor[Auth::Id() - 1]->end_date > now())
                                            <div
                                                class="d-flex justify-content-center align-items-center position-relative mt-2">
                                                <a class="btn btn-flip btn-bd-primary text-danger {{ Route::currentRouteName() === 'admin.sponsorships.index' ? 'brand-color-2' : '' }}"
                                                    data-back="Prolunga la sponsorizzazione"
                                                    data-front="Hai attiva la Sponsorizzazione"
                                                    href="{{ route('admin.sponsorships.index', ['profile' => Auth::user()->profile->user_slug]) }}"></a>
                                            </div>
                                            <p class="text-center">Sponsorizzazione attiva fino al {{ $profileSponsor[Auth::Id() - 1]->end_date }}</p>
                                        @endif
                                    @else
                                        <div
                                            class="d-flex justify-content-center align-items-center position-relative mt-2">
                                            <a class="btn btn-flip btn-bd-primary {{ Route::currentRouteName() === 'admin.sponsorships.index' ? 'brand-color-2' : '' }}"
                                                data-back="Acquista una sponsorizzazione"
                                                data-front="Aumenta la tua visibilità"
                                                href="{{ route('admin.sponsorships.index', ['profile' => Auth::user()->profile->user_slug]) }}"></a>
                                        </div>
                                    @endif
                                    {{-- mostra un alert a seconda della visibility se 0 = nascosto --}}
                                    @if (Auth::user()->profile->visibility == 0)
                                        <div class="m-0 alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Attenzione!</strong> Il tuo profilo è nascosto.
                                            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                                        </div>
                                    @endif



                                </li>
                                <a class="btn btn-bd-primary mt-2 {{ Route::currentRouteName() === 'admin.profiles.edit' ? 'brand-color-2' : '' }}"
                                    href="{{ route('admin.profiles.edit', ['profile' => Auth::user()->profile->user_slug]) }}">
                                    <i class="fa-solid fa-user fa-lg fa-fw"></i> Modifica profilo
                                </a>
                            @endif

                            <li class="nav-item mt-2">
                                <a class="nav-link text-white rounded-3 {{ Route::currentRouteName() === 'admin.dashboard' ? 'brand-color-2' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                                </a>
                            </li>


                            {{-- condizione se presente user()->profile mostra 'modifica profile' altrimenti mostra 'crea profilo'  --}}
                            @if (Auth::user()->profile)
                                {{-- mostra il profilo di user()->profile usando admin.profiles.show --}}
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-white rounded-3 {{ Route::currentRouteName() === 'admin.profiles.index' ? 'brand-color-2' : '' }}"
                                        href="{{ route('admin.profiles.index') }}">
                                        <i class="fa-solid fa-newspaper fa-lg fa-fw"></i>I tuoi messaggi
                                    </a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-white rounded-3 {{ Route::currentRouteName() === 'admin.reviews' ? 'brand-color-2' : '' }}"
                                        href="{{ route('admin.reviews') }}">
                                        <i class="fa-solid fa-newspaper fa-lg fa-fw"></i>Recensioni ricevute
                                    </a>
                                </li>
                            @else
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-white rounded-3 {{ Route::currentRouteName() === 'admin.profiles.create' ? 'brand-color-2' : '' }}"
                                        href="{{ route('admin.profiles.create') }}">
                                        <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Crea profilo
                                    </a>
                                </li>
                            @endif
                        </ul>


                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 pt-3">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>

</html>
