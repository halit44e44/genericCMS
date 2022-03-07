@extends("layouts.main")
@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ __('genbaProductDetail.genbaProducts') }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('genbaProductDetail.productDetails') }}</li>
                        </ol>
                    </nav>
                </div>

                {{-- Settings --}}

                {{-- <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-light">Settings</button>
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="row g-0">
                    <div class="col-md-3 border-end">
                        <div id="lightgallery" class="row">
                            <a href="{{ $genbaProduct->genbaGraphics[0]->imageUrl ?? '' }}"
                                class="col-lg-12 mb-2 mt-2"><img
                                    src="{{ $genbaProduct->genbaGraphics[0]->imageUrl ?? '' }}" class="" style="
                                    width: 80%; margin: 0 auto" alt="..." /></a>
                            @php($x = 0)
                            @foreach ($genbaProduct->genbaGraphics as $item)
                                <?php
                                if ($x == 0) {
                                    $x++;
                                    continue;
                                }
                                ?>
                                {{-- <a data-lightbox="image-1" href="{{ $item->imageUrl }}"><img src="{{ $item->imageUrl }}" alt=""></a> --}}
                                <a href="{{ $item->imageUrl }}" class="col-lg-4 p-3"><img src="{{ $item->imageUrl }}"
                                        width="150px" class="border rounded cursor-pointer" alt=""></a>
                            @endforeach
                        </div>
                        <hr>
                        <div id="video-gallery" style="display: flex">
                            @foreach ($genbaProduct->genbaVideo as $item)
                                <a href="{{ $item->video_url }}">
                                    <img src="{{ asset('assets/images/youtube.png') }}" width="50px"
                                        class="ml-2">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h4 class="card-title">{{ $genbaProduct->name }}</h4>
                            <p class="productDetail">{{ __('genbaProductDetail.product_id') }} :
                                {{ $genbaProduct->productID }}</p>
                            <div class="d-flex gap-3 py-3">
                                <div class="cursor-pointer">
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <div>142 reviews</div>
                                <div class="text-white"><i class='bx bxs-cart-alt align-middle'></i> 134 orders</div>
                            </div>
                            <div class="mb-3 instructionBtnClick">
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-outline-success btnNew "
                                        id="instructions">{{ __('genbaProductDetail.instruction') }}</button>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <dl class="row productDetail">
                                        <dt>{{ __('genbaProductDetail.productDetails') }}</dt><br>

                                        <dt class="col-sm-3 mt-3">{{ __('genbaProductDetail.age') }}</dt>
                                        <dd class="col-sm-9 mt-3">{{ $genbaProduct->genbaAgeRestriction->age ?? '' }}
                                        </dd>
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.regionCode') }}</dt>
                                        <dd class="col-sm-9">{{ $genbaProduct->regionCode ?? '' }}</dd>

                                        <dt class="col-sm-3">{{ __('genbaProductDetail.sku') }}</dt>
                                        <dd class="col-sm-9"> {{ $genbaProduct->sku ?? '' }}</dd>

                                        <dt class="col-sm-3">{{ __('genbaProductDetail.isBundle') }}</dt>
                                        <dd class="col-sm-9"> {{ $genbaProduct->isBundle ?? '' }}</dd>
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.status') }}</dt>
                                        <dd class="col-sm-9"> {{ $genbaProduct->status ?? '' }}</dd>

                                        <dt class="col-sm-3">{{ __('genbaProductDetail.detailSync') }}</dt>
                                        <dd class="col-sm-9"> {{ $genbaProduct->details_sync ?? '' }}</dd>
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.priceSync') }}</dt>
                                        <dd class="col-sm-9"> {{ $genbaProduct->price_sync ?? '' }}</dd>

                                        <dt class="col-sm-3">{{ __('genbaProductDetail.trPrice') }}</dt>
                                        <dd class="col-sm-9"> {{ $genbaProduct->tr_price ?? '' }}</dd>
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.enPrice') }}</dt>
                                        <dd class="col-sm-9"> {{ $genbaProduct->en_price ?? '' }}</dd>
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.eurPrice') }}</dt>
                                        <dd class="col-sm-9"> {{ $genbaProduct->eur_price ?? '' }}</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-6">
                                    <dl class="row productDetail">
                                        <dt>{{ __('genbaPrice.priceDetails') }}</dt><br>
                                        @foreach ($genbaProduct->genbaPrice as $item)
                                            {{-- <span class="">/per kg</span> --}}
                                            <dt class="col-sm-3 mt-3">{{ __('genbaPrice.regionCode') }}</dt>
                                            <dd class="col-sm-9 mt-3">{{ $item->regionCode ?? '' }}</dd>

                                            <dt class="col-sm-3">{{ __('genbaPrice.currencyCode') }}</dt>
                                            <dd class="col-sm-9"> {{ $item->currencyCode ?? '' }}</dd>

                                            <dt class="col-sm-3">{{ __('genbaPrice.wsp') }}</dt>
                                            <dd class="col-sm-9">{{ $item->wsp ?? '' }}</dd>
                                            <dt class="col-sm-3">{{ __('genbaPrice.srp') }}</dt>
                                            <dd class="col-sm-9"> {{ $item->srp ?? '' }}</dd>

                                            <dt class="col-sm-3">{{ __('genbaPrice.isPromotion') }}</dt>
                                            <dd class="col-sm-9"> {{ $item->isPromotion ?? '' }}</dd>
                                        @endforeach
                                    </dl>
                                    <dl class="row mt-5 productDetail">
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.developer') }}</dt>
                                        <dd class="col-sm-9"> {{ $productDetails->developer->name ?? '' }}</dd>
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.system') }}</dt>
                                        <dd class="col-sm-9">
                                            {{ $productDetails->developer->protectionSystem ?? '' }}</dd>
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.publisher') }}</dt>
                                        <dd class="col-sm-9"> {{ $productDetails->publisher->name ?? '' }}</dd>
                                        <dt class="col-sm-3">{{ __('genbaProductDetail.lable') }}</dt>
                                        <dd class="col-sm-9"> {{ $productDetails->publisher->lable ?? '' }}</dd>

                                    </dl>
                                </div>
                            </div>
                            <div class="card-body productDetail">
                                <ul class="nav nav-tabs mb-0" id="product-block" role="tablist">
                                    @php($flag = true)


                                    @foreach ($genbaProduct->languages as $item)

                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link  @if ($flag)
                                                active
                                                @php($flag = false)
                                                @endif"
                                                data-bs-toggle="tab"
                                                href="#{{ str_replace(' ', '-', $item->languageName) }}" role="tab"
                                                aria-selected="true">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i
                                                            class='bx bx-comment-detail font-18 me-1'></i>
                                                    </div>
                                                    <div class="tab-title">{{ $item->languageName }}</div>
                                                </div>
                                            </a>
                                        </li>

                                        <hr>
                                    @endforeach
                                </ul>
                                <div class="tab-content pt-3" id="product-blockContent">
                                    @php($flag = true)
                                    @foreach ($genbaProduct->languages as $item)

                                        <div class="tab-pane fade @if ($flag)
                                        show active
                                        @php($flag = false)
                                        @endif"
                                            id="{{ str_replace(' ', '-', $item->languageName) }}" role="tabpanel">
                                            <p class="card-text fs-6"><b>{{ __('genbaProductDetail.language') }} :</b>
                                                {{ $item->languageName }}</p>
                                            <p class="card-text fs-6"><b>{{ __('genbaProductDetail.localisedName') }}
                                                    :</b> {{ $item->localisedName }}
                                            </p>
                                            <p class="card-text fs-6">
                                                <b>{{ __('genbaProductDetail.localisedKeyFeatures') }} :</b>
                                                {{ $item->localisedKeyFeatures }}
                                            </p>
                                            <p class="card-text fs-6"><b>{{ __('genbaProductDetail.legalText') }} :</b>
                                                {{ $item->legalText }}</p>
                                            <p class="card-text fs-6">
                                                <b>{{ __('genbaProductDetail.localisedDescription') }} :
                                                </b>{{ $item->localisedDescription }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{-- <div class="col"> --}}
                                    <dl class="row productDetail">
                                        <dt class="col-sm-4 mb-3">{{ __('genbaProductDetail.spokenLanguageSet') }}</dt>
                                        @if (isset($genbaProduct->genbaGameLanguage->spokenLanguageSet))
                                            @foreach (json_decode($genbaProduct->genbaGameLanguage->spokenLanguageSet) as $key => $value)
                                                <dd class="col-sm-12">{{ $value }}</dd>
                                            @endforeach
                                        @endif

                                    </dl>
                                </div>
                                <div class="col-lg-4">
                                    <dl class="row productDetail">
                                        <dt class="col-sm-3 mb-3">{{ __('genbaProductDetail.subtitle') }}</dt>
                                        @if (isset($genbaProduct->genbaGameLanguage->subtitleLanguageSet))
                                            @foreach (json_decode($genbaProduct->genbaGameLanguage->subtitleLanguageSet, true) as $key => $value)
                                                <dd class="col-sm-12">{{ $value }}</dd>
                                            @endforeach
                                        @endif
                                    </dl>
                                </div>
                                <div class="col-lg-4">
                                    <dl class="row productDetail">
                                        <dt class="col-sm-3 mb-3">{{ __('genbaProductDetail.menuLanguage') }}</dt>
                                        @if (isset($genbaProduct->genbaGameLanguage->menuLanguageSet))
                                            @foreach (json_decode($genbaProduct->genbaGameLanguage->menuLanguageSet, true) as $key => $value)
                                                <dd class="col-sm-12">{{ $value }}</dd>
                                            @endforeach
                                        @endif
                                    </dl>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="card-body">
                    <ul class="nav nav-tabs mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#product" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-collection font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">{{ __('genbaProductDetail.product') }}</div>
                                </div>

                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#price" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-lira font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">{{ __('genbaProductDetail.price') }}</div>
                                </div>

                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link meta-data" data-bs-toggle="tab" href="#meta-data" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-data font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">{{ __('genbaProductDetail.metaData') }}</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#restriction" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-block font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">{{ __('genbaProductDetail.restriction') }}</div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="product" role="tabpanel">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('genbaProductDetail.sku') }}</th>
                                        <th scope="col">{{ __('genbaProductDetail.regionCode') }}</th>
                                        <th scope="col">{{ __('genbaProductDetail.name') }}</th>
                                        <th scope="col">{{ __('genbaProductDetail.isBundle') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($genbaGetProduct as $item)
                                        <tr class='clickable-row' data-href="details?id={{ $item->id }}">
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ $item->regionCode }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->isBundle }}</td>
                                            </a>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="price" role="tabpanel">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('genbaProductDetail.regionCode') }}</th>
                                        <th scope="col">{{ __('genbaProductDetail.currencyCode') }}</th>
                                        <th scope="col">{{ __('genbaProductDetail.wsp') }}</th>
                                        <th scope="col">{{ __('genbaProductDetail.srp') }}</th>
                                        <th scope="col">{{ __('genbaProductDetail.isPromotion') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($genbaPrice as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->regionCode }}</td>
                                            <td>{{ $item->currencyCode }}</td>
                                            <td>{{ $item->wsp }}</td>
                                            <td>{{ $item->srp }}</td>
                                            <td>{{ $item->isPromotion }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="meta-data" role="tabpanel">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">#</th> --}}
                                        <th scope="col">{{ __('genbaProductDetail.parentCategory') }}</th>
                                        <th scope="col">{{ __('genbaProductDetail.values') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($genbaMetaData as $item)
                                        <tr>
                                            <td scope="row">{{ $item->parentCategory }}</td>
                                            @foreach (json_decode($item->values) as $key => $value)
                                                <td>{{ $value }}</td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="restriction" role="tabpanel">
                            <table class="table table-hover">
                                <thead>
                                    {{-- <tr>
                                        {{ __('genbaProductDetail.whitelistCountryCodes') }}

                                    </tr> --}}
                                </thead>
                                <tbody>

                                    <tr>
                                        @if ($genbaProduct->restriction)
                                            @foreach (json_decode($genbaProduct->restriction->whitelistCountryCodes) as $key => $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        @endif

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-content pt-3">
                    </div>
                </div>

            </div>


            <hr />
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col">
                    <div class="card">
                        {{-- <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/products/16.png') }}" class="img-fluid"
                                    alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-title">Light Grey Headphone</h6>
                                    <div class="cursor-pointer my-2">
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                    </div>
                                    <div class="clearfix">
                                        <p class="mb-0 float-start fw-bold"><span
                                                class="me-2 text-decoration-line-through">$240</span><span
                                                class="text-white">$199</span></p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        {{-- <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/products/17.png') }}" class="img-fluid"
                                    alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-title">Black Cover iPhone 8</h6>
                                    <div class="cursor-pointer my-2">
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                    </div>
                                    <div class="clearfix">
                                        <p class="mb-0 float-start fw-bold"><span
                                                class="me-2 text-decoration-line-through">$179</span><span
                                                class="text-white">$110</span></p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        {{-- <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/products/19.png') }}" class="img-fluid"
                                    alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-title">Men Hand Watch</h6>
                                    <div class="cursor-pointer my-2">
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                    </div>
                                    <div class="clearfix">
                                        <p class="mb-0 float-start fw-bold"><span
                                                class="me-2 text-decoration-line-through">$150</span><span
                                                class="text-white">$120</span></p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-xl">
            <div class="modal-content instructionBtn">
                <div class="card-body productDetail">
                    <ul class="nav nav-tabs mb-0" id="product-block" role="tablist">
                        @php($flag = true)

                        @foreach ($genbaProduct->genbaInstruction as $item)

                            <li class="nav-item" role="presentation">
                                <a class="nav-link  @if ($flag)
                                    active
                                    @php($flag = false)
                                    @endif"
                                    data-bs-toggle="tab" href="#lang-item-{{ $item->id ?? '' }}" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">{{ $item->language ?? '' }}</div>
                                    </div>
                                </a>
                            </li>
                            <hr>
                        @endforeach
                    </ul>
                    <div class="tab-content pt-3" id="product-blockContent">
                        @php($flag = true)
                        @foreach ($genbaProduct->genbaInstruction as $item)

                            <div class="tab-pane fade @if ($flag)
                            show active
                            @php($flag = false)
                            @endif"
                                id="lang-item-{{ $item->id ?? '' }}" role="tabpanel">

                                <p class="card-text fs-6"><b>{{ __('genbaProductDetail.name') }}</b>
                                    {{ $item->language ?? '' }}</p>
                                <p class="card-text fs-6"><b>{{ __('genbaProductDetail.description') }}
                                    </b>{{ $item->value ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    {{-- <script>
        $(document).ready(function() {
            $('#example').DataTable();

        });
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });
            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script> --}}

    <script>
        $('#instructions').click(function(event) {
            event.preventDefault();
            $('#modal-add').modal('show');

        });
    </script>
    <script>
        $('body').on('click', '.developer', function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('companies.store') }}" + '/' + id,
                type: "GET",
                data: {
                    id: id,
                    title: title,
                    description: description,
                    email: email,
                    // status: status
                },
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            lightGallery(document.getElementById('lightgallery'));
            lightGallery(document.getElementById('video-gallery'));

        });
    </script>


@endsection
