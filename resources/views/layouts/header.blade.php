<!--start header -->
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			{{-- <div class="search-bar flex-grow-1">
				<div class="position-relative search-bar-box">
					<input type="text" class="form-control search-control" placeholder="{{ __('mainNav.search') }}"> <span
						class="position-absolute top-50 search-show translate-middle-y"><i
							class='bx bx-search'></i></span>
					<span class="position-absolute top-50 search-close translate-middle-y"><i
							class='bx bx-x'></i></span>
				</div>
			</div> --}}
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center">
					<li class="nav-item mobile-search-icon">
						<a class="nav-link" href="#"> <i class='bx bx-search'></i>
						</a>
					</li>
					{{-- <li class="nav-item dropdown dropdown">
						<a class="nav-link language" href="#" id="" data-toggle="" aria-haspopup="true" aria-expanded="false">
							{{ Config::get('languages')[App::getLocale()] }}
						</a>	
					</li> --}}
					<li class="nav-item dropdown dropdown">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" 
							data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-planet'></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<div class="row row-cols-2 g-2 p-2">
								@foreach (Config::get('languages') as $lang => $language)							
								<a href="{{ route('lang.switch', $lang) }}"> 
									<div class="col text-center">
										<div class="app-box mx-auto"><div class="app-title">{{$language}}</div>
										</div>
										{{-- <div class="app-title">{{$language}}</div> --}}
									</div>
								</a>						
								@endforeach
							</div>
						</div>
					</li>
					<li class="nav-item dropdown dropdown-large">
						{{-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
							data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-category'></i>
						</a> --}}
						<div class="dropdown-menu dropdown-menu-end">
							<div class="row row-cols-3 g-3 p-3">
								<div class="col text-center">
									<div class="app-box mx-auto"><i class='bx bx-group'></i>
									</div>
									<div class="app-title">Teams</div>
								</div>
								<div class="col text-center">
									<div class="app-box mx-auto"><i class='bx bx-atom'></i>
									</div>
									<div class="app-title">Projects</div>
								</div>
								<div class="col text-center">
									<div class="app-box mx-auto"><i class='bx bx-shield'></i>
									</div>
									<div class="app-title">Tasks</div>
								</div>
								<div class="col text-center">
									<div class="app-box mx-auto"><i class='bx bx-notification'></i>
									</div>
									<div class="app-title">Feeds</div>
								</div>
								<div class="col text-center">
									<div class="app-box mx-auto"><i class='bx bx-file'></i>
									</div>
									<div class="app-title">Files</div>
								</div>
								<div class="col text-center">
									<div class="app-box mx-auto"><i class='bx bx-filter-alt'></i>
									</div>
									<div class="app-title">Alerts</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown dropdown-large">
						{{-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
							role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
								class="alert-count">7</span>
							<i class='bx bx-bell'></i>
						</a> --}}
						<div class="dropdown-menu dropdown-menu-end">
							<a href="javascript:;">
								<div class="msg-header">
									<p class="msg-header-title">{{ __('mainNav.notifications') }}</p>
									<p class="msg-header-clear ms-auto">Marks all as read</p>
								</div>
							</a>
							<div class="header-notifications-list">
							</div>
							<a href="javascript:;">
								<div class="text-center msg-footer">View All Notifications</div>
							</a>
						</div>
					</li>
					<li class="nav-item dropdown dropdown-large">
						{{-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
							role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
								class="alert-count">8</span>
							<i class='bx bx-comment'></i>
						</a> --}}
						<div class="dropdown-menu dropdown-menu-end">
							{{-- <a href="javascript:;">
								<div class="msg-header">
									<p class="msg-header-title">{{ __('mainNav.message') }}</p>
									<p class="msg-header-clear ms-auto">Marks all as read</p>
								</div>
							</a> --}}
							<div class="header-message-list">
							</div>
							
						</div>
					</li>
				</ul>
			</div>
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
					role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="{{ asset('assets/images/avatars/img_avatar.png') }}" class="user-img" alt="user avatar">
					<div class="user-info ps-3">
						<p class="user-name mb-0">{{ Auth::user()->name }}</p>
						<p class="designattion mb-0">{{ Auth::user()->email }}</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>{{ __('mainNav.profile') }}</span></a>
					</li>
					<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>{{ __('mainNav.settings') }}</span></a>
					</li>
					{{-- <li>
						<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
							class="dropdown-item">
							<i class='bx bx-home-circle'></i> {{ __('Dashboard') }}
						</x-responsive-nav-link>

					</li> --}}
					{{-- <li><a class="dropdown-item" href="javascript:;"><i
								class='bx bx-dollar-circle'></i><span>Earnings</span></a>
					</li>
					<li><a class="dropdown-item" href="javascript:;"><i
								class='bx bx-download'></i><span>Downloads</span></a>
					</li> --}}
					<li>
						<div class="dropdown-divider mb-0"></div>
					</li> 
					<li>

						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<button class="dropdown-item" type="submit"><i class='bx bx-log-out-circle'></i><span>{{ __('mainNav.logout') }}</span></button>
							
						</form>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>
<!--end header -->