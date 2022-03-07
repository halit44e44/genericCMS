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
                    <a href="{{ route('categories.create') }}">
                    <button type="button" class="btn btn-outline-success btnNew"
                        id="createNewCategory">{{ __('category.create') }}</button></a>
                </div>
            </div>
            @include('common.message')
            <hr />
            @include('common.dataTable')
            
            
          
        </div>
    </div>
@endsection
@section('script')
    
    
    
@endsection
