@extends("layouts.main")

@section('style')
    <link href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
    <style>
        .select2-results__option.select2-results__option--selectable {
            background: #242b33;
        }
        .select2-dropdown.select2-dropdown--below {
            border: none;
        }
        .select2-results__option--selected{
            background-color: #11161b!important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background-color: #485563!important;
        }
        
    </style>
@endsection

@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ __('epinStocks.mainTitle') }} </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">{{ __('epinStocks.addNew') }}</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">{{ __('epinStocks.addNew') }}</h5>
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

                                @if (isset($epinStocks))

                                    <form action="{{ route('epinStocks.store', $epinStocks->id) }}" id="form"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        {{-- @method('PUT') --}}
                                    @else

                                        <form action="{{ route('epinStocks.store') }}" id="form" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                @endif

                                {{-- <form name="form" method="POST"
                                    class="row g-3 needs-validation" novalidate> --}}

                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputepinStockstTitle"
                                            class="form-label"><b>{{ __('epinStocks.mainTitle') }}</b></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="mb-2">
                                                <label for="epinProducts"
                                                    class="form-label">{{ __('epinStocks.epinProducts') }}</label><br>

                                                <select class="js-example-basic-multiple form-control" id="epinProducts"
                                                    name="epinProducts[]" multiple="multiple">
                                                    @foreach ($products as $productId => $productTitle)
                                                        <option value="{{ $productId }}">{{ $productTitle }}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label for="price"
                                                    class="form-label">{{ __('epinStocks.price') }}</label>
                                                <input type="text" name="price" class="form-control" id="price"
                                                    value="{{ $epinStocks->price ?? '' }}"
                                                    placeholder="{{ __('epinStocks.price') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="code" class="form-label">{{ __('epinStocks.epin') }}</label>
                                                <textarea class="form-control" rows="4" , cols="58" id="code" name="code"
                                                    style="resize:none, "></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                            <div class="mb-2">
                                                <label for="epinEntities"
                                                    class="form-label">{{ __('epinStocks.epinEntities') }}</label><br>
                                                <select class="js-example-basic-multiple form-control form-control" name="epinEntities[]" id="epinEntities" multiple="multiple">
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label for="supplier_id"
                                                    class="form-label">{{ __('epinStocks.supplier') }}</label>
                                                    <select class="form-control" name="supplier_id" id="supplier_id">
                                                        <option value="" selected disabled>Tedarikçi seçiniz..</option>
                                                        @foreach ($suppliers as $supplierId => $supplierTitle)
                                                    
                                                        <option value="{{ $supplierId }}">{{ $supplierTitle }}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            {{-- <div class="mb-3">
                                                <label for="epin"
                                                    class="form-label">{{ __('epinStocks.epin') }}</label>
                                                <textarea rows="4" , cols="54" id="epin" name="epin"
                                                    style="resize:none, "></textarea>
                                            </div> --}}
                                        </div>


                                        <div class="col-lg-8" style="margin:0 auto; ">

                                            <div class="d-grid" style="margin-top: 30px">
                                                <button type="submit" class="btn btn-light" id="btnSubmit"
                                                    name="btnSubmit">{{ __('epinStocks.btnSave') }}</button>
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

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
          



            $('#epinProducts').on('change', function(res) {

                var epinProduct_id = $(this).val();
                if (epinProduct_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('epinStocks/productEntity') }}",
                        data: {
                            epinProduct_id: epinProduct_id,
                            // title:title,
                        },

                        success: function(res) {

                            $('#epinEntities').empty();
                            // $('#epinEntities').append('<option>Select</option>');
                            $.each(res, function(key, value) {
                                $("#epinEntities").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        }
                    });
                }

            });
        });



        // $("#epinEntities").on('click', function() {
        //     var epinProduct_id = $(this).val();
        //     if (epinProduct_id) {
        //         $.ajax({
        //             type: "GET",
        //             url: "{{ url('epinProducts/productEntity') }}?epinProduct_id=" + epinProduct_id,
        //             success: function(res) {
        //                 if (res) {
        //                     $("#epinEntities").empty();
        //                     $("#epinEntities").append('<option>Select</option>');
        //                     $.each(res, function(key, value) {
        //                         $("#epinEntities").append('<option value="' + key + '">' +
        //                             value + '</option>');

        //                     });
        //                 }
        //                 // else {
        //                 //                 $("#epinEntities").empty();
        //                 //             }
        //             }

        //         });
        //     };

        // });
    </script>

    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var country_id = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-states-by-country') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html(
                            '<option value="">Select State First</option>');
                    }
                });
            });
            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-cities-by-state') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
