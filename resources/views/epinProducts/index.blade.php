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
                        id="createNewProduct">{{ __('product.create') }}</button>
                </div>
            </div>

            @include('common.message')
            <hr />
            @include('common.dataTable')


            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header mb-2">
                            <h4 class="modal-title" id="modelHeading">{{ __('product.formHeading') }}</h4>
                        </div>

                        <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                            <form id="productForm" name="productForm" action="{{ route('epinProducts.store') }}"
                                method="POST">
                                @csrf
                                <div class="add-page col-lg-12 ">
                                    <div class="border border-1 border-top-0 p-3 rounded mb-2">
                                        <div class="mb-2">

                                            <input type="hidden" name="id" class="form-control" id="id" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="old_id" class="form-label">{{ __('product.OldId') }}</label>
                                            <input type="text" name="old_id" class="form-control" id="old_id"
                                                placeholder="{{ __('product.OldId') }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="title" class="form-label">{{ __('product.labelTitle') }}</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="{{ __('product.titlePlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description"
                                                class="form-label">{{ __('product.labelDescription') }}</label>
                                            <input type="text" name="description" class="form-control" id="description"
                                                placeholder="{{ __('product.descriptionPlaceholder') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="statusIn" id="statusIn" value="1" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                       
                                        </div>
                                        <div class="mb-3">
                                            <label for="imgUrl"
                                                class="form-label">{{ __('product.ImgUrl') }}</label>
                                            <input type="text" name="imgUrl" class="form-control" id="imgUrl"
                                                placeholder="{{ __('product.ImgUrl') }}" required>
                                        </div>
                                        {{-- <div class="mb-3">
                                            <input type="file" name="imgUrl" class="form-control">                                       
                                        </div> --}}
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-light">{{ __('product.btnSave') }}</button>
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
        $('#createNewProduct').click(function() {
            
            $('#id').val('');
            $('#title').val('');
            $('#description').val('');
            // $('#imgUrl').val('');
            $('#status').val('');
            $('#productForm').trigger("reset");
            $('#modal-id').modal('show');
        });
        //save
        $('body').on('click', '#submit', function(event) {
            event.preventDefault();

            var id = $("#id").val();
            var title = $("#title").val();
            var description = $("#description").val();
            // var imgUrl = $("#imgUrl").val();
            var status = $("#status").val();

            $.ajax({
                url: "{{ route('epinProducts.store') }}" + '/' + id,
                type: "POST",
                data: {
                    id: id,
                    title: title,
                    description: description,
                    // imgUrl:imgUrl,
                    status:status

                },
                dataType: 'json',
            });

        });
        //Edit modal window
    </script>
@endsection
