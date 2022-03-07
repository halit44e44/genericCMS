<x-guest-layout>
    <!--wrapper-->
	<div class="wrapper">
		<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">
						<div class="my-4 text-center">
							<img src="{{ asset('assets/images/logo-img.png') }}" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign Up</h3>
										<p>Already have an account? <a href="{{ url('authentication-signin') }}">Sign in here</a>
										</p>
									</div>
									<div class="d-grid">
										<a class="btn my-4 shadow-sm btn-light" href="javascript:;"> 
                                            <span class="d-flex justify-content-center align-items-center">
                                                <img class="me-2" src="{{ asset('assets/images/icons/search.svg') }}" width="16" alt="Image Description">
                                                <span>Sign Up with Google</span>
											</span>
										</a> <a href="javascript:;" class="btn btn-light"><i class="bx bxl-facebook"></i>Sign Up with Facebook</a>
									</div>
									<div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
										<hr/>
									</div>
									<div class="form-body">


                                        
										<form class="row g-3" method="POST" action="{{ route('register') }}">
                                            @csrf

											<div class="col-sm-6">
                                                <x-label for="name" :value="__('Name')" class="form-label" />
                                
                                                <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
											</div>

											<div class="col-sm-6">
												<label for="inputLastName" class="form-label">Last Name</label>
												<input type="email" class="form-control" id="inputLastName" placeholder="Deo" disabled>
											</div>

											<div class="col-12">
                                                <x-label for="email" :value="__('Email')" class="form-label"/>
                                                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
											</div>

											<div class="col-12">
                                                <x-label for="password" :value="__('Password')" class="form-label" />
                                
                                                <x-input id="password" class="form-control border-end-0"
                                                                type="password"
                                                                name="password"
                                                                required autocomplete="new-password" />
											</div>
                                            <div class="col-12">
                                                <x-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
                                
                                                <x-input id="password_confirmation" class="form-control border-end-0"
                                                                type="password"
                                                                name="password_confirmation" />
											</div>
                                            <!--
											<div class="col-12">
												<label for="inputSelectCountry" class="form-label">Country</label>
												<select class="form-select" id="inputSelectCountry" aria-label="Default select example">
													<option selected>India</option>
													<option value="1">United Kingdom</option>
													<option value="2">America</option>
													<option value="3">Dubai</option>
												</select>
											</div>
											<div class="col-12">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
													<label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
												</div>
											</div>
                                            -->
											<div class="col-12">
												<div class="d-grid">
                                                    <x-button class="btn btn-light">
                                                        <i class='bx bx-user'></i>
                                                        {{ __('Register') }}
                                                    </x-button>
												</div>
											</div>
										</form>
									</div>
                                    <br />
                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
</x-guest-layout>
