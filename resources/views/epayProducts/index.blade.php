@extends("layouts.main")
@section('style')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="assets/css/custom-pages.css">

@endsection
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">

        <div class="head-block">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ __('epayProducts.mainTitle') }}</div>

            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    @include('common.epayDropdown')
                </div>
            </div>
        </div>

        <hr />
        <form action="">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('epayProducts.productId') }}</th>
                                <th scope="col">{{ __('epayProducts.product') }}</th>
                                <th scope="col">{{ __('epayProducts.skuTitle') }}</th>
                                <th scope="col">{{ __('epayProducts.total') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>5 TL Razer Gold PinGold PinGold Pin </td>
                                <td>42321231231</td>
                                <td><input class="custom-input" type="number" name="price" id="price"></td>
                                <td><input type="submit" class="btn-order" value="{{ __('epayProducts.orderBtn') }}"></input> </td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <td>5 TL Razer Gold Pin </td>
                                <td>42321231231</td>
                                <td><input class="custom-input" type="number" name="price" id="price"></td>
                                <td><input type="submit" class="btn-order" value="{{ __('epayProducts.orderBtn') }}"></input> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
