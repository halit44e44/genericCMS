<x-guest-layout>

    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
                     
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    
                    <div class="col mx-auto">   
                        {{-- <nav class="navbar navbar-expand">
                            <div class="top-menu ms-auto">
                                <ul class="navbar-nav align-items-center">
                                    <li class="nav-item dropdown dropdown">
                                        <a class="nav-link language" href="#" id="" data-toggle="" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ Config::get('languages')[App::getLocale()] }}
                                        </a>
                                        @foreach (Config::get('languages') as $lang => $language)
                
                                        <a href="{{ route('lang.switch', $lang) }}">
                                            <div class="col text-center">
                                                <div class="app-box mx-auto">
                                                    <div class="app-title">{{ $language }}</div>
                                                </div>
                                                {{-- <div class="app-title">{{$language}}</div> --}}
                                            {{-- </div>
                                        </a> --}}
                
                                    {{-- @endforeach --}}
                                    {{-- </li>
                                    <li class="nav-item dropdown dropdown">
                                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"
                                            aria-expanded="false"> <i class='bx bx-globe'></i>
                                        </a>
                
                                      
                                    </li>
                                </ul>
                            </div>
                        </nav>        --}}
                        <div class="mb-4 text-center">
                            <img src="{{ asset('assets/images/Epin-api-logo.svg') }}" width="300" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 style="color:#fbfbfb">{{ __('auth.authTitle') }}</h3>
                                    </div>
                                    <div class="login-separater text-center mb-4">
                                        {{-- <span>API-CMS</span> --}}
                                        <hr />
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="col-12">
                                                <x-label for="email" :value="__('Email')" class="form-label" />
                                                <x-input id="email" class="form-control" type="email" name="email"
                                                    :value="old('email')" required autofocus />
                                            </div>
                                            <div class="col-12">
                                                <x-label class="form-label" for="password"
                                                    value="{{ __('auth.password') }}" />
                                                <x-input id="password" class="form-control border-end-0" type="password"
                                                    name="password" required autocomplete="current-password" />
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input id="remember_me" type="checkbox" class="form-check-input"
                                                        name="remember" checked>
                                                    <label class="form-check-label"
                                                        for="remember_me">{{ __('auth.remember') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end">

                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <x-button class="btn btn-light">
                                                        <i class="bx bxs-lock-open"></i>
                                                        {{ __('auth.login') }}
                                                    </x-button>
                                                </div>
                                            </div>

                                            <x-auth-session-status class="mb-4" :status="session('status')" />
                                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>

</x-guest-layout>
