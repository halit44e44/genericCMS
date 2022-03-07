@extends("layouts.main")
@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">

            @include('common.breadcrumb')

            <div class="ms-auto">
                <div class="btn-group">  <a href="{{ route('epinStocks.create') }}">
                    <button type="button" class="btn btn-outline-success btnNew">{{ __('epinStocks.addNew') }}</button></a>
                </div>
            </div>

            @include('common.message')
            <hr />
            @include('common.dataTable')


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
                url: "{{ route('epinStocks.store') }}" + '/' + id,
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
