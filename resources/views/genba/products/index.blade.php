@extends("layouts.main")
@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            @include('common.breadcrumb')

            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('genbaProducts.create') }}">
                        <button type="button"
                            class="btn btn-outline-success btnNew">{{ __('genbaProduct.addNew') }}</button></a>
                </div>
            </div>

            <!--end breadcrumb-->
            @include('common.message')
            <hr />
            @include('common.dataTable')
            

        </div>
    </div>
@endsection
@section('script')
    
    <script>
        //Edit modal window
        // $('body').on('click', '#edit', function(event) {
        //     event.preventDefault();
        //     var id = $(this).data('id');

        //     $.get("{{ route('genres.index') }}" + '/' + id, function(data) {            
        //         $('#modal-id').modal('show');
        //         $('#id').val(data.id);
        //         $('#name').val(data.name);
        //         // $('#description').val(data.description);
        //     })
        // });
        //delete
        
    </script>
    <script>



    </script>
@endsection
