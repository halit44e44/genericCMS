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
                        id="createNewPlatform">{{ __('platform.create') }}</button>
                </div>
            </div>

        
            @include('common.message')
            <hr />
            @include('common.dataTable')
          
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header mb-2">
                            <h4 class="modal-title" id="modelHeading">{{ __('platform.formHeading') }}</h4>
                        </div>
                        <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                            <form id="platformForm" name="platformForm" action="{{ route('platforms.store') }}"
                                method="POST">
                                @csrf
                                <div class="add-page col-lg-12 ">
                                    <div class="border border-1 border-top-0 p-3 rounded mb-2">
                                        <div class="mb-2">
                                            <input type="hidden" name="id" class="form-control" id="id" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="name" class="form-label">{{ __('platform.labelName') }}</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="{{ __('platform.namePlaceholder') }}" required>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-light">{{ __('platform.btnSave') }}</button>
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
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });
            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getAjaxData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    // {
                    //     data: 'description',
                    //     name: 'description'
                    // },
                    // {data: 'imgUrl', name: 'imgUrl'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });
    </script>
    <script>
        //insert
        $('#createNewPlatform').click(function() {
            $('#submit').val("create-platform");
            $('#id').val('');
            $('#name').val('');
            // $('#description').val('');
            $('#platformForm').trigger("reset");
            $('#modal-id').modal('show');
        });
        //save
        $('body').on('click', '#submit', function(event) {
            event.preventDefault();

            var id = $("#id").val();
            var name = $("#name").val();
            // var description = $("#description").val();
            $.ajax({
                url: "{{ route('platforms.store') }}" + '/' + id,
                type: "POST",
                data: {
                    id: id,
                    name: name,

                },
                dataType: 'json',
            });

        });
        //Edit modal window
        $('body').on('click', '#edit', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.get("{{ route('platforms.index') }}" + '/' + id, function(data) {
                $('#submit').val("Edit Platform");
                $('#modal-id').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                // $('#description').val(data.description);
            })
        });
        //delete
        $(function() {
            $('body').on('click', '#delete', function(event) {
                event.preventDefault();
                var name;
                var id = $(this).data('id');
                $.get("{{ route('platforms.index') }}" + '/' + id, function(data) {
                    id = data.id;
                    name = data.name;
                    swal({
                            title: "Are you sure?",
                            text: name,
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                //var id = $(this).data("id");
                                var token = $("meta[name='csrf-token']").attr("content");
                                $.ajax({
                                    url: "platforms/" + id,
                                    type: 'DELETE',
                                    data: {
                                        _token: token,
                                        id: id,
                                    },
                                });
                                swal("Deleted!", {
                                    icon: "info",

                                });
                                location.reload();
                            }
                            // else {
                            //     swal("See you!");
                            // }
                        });
                });

            })
        })
    </script>
@endsection
