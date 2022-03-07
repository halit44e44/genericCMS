@extends("layouts.main")

<div class="error-404 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="card py-5">
            <div class="row g-0">
                <div class="col col-xl-5">
                    <div class="card-body p-4">
                        <h1 class="display-1"><span class="text-white">4</span><span class="text-white">0</span><span class="text-white">4</span></h1>
                        <h2 class="font-weight-bold display-4">Lost in Space</h2>
                        <p>You have reached the edge of the universe.
                            <br>The page you requested could not be found.
                            <br>Dont'worry and return to the previous page.</p>
                        <div class="mt-5"> <a href="/" class="btn btn-light btn-lg px-md-5 radius-30">Go Home</a>
                            {{-- <a href="javascript:;" class="btn btn-light btn-lg ms-3 px-md-5 radius-30">Back</a> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-7">
                    <img src="{{ asset('assets/images/404-error.png') }}">
                </div> --}}
            </div>
            <!--end row-->
        </div>
    </div>
</div>