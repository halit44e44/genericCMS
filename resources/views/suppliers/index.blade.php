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
                        id="createNewSupplier">{{ __('supplier.create') }}</button>
                </div>
            </div>

            @include('common.message')
            <hr />
            @include('common.dataTable')


            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header mb-2">
                            <h4 class="modal-title" id="modelHeading">{{ __('supplier.formHeading') }}</h4>
                        </div>

                        <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                            <form id="supplierForm" name="supplierForm" action="{{ route('suppliers.store') }}"
                                method="POST">
                                @csrf
                                <div class="add-page col-lg-12 ">
                                    <div class="border border-1 border-top-0 p-3 rounded mb-2">
                                        <div class="mb-2">

                                            <input type="hidden" name="id" class="form-control" id="id" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="title" class="form-label">{{ __('supplier.labelTitle') }}</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="{{ __('supplier.titlePlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description"
                                                class="form-label">{{ __('supplier.labelDescription') }}</label>
                                            <input type="text" name="description" class="form-control" id="description"
                                                placeholder="{{ __('supplier.descriptionPlaceholder') }}" required>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-light">{{ __('supplier.btnSave') }}</button>
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
        $('#createNewSupplier').click(function() {
            $('#submit').val("create-supplier");
            $('#id').val('');
            $('#title').val('');
            $('#description').val('');
            $('#supplierForm').trigger("reset");
            $('#modal-id').modal('show');
        });
        //save
        $('body').on('click', '#submit', function(event) {
            event.preventDefault();

            var id = $("#id").val();
            var title = $("#title").val();
            var description = $("#description").val();

            $.ajax({
                url: "{{ route('suppliers.store') }}" + '/' + id,
                type: "POST",
                data: {
                    id: id,
                    title: title,
                    description: description
                },
                dataType: 'json',
            });

        });
        //Edit modal window
    </script>
@endsection
