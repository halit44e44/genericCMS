@extends("layouts.main")
@section('style')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="assets/css/custom-pages.css">
<!-- 
<style>
    .table>:not(caption)>*>* {
        padding: .5rem .5rem !important;
        vertical-align: middle;
    }

    table tr td p.btn-yes {
        padding: 5px 20px;
        background-color: #007d00;
        color: white;
        display: inline;
        border-radius: 5px;
    }

    table tr td p.btn-no {
        padding: 5px 20px;
        background-color: #af0000;
        color: white;
        display: inline;
        border-radius: 5px;
    }

    table tr td input.btn-order {
        padding: 5px 20px;
        background-color: #3535ff;
        color: white;
        display: inline;
        border-radius: 5px;
    }

    table tr td input.custom-input {
        max-width: 100px;
        border-radius: 5px;
        background-color: transparent;
        border: 1px solid gray;
    }

    .custom-dropdown.dropdown {
        position: relative;
        display: inline-block;
    }

    .custom-dropdown.dropdown {
        background-color: transparent;
        color: #ffffff;
        border: 1px solid #b9b9b9;
        padding: 5px 10px;
    }

    .custom-dropdown.dropdown span i {
        font-size: 10px !important;
        color: #ffffff;
    }

    .custom-dropdown .dropdown-content {
        display: none;
        position: absolute;
        min-width: 160px;
        
        padding: 12px 0;
        z-index: 1;
        right: 0;
    }

    .custom-dropdown.dropdown:hover .dropdown-content {
        display: flex;
        flex-direction: column;
    }

    .custom-dropdown.dropdown:hover .dropdown-content a {
        display: inline-block;
        background-color: #b2b2b2;
        color: #ffffff;
        border: 1px solid #b9b9b9;
        padding: 10px 10px;
    }

    .custom-dropdown.dropdown:hover .dropdown-content a:hover {
        background-color: #b9b9b9;
        color: #ffffff;
    }

    .head-block {
        display: flex;
    }
</style> -->
@endsection
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">

        <div class="head-block">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Razer Ürünler</div>

            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    @include('common.razerDropdown')
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
                                <th scope="col">Ürün Kodu</th>
                                <th scope="col">Ürün</th>
                                <th scope="col">Stok Durumu</th>
                                <th scope="col">Max Adet</th>
                                <th scope="col">K.Yüzde</th>
                                <th scope="col">K.Fiyat</th>
                                <th scope="col">Fiyat</th>
                                <th scope="col">Birim</th>
                                <th scope="col"></th>
                                <th scope="col">Birim</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>5 TL Razer Gold Pin </td>
                                <td>
                                    <p class="btn-yes">Evet</p>
                                </td>
                                <td>10</td>
                                <td>7.00</td>
                                <td>4.65</td>
                                <td>5.00</td>
                                <td>TRY</td>
                                <td><input class="custom-input" type="number" name="price" id="price"></td>
                                <td><input type="submit" class="btn-order" value="Sipariş"> </td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <td>5 TL Razer Gold Pin </td>
                                <td>
                                    <p class="btn-no">Hayır</p>
                                </td>
                                <td>10</td>
                                <td>7.00</td>
                                <td>4.65</td>
                                <td>5.00</td>
                                <td>TRY</td>
                                <td><input class="custom-input" type="number" name="price" id="price"></td>
                                <td><input type="submit" class="btn-order" value="Sipariş"> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

        <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mb-2">
                        <h4 class="modal-title" id="modelHeading">{{ __('platform.formHeading') }}</h4>
                    </div>
                    <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                        <form id="platformForm" name="platformForm" action="{{ route('platforms.store') }}" method="POST">
                            @csrf
                            <div class="add-page col-lg-12 ">
                                <div class="border border-1 border-top-0 p-3 rounded mb-2">
                                    <div class="mb-2">
                                        <input type="hidden" name="id" class="form-control" id="id" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="name" class="form-label">{{ __('platform.labelName') }}</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('platform.namePlaceholder') }}" required>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-light">{{ __('platform.btnSave') }}</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection