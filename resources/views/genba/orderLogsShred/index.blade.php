@extends("layouts.main")
@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
    <div class="page-wrapper">

        <div class="page-content">
            @include('common.breadcrumb')
           
            @include('common.message')

            <hr />

       
            @include('common.dataTable')

        </div>
    </div>
@endsection
@section('script')
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table dropdownTable">
                                    <tr>
                                        <td style="width: 250px">{{ __('logsShred.code') }} :</td>
                                        <td><label for="code" id="code" class="form-label"></label></td>
                                        <td style="width: 250px">{{ __('logsShred.cName') }}  :</td>
                                        <td><label for="cName" id="cName" class="form-label"></label></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('logsShred.productSku') }} :</td>
                                        <td><label for="sku" id="sku" class="form-label"></label></td>      
                                        <td>{{ __('logsShred.cEmail') }} :</td>
                                        <td><label for="cEmail" id="cEmail" class="form-label"></label></td>      
                                    </tr> 
                                    <tr>
                                        <td>{{ __('logsShred.genbaCreated') }} :</td>
                                        <td><label for="genbaCreated" id="genbaCreated" class="form-label"></label></td>
                                        <td>{{ __('logsShred.cPhone') }} :</td>
                                        <td><label for="cPhone" id="cPhone" class="form-label"></label></td>      
                                    </tr>
                                    <tr>
                                        <td>{{ __('logsShred.clientTransId') }} :</td>
                                        <td><label for="clientTransId" id="clientTransId" class="form-label"></label></td> 
                                        <td>{{ __('logsShred.cIp') }} :</td>
                                        <td><label for="cIp" id="cIp" class="form-label"></label></td> 
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><label for="" id="" class="form-label"></label></td> 
                                        <td>{{ __('logsShred.cId') }} :</td>
                                        <td><label for="cId" id="cId" class="form-label"></label></td> 
                                    </tr>
                                </table>
                            </script>

   
<script>
    $('.yajra-datatable tbody').on('click', '.details-controls', function() {
        var template = Handlebars.compile($("#details-template").html());
  
        var tr = $(this).closest('tr');
        var row = $('.yajra-datatable').DataTable().row( tr );
        var id = $(this).data('id');
        $.get("{{ route('genbaOrderLogsShred.index') }}" + '/' + id, function(data) {
 
            $('#id').text(data.id);
            $('#code').text(data.code);
            $('#sku').text(data.sku);
            $('#genbaCreated').text(data.genbaCreated);
            $('#clientTransId').text(data.clientTransId);
            // $('#cName').text(data.cName);
            // $('#cEmail').text(data.cEmail);
            $('#cIp').text(data.cIp);
            $('#cId').text(data.cId);
            // $('#cPhone').text(data.cPhone);
            


           
        });

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( template(row.data()) ).show();
            tr.addClass('shown');
        }

    });
</script>

@endsection
