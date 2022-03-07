@extends("layouts.main")
@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">

            @include('common.breadcrumb')

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-success btnNew"
                        id="createNewEpinProductEntities">{{ __('epinProductEntities.create') }}</button>
                </div>
            </div>

            @include('common.message')
        
            <hr />
               <span style="font-size: 18px; padding-left:10px;">{{ $data ['productDetails']->title  }} {{__('epinProductEntities.ProductEntities')}}</span>        
            <hr />

            @include('common.dataTable')


            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header mb-2">
                            <h4 class="modal-title" id="modelHeading">{{ __('epinProductEntities.formHeading') }}</h4>
                        </div>

                        <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                            <form id="productForm" name="productForm" action="{{ route('epinProductEntities.store') }}"
                                method="POST">
                                @csrf
                                <div class="add-page col-lg-12 ">
                                    <div class="border border-1 border-top-0 p-3 rounded mb-2">
                                        <div class="mb-2">

                                            <input type="hidden" name="id" class="form-control" id="id" required>
                                        </div>
                                        
                                        <input type="hidden" name="epinProduct_id"  id="epinProduct_id" value="{{ $data ['productDetails']->id }}" >
                                        <div class="mb-2">
                                            <label for="title" class="form-label">{{ __('epinProductEntities.labelTitle') }}</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="{{ __('epinProductEntities.titlePlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description"
                                                class="form-label">{{ __('epinProductEntities.labelDescription') }}</label>
                                            <input type="text" name="description" class="form-control" id="description"
                                                placeholder="{{ __('epinProductEntities.descriptionPlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="old_id"
                                                class="form-label">{{ __('epinProductEntities.labelOld_id') }}</label>
                                            <input type="text" name="old_id" class="form-control" id="old_id"
                                                placeholder="{{ __('epinProductEntities.Old_idPlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="stock_code"
                                                class="form-label">{{ __('epinProductEntities.labelStock_code') }}</label>
                                            <input type="text" name="stock_code" class="form-control" id="stock_code"
                                                placeholder="{{ __('epinProductEntities.Stock_codePlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price"
                                                class="form-label">{{ __('epinProductEntities.labelPrice') }}</label>
                                            <input type="text" name="price" class="form-control" id="price"
                                                placeholder="{{ __('epinProductEntities.PricePlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="accounting_code"
                                                class="form-label">{{ __('epinProductEntities.labelAccounting_code') }}</label>
                                            <input type="text" name="accounting_code" class="form-control" id="accounting_code"
                                                placeholder="{{ __('epinProductEntities.Accounting_codePlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="accounting_code"
                                            class="form-label">{{ __('epinProductEntities.labelStatus') }}</label><br>
                                            <input type="checkbox" class="form-check-input" style="width: 50px; height:25px;" name="statusIn" id="statusIn" value="1" >
                                       
                                        </div>
                                        {{-- <div class="mb-3">
                                            <input type="file" name="imgUrl" class="form-control">                                       
                                        </div> --}}
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-light">{{ __('epinProductEntities.btnSave') }}</button>
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
        $('#createNewEpinProductEntities').click(function() {
            
            $('#id').val('');
            $('#title').val('');
            $('#description').val('');
            $('#price').val('');
            $('#old_id').val('');
            $('#stock_code').val('');
            $('#accounting_code').val('');
            $('#productForm').trigger("reset");
            $('#modal-id').modal('show');
        });
        //save
        $('body').on('click', '#submit', function(event) {
            event.preventDefault();

            var id = $("#id").val();
            var title = $("#title").val();
            var description = $("#description").val();
            var old_id = $("#old_id").val();
            var stock_code = $("#stock_code").val();
            var price = $("#price").val();
            var accounting_code = $("#accounting_code").val();

            $.ajax({
                url: "{{ route('epinProductEntities.store') }}" + '/' + id,
                type: "POST",
                data: {
                    id: id,
                    old_id:old_id,
                    stock_code:stock_code,
                    title: title,
                    description: description,
                    price:price,
                    status:status,
                    accounting_code:accounting_code

                },
                dataType: 'json',
            });

        });
        //Edit modal window
    </script>
@endsection
