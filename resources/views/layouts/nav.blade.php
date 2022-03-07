<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<a href="{{ url('/') }}">
				<img src="{{ asset('assets/images/Epin-api-logo.svg') }}" style="width: 150px">

			</a>
		</div>
		{{-- <div>
					<h4 class="logo-text">EPİN APİ</h4>
				</div> --}}
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu mm-show" id="menu">
		<li>
			<a href="{{ url('/') }}">
				<div class="parent-icon"><i class='bx bx-home-circle'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.home') }}</div>
			</a>
		</li>


		<li class="menu-label">{{ __('mainNav.dataManagment') }}</li>
		<li>
			<a href="{{ url('/categories') }}">
				<div class="parent-icon"><i class='bx bx-grid'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.categories') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/epinProducts') }}">
				<div class="parent-icon"><i class='bx bx-layer'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.products') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/epinStocks') }}">
				<div class="parent-icon"><i class='bx bx-barcode-reader'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.epinStocks') }}</div>
			</a>
		</li>
	
		<li>
			<a href="{{ url('/companies') }}">
				<div class="parent-icon"><i class='bx bx-unlink'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.companies') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/suppliers') }}">
				<div class="parent-icon"><i class='bx bx-chevrons-down'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.suppliers') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/platforms') }}">
				<div class="parent-icon"><i class='bx bx-trim'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.platforms') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/genres') }}">
				<div class="parent-icon"><i class='bx bx-poll'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.genres') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/genbaProducts') }}">
				<div class="parent-icon"><i class='bx bx-world'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.genbaProducts') }}</div>
			</a>
		</li>	
		<li>
			<a href="{{ url('/genbaOrderLogsShred') }}">
				<div class="parent-icon"><i class='bx bx-list-minus'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.genbaOrderLogsShred') }}</div>
			</a>
		</li>
		{{-- <li>
					<a href="{{ url('/companiesProduct') }}">
		<div class="parent-icon"><i class='bx bx-unlink'></i>
		</div>
		<div class="menu-title">{{ __('mainNav.companiesProduct') }}</div>
		</a>
		</li> --}}
		
		
		
		
		<li>
			<a href="{{ url('/razerProducts') }}">
				<div class="parent-icon"><i class='bx bx-joystick-alt'></i></div>
					<div class="menu-title">{{ __('mainNav.razer') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/epayProducts') }}">
				<div class="parent-icon"><i class='bx bx-disc'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.epay') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/transactions') }}">
				<div class="parent-icon"><i class='bx bx-transfer'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.transactions') }}</div>
			</a>
		</li>

		<li>
			<a href="{{ url('/accountActivities') }}">
				<div class="parent-icon"><i class='bx bx-calculator'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.accountActivities') }}</div>
			</a>
		</li>
		<li class="menu-label">{{ __('mainNav.reportsManagment') }}</li>
		<li>
			<a href="{{ url('/orders') }}">
				<div class="parent-icon"><i class='bx bx-cart'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.orders') }}</div>
			</a>
		</li>
		<li class="menu-label">{{ __('mainNav.settings') }}</li>
		<li>
			<a href="{{ url('/users') }}">
				<div class="parent-icon"><i class='bx bx-user'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.users') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/roles') }}">
				<div class="parent-icon"><i class='bx bx-cog'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.roles') }}</div>
			</a>
		</li>
		<li>
			<a href="{{ url('/permission') }}">
				<div class="parent-icon"><i class='bx bx-bug'></i>
				</div>
				<div class="menu-title">{{ __('mainNav.permissions') }}</div>
			</a>
		</li>


	</ul>
	<!--end navigation-->
</div>
<!--end sidebar wrapper -->