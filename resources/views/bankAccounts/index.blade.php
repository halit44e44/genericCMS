@extends("layouts.main")
@section('style')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-success btnNew" id="createNewBank">{{ __('bankAccounts.createNewBank') }}</button>
            </div>
        </div>
        @include('common.message')
        <hr />
        @include('common.dataTable')
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            
            <form class="custom-form" id="bankAccountsForm" name="bankAccountsForm" action="{{ route('bankAccounts.store') }}" method="POST">
                @csrf
                <div class="modal-header mb-2">
                    <h4 class="modal-title" id="modelHeading">{{ __('bankAccounts.formHeading') }}</h4>
                </div>
                <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="add-page col-lg-12 ">
                                        <div class="border border-top-0 p-3 rounded mb-2 mt-2">
                                            <div class="mb-0">
                                                <input type="hidden" name="id" class="form-control" id="id" required>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-lg-7">
                                                    <label class="form-label" for="bank">{{ __('bankAccounts.title') }}</label>
                                                    <select class="form-select mb-3" name="bank_id" id="bank_id" aria-label="Default select example">
                                                        <option selected="">{{ __('bankAccounts.selectBank') }}</option>
                                                        @foreach($data['banks'] as $index=>$bank)
                                                        <option data-id="{{$bank->accounting_code}}" value="{{$bank->id}}">{{$bank->bank}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="bank_id_temp" id="bank_id_temp">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="accounting_code" class="form-label">{{ __('bankAccounts.accCode') }}</label>
                                                    <input disabled type="text" name="accounting_code" class="form-control" id="accounting_code" placeholder="{{ __('bankAccounts.accCode') }}">
                                                </div>
                                                <div class="form-check col-lg-2">
                                                    <label class="form-check-label row" for="isActive">{{ __('bankAccounts.tableStatus') }}</label>
                                                    <div class="radio-custom col-lg-12">
                                                        <input class="form-check-input" name="isActive" type="checkbox" id="isActive">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-lg-6 mb-3">
                                                    <label for="branch_code" class="form-label">{{ __('bankAccounts.branchName') }}</label>
                                                    <input type="text" name="branch_code" class="form-control " id="branch_code" placeholder="{{ __('bankAccounts.branchName') }}">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="account_code" class="form-label">{{ __('bankAccounts.account_number') }}</label>
                                                    <input type="text" name="account_code" class="form-control" id="account_code" placeholder="{{ __('bankAccounts.account_number') }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="iban_no" class="form-label">{{ __('bankAccounts.iban') }}</label>
                                                    <input type="text" name="iban_no" class="form-control" id="iban_no" placeholder="{{ __('bankAccounts.iban') }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="account_owner" class="form-label">{{ __('bankAccounts.accountOwner') }}</label>
                                                    <input type="text" name="account_owner" class="form-control" id="account_owner" placeholder="{{ __('bankAccounts.accountOwner') }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">{{ __('bankAccounts.description') }}</label>
                                                <input type="text" name="description" class="form-control" id="description" placeholder="{{ __('bankAccounts.description') }}" required>
                                            </div>
                                            <!-- <div class="mb-3">
                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success"
                                data-offstyle="danger">
                        </div>  -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" id="saveBtn" class="btn btn-light">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')

<script>
    $(function() {

        $('#createNewBank').click(function() {
            $('#modal-id').modal('show');
            $('#bank_id').val('');
            $('#branch_code').val('');
            $('#account_code').val('');
            $('#iban_no').val('');
            $('#account_owner').val('');
            $('#description').val('');
            $('#accounting_code').val('');
            $('#bank_id').prop('readonly', false);
            $('#isActive').prop('checked', false);
            $('.form-check-input').removeClass('active');
        });

        $('#bank_id').on('change', function() {
            $('#accounting_code').val($("option:selected", this).data('id'));
        });

    });
</script>

@endsection