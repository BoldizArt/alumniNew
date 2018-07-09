<nav class="navbar navbar-expand-lg navbar-light navbar-alumni bg-light fixed-top nav-on">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('alumni.name', 'Alumni') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item {{ (\Request::route()->getName() == 'public.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('public.index') }}">Naši studenti</a>
                </li>
                <li class="nav-item {{ (\Request::route()->getName() == 'public.news') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('public.news') }}">Događaji</a>
                </li>
                <li class="nav-item {{ (\Request::route()->getName() == 'public.contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('public.contact') }}">Kontakt</a>
                </li>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('user.show') }}"><i class="fas fa-user"></i> {{ __('Moj profil') }}</a>
                            @if(Auth::user()->role)
                                <a class="dropdown-item" href="{{ route('admin.create') }}">
                                    <i class="fas fa-user-plus"></i> {{ __('Dodaj profil') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    <i class="fas fa-users"></i> {{ __('Novi profili') }}
                                    @if($newProfiles)
                                        <span class="badge badge-pill badge-dark">{{ $newProfiles }}</span>
                                    @endif
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.created') }}">
                                    <i class="fas fa-users"></i> {{ __('Kreirani profili') }}
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Odjava') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>