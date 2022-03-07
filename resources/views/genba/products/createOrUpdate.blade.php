@extends("layouts.main")

@section('style')
    <link href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
@endsection

@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ __('genbaProduct.mainTitle') }} </div>
                <div class="ps-3">
                    {{-- <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('genbaProduct.addNew') }}</li>
                        </ol>
                    </nav> --}}
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    {{-- <h5 class="card-title">{{ __('genbaProduct.addNew') }}</h5> --}}
                    <hr />

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-body mt-4">
                        <div class="row add-page">
                            <div class="col-lg-12">

                                @if (isset($genbaProducts))

                                    <form action="{{ route('genbaProducts.store', $genbaProducts->id) }}" id="form"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        {{-- @method('PUT') --}}
                                    @else

                                        <form action="{{ route('genbaProducts.store') }}" id="form" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                @endif

                                {{-- <form name="form" method="POST"
                                    class="row g-3 needs-validation" novalidate> --}}

                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputGenbaProductTitle"
                                            class="form-label"><b>{{ __('genbaProduct.mainTitle') }}</b></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="mb-2">
                                                <input type="hidden" name="id" class="form-control" id="id"
                                                    value="{{ $genbaProducts->id ?? '' }}">
                                                <label for="productID"
                                                    class="form-label">{{ __('genbaProduct.productId') }}
                                                </label>
                                                <input type="text" name="productID" class="form-control" id="productID"
                                                    value="{{ $genbaProducts->productID ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.productId') }}" required>

                                            </div>
                                           
                                            <div class="mb-2">
                                                <label for="price_sync"
                                                    class="form-label">{{ __('genbaProduct.price') }}</label>
                                                <input type="datetime-local" name="price_sync" class="form-control"
                                                    id="price_sync" value="{{ Carbon\Carbon::parse($genbaProducts->price_sync ?? '')->format('Y-m-d\TH:i:s')}}"
                                                    placeholder="{{ __('genbaProduct.price') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-2">
                                                <label for="name"
                                                    class="form-label">{{ __('genbaProduct.name') }}</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    value="{{ $genbaProducts->name ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.name') }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="sku" class="form-label">{{ __('genbaProduct.sku') }}</label>
                                                <input type="text" name="sku" class="form-control" id="sku"
                                                    value="{{ $genbaProducts->sku ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.sku') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="isBundle"
                                                    class="form-label">{{ __('genbaProduct.isBundle') }}
                                                </label>
                                                <input type="text" name="isBundle" class="form-control" id="isBundle"
                                                    value="{{ $genbaProducts->isBundle ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.isBundle') }}">
                                            </div>
                                            <div class="mb-2">
                                                <label for="regionCode"
                                                    class="form-label">{{ __('genbaProduct.regionCode') }}</label>
                                                <input type="text" name="regionCode" class="form-control" id="regionCode"
                                                    value="{{ $genbaProducts->regionCode ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.regionCode') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="tr_price"
                                                    class="form-label">{{ __('genbaProduct.priceTr') }}</label>
                                                <input type="text" name="tr_price" class="form-control" id="tr_price"
                                                    value="{{ $genbaProducts->tr_price ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.priceTr') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="en_price"
                                                    class="form-label">{{ __('genbaProduct.priceEn') }}</label>
                                                <input type="text" name="en_price" class="form-control" id="en_price"
                                                    value="{{ $genbaProducts->en_price ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.priceEn') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="eur_price"
                                                    class="form-label">{{ __('genbaProduct.priceEur') }}</label>
                                                <input type="text" name="eur_price" class="form-control" id="eur_price"
                                                    value="{{ $genbaProducts->eur_price ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.priceEur') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="details_sync"
                                                    class="form-label">{{ __('genbaProduct.details') }}</label>
                                                <input type="datetime-local" name="details_sync"  class="form-control"
                                                    value="{{ Carbon\Carbon::parse($genbaProducts->details_sync ?? '')->format('Y-m-d\TH:i:s')}}" id="details_sync"
                                                    placeholder="{{ __('genbaProduct.details') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="status"
                                                    class="form-label">{{ __('genbaProduct.status') }}</label>  
                                                <input type="text" name="status" class="form-control" id="status"
                                                    value="{{ $genbaProducts->status ?? '' }}"
                                                    placeholder="{{ __('genbaProduct.status') }}" required>

                                            </div>
                                            <div class="d-grid" style="margin-top: 45px">
                                                <button type="submit" class="btn btn-light" id="btnSubmit"
                                                    name="btnSubmit">{{ __('genbaProduct.btnSave') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>


@endsection
