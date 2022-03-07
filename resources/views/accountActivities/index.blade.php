@extends("layouts.main")
@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">

            @include('common.breadcrumb')

            <div class="ms-auto accountAdd">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-success btnNew" id="addNew">{{ __('accountActivities.addNew') }}</button>
                </div>
            </div>

            @include('common.message')
            <hr />
            @include('common.dataTable')
            
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header mb-2">
                            <h4 class="modal-title" id="modelHeading">Bakiye Ekle</h4>
                        </div>

                        <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                            <form id="accountActivitiesForm" name="accountActivitiesForm" action="{{ route('accountActivities.store') }}"
                                method="POST">
                                @csrf
                                <div class="add-page col-lg-12 ">
                                    <div class="border border-1 border-top-0 p-3 rounded mb-2">
                                        <div class="mb-2">

                                            <input type="hidden" name="id" class="form-control" id="id" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="company_id" class="form-label">{{ __('accountActivities.company') }}</label>
                                            <select name="company_id" id="company_id" class="form-select formOption">
                                                <option selected disabled class="formOption">...</option>
                                                @foreach ($companies as $company)
                                                    <option class="formOption" value="{{$company->id}}">{{$company->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="mb-2">
                                            <label for="bank_id" class="form-label">{{ __('accountActivities.bank') }}</label>
                                            <select name="bank_id" id="bank_id" class="form-select formOption">
                                                <option selected disabled class="formOption">...</option>
                                                @foreach ($banks as $bank)
                                                    <option class="formOption" value="{{$bank->id}}">{{$bank->bank}}</option>
                                                @endforeach
                                            </select>
                                            
                                          
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount"
                                                class="form-label">{{ __('accountActivities.amount') }}</label>
                                            <input type="text" name="amount" class="form-control" id="amount"
                                                placeholder="{{ __('accountActivities.amount') }}" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="description"
                                                class="form-label">{{ __('accountActivities.description') }}</label>
                                            <input type="text" name="description" class="form-control" id="description"
                                                placeholder="{{ __('accountActivities.description') }}">
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-light">{{ __('accountActivities.btnSave') }}</button>
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
@section('script')


    <script>
        //insert
        $('#addNew').click(function() {
            
            $('#id').val('');
            $('#accountActivitiesForm').trigger("reset");
            $('#modal-id').modal('show');
        });


       
    </script>
    
@endsection
