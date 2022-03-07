@extends("layouts.main")
@section('style')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<style>
    .status-block {
        display: flex;
        align-items: center;
        flex-direction: column;
        width: 100%;
        justify-content: center;
    }
    .form-check-input {
        display: inline-block;
        width: 20px;
        min-height: 20px;
        min-width: 20px;
        margin-top: 5px!important;
    }
</style>
@endsection
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        @include('common.breadcrumb')
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-success btnNew" id="createNewBankDefi">{{ __('bankDefinition.createNewBank') }}</button>
            </div>
        </div>
        @include('common.message')
        <hr />
        @include('common.dataTable')
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="custom-form" id="bankDefinitionForm" name="bankDefinitionForm" action="{{ route('bankDefinitions.store') }}" method="POST">

                <div class="modal-header mb-2">
                    <h4 class="modal-title" id="modelHeading">{{ __('bankDefinition.tableAction') }}</h4>
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
                                            <div class="mb-5 row">
                                                <div class="col-lg-12 mb-2">
                                                    <label for="bank" class="form-label">{{ __('bankDefinition.title') }}</label>
                                                    <input type="text" name="bank" class="form-control" id="bank" placeholder="{{ __('bankDefinition.title') }}" required>
                                                </div>
                                                <div class="col-lg-12 mb-2">
                                                    <label for="accounting_code" class="form-label">{{ __('bankDefinition.accCode') }}</label>
                                                    <input type="text" name="accounting_code" class="form-control" id="accounting_code" placeholder="{{ __('bankDefinition.accCode') }}">
                                                </div>
                                                <div class="col-lg-12 mb-2 mt-3 status-block">
                                                    <label class="form-check-label" for="isActive">{{ __('bankDefinition.tableStatus') }}</label>
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

@endsection
@section('script')

<script>
    $(function() {
        $('#createNewBankDefi').click(function() {
            $('#modal-id').modal('show');
            $('#bank').val('');
            $('#accounting_code').val('');
            $('#isActive').prop('checked', false);
            $('.form-check-input').removeClass('active');
        });
    })
</script>

@endsection