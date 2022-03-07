@extends("layouts.main")
@section('style')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<style>
    .percent-item {
        border: 1px solid transparent;
    }

    .form-check-input {
        margin-top: 0!important;
        width: 2em!important;
        height: 2em!important;
        margin-left: 10px;
    }

    .status-block {
        display: flex;
        align-items: center;
    }
</style>
@endsection
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ __('exchangePrices.title') }}</div>
            <div class="ps-3">
            </div>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-success btnNew" id="createNewExchange">{{ __('exchangePrices.addNew') }}</button>
            </div>
        </div>
        <hr>
        <form method="POST" action="{{route('exchangePrices.store')}}" id="exchange_price" class="card product-form">
            @csrf
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0 table-striped">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('exchangePrices.currency') }}</th>
                                <th scope="col">{{ __('exchangePrices.currency_price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $key=>$value)
                            <tr>
                                <th scope="row" style="vertical-align: middle;">
                                    <label for="currency_{{$value->id}}">{{ $value->currency }}</label>
                                </th>
                                <td>
                                    <input type="number" class="form-control percent-item" name="currency_{{$value->id}}" data-id="{{$value->id}}" id="currency_{{$value->id}}" value="{{ $value->currency_price }}" placeholder="">
                                </td>
                            </tr>
                            @endforeach
                            <!-- <tr>
                                <th style="padding: 1.5rem .5rem;" scope="row" style="vertical-align: middle;">
                                    <button class="btn btn-light" type="submit">Güncelle</button>
                                </th>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="custom-form" id="bankDefinitionForm" name="bankDefinitionForm" action="{{route('exchangePrices.store')}}" method="POST">
                        <div class="modal-header mb-2">
                            <h4 class="modal-title" id="modelHeading">{{ __('exchangePrices.tableAction') }}</h4>
                        </div>
                        <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @csrf
                                            <div class="add-page col-lg-12 ">
                                                <div class="border border-top-0 p-3 rounded mb-2 mt-2">
                                                    <div class="mb-0">
                                                        <input type="hidden" name="id" class="form-control" id="id" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-3">
                                                            <label for="currency" class="form-label">{{ __('exchangePrices.currency') }}</label>
                                                            <input type="text" name="currency" class="form-control" id="currency" placeholder="{{ __('exchangePrices.currency') }}" required>
                                                        </div>
                                                        <div class="col-lg-12 mb-3">
                                                            <label for="currency_price" class="form-label">{{ __('exchangePrices.currency_price') }}</label>
                                                            <input type="text" name="currency_price" class="form-control" id="currency_price" placeholder="{{ __('exchangePrices.currency_price') }}">
                                                        </div>
                                                        <div class="col-lg-12 mb-3">
                                                            <label for="currency_code" class="form-label">{{ __('exchangePrices.currency_code') }}</label>
                                                            <input type="text" name="currency_code" class="form-control" id="currency_code" placeholder="{{ __('exchangePrices.currency_code') }}">
                                                        </div>
                                                        <div class="col-lg-12 mb-2 mt-3 status-block">
                                                            <label class="form-check-label" for="isActive">{{ __('exchangePrices.tableStatus') }}</label>
                                                            <input class="form-check-input" name="isActive" type="checkbox" id="isActive">
                                                        </div>
                                                    </div>

                                                    {{-- <div class="mb-3">
                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success"
                                                            data-offstyle="danger">
                                                    </div> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-light">{{ __('company.btnSave') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {

        var token = $("meta[name='csrf-token']").attr("content");
        var sendTimer;
        var sendTimeOut = 1200;

        $('.percent-item').on('keyup', function(e) {
            var _self = $(this);
            clearTimeout(sendTimer);
            var currencyPrice = $(this).val();
            var id = $(this).data('id');
            sendTimer = setTimeout(function() {
                var data = {}
                $.ajax({
                    url: "saveCurrency",
                    type: "POST",
                    data: {
                        _token: token,
                        id: id,
                        'currency_price': currencyPrice,
                    },
                    success: function(e) {
                        var animationEvent = 'webkitAnimationEnd oanimationend msAnimationEnd animationend';
                        _self.addClass('successOut');
                        _self.one(animationEvent, function(event) {
                            _self.removeClass('successOut')
                        });
                    }
                });
                // $('#exchange_price').submit();

            }, sendTimeOut);
        });

        $('.percent-item').on('keydown', function() {
            clearTimeout(sendTimer);
        });


        $('#createNewExchange').click(function() {
            $('#modal-id').modal('show');;
        });
    });
</script>
@endsection