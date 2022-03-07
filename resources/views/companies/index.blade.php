@extends("layouts.main")
@section('style')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ __('company.mainTitle') }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    {{-- <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                        </ol> --}}
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-success btnNew" id="createNewCompany">{{ __('company.create') }}</button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif
        {{-- <h6 class="mb-0 text-uppercase">{{ __('company.mainTitle') }}</h6> --}}
        <hr />
        @include('common.message')

        @include('common.dataTable')
        @include("companies.newComp")
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
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                // {
                //     data: 'status',
                //     name: 'status',
                // },
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
    $('#createNewCompany').click(function() {
        $('#submit').val("create-company");
        $('#id').val('');
        $('#title').val('');
        $('#description').val('');
        $('#email').val('');
        // $('#status').val('');
        $('#companyForm').trigger("reset");
        $('#modal-id').modal('show');
    });

    //save
    $('body').on('click', '#submit', function(event) {
        event.preventDefault();

        var id = $("#id").val();
        var title = $("#title").val();
        var description = $("#description").val();
        var email = $("#email").val();
        // var status = $("#status").val();
        $.ajax({
            url: "{{ route('companies.store') }}" + '/' + id,
            type: "POST",
            data: {
                id: id,
                title: title,
                description: description,
                email: email,
                // status: status
            },
            dataType: 'json',
        });
    });
    //Edit modal window
    // $('body').on('click', '.edit', function(event) {
    //     event.preventDefault();
    //     var id = $(this).data('id');
    //     $.get("{{ route('companies.index') }}" + '/' + id, function(data) {
    //         $.each(data, function(index, item) {
    //             if (typeof item == 'object') {
    //                 if ($.isArray(item)) {
    //                     $.each(item, function(index, item) {
    //                         $('#' + index).empty();
    //                         $.each(item, function(index, item) {
    //                             if (index != 'id') {
    //                                 $('#' + index).append(item + '\n');
    //                             }
    //                         })
    //                     });

    //                 } else {
    //                     $.each(item, function(index, item) {
    //                         if ($('#' + index).is('input[type="checkbox"]' || 'input[type="radio"]')) {
    //                             item == true ? $('#' + index).prop('checked', item) && $('#' + index).addClass('active') : $('#' + index).prop('checked', item) && $('#' + index).removeClass('active');
    //                         }
    //                         $('#' + index).val(item);
    //                     });
    //                 }
    //             } else if ($('#' + index).is('input[type="checkbox"]' || 'input[type="radio"]')) {
    //                 item == true ? $('#' + index).prop('checked', item) && $('#' + index).addClass('active') : $('#' + index).prop('checked', item) && $('#' + index).removeClass('active');
    //             } else {
    //                 $('#' + index).val(item);
    //             }
    //         });
    //         $('#submit').val("Edit Companies");
    //         $('#modal-id').modal('show');
    //         $('#id').val(data.id);
    //         $('#title').val(data.title);
    //         $('#description').val(data.description);
    //         $('#email').val(data.email);
    //         $('#accountingCode').val(data.accountingCode);
    //         $('#ballanceItem').val(data.ballance);
    //         $('#limitControl').val(data.limitControl);
    //         $('#processLimit').val(data.maxTransactionLimit);
    //         $('#percentItem').val(data.percentage);
    //         $('#authorizationItem').val(data.company_api.authorization);
    //         $('#apiNameItem').val(data.company_api.api_name);
    //         $('#apiKeyItem').val(data.company_api.api_key);
    //         $('#feedbackItem').val(data.company_api.feedback_url);
    //         $('#clientIdItem').val(data.company_api.client_id);
    //         $('#clientKeyItem').val(data.company_api.client_key);
    //         data.isActive == true ? $('#isActive').prop('checked', data.isActive) && $('#isActive').addClass('active') : $('#isActive').prop('checked', data.isActive);
    //         data.constantPercentage == true ? $('#constantPercentItem').prop('checked', data.constantPercentage) && $('#constantPercentItem').addClass('active') : $('#constantPercentItem').prop('checked', data.constantPercentage);
    //         data.preOrders == true ? $('#threeHundredOneItem').prop('checked', data.preOrders) && $('#threeHundredOneItem').addClass('active') : $('#threeHundredOneItem').prop('checked', data.preOrders);
    //         data.sms == true ? $('#smsItem').prop('checked', data.sms) && $('#smsItem').addClass('active') : $('#smsItem').prop('checked', data.sms);
    //         data.mail == true ? $('#mailItem').prop('checked', data.mail) && $('#mailItem').addClass('active') : $('#mailItem').prop('checked', data.mail);
    //         data.unlimited == true ? $('#unlimitedItem').prop('checked', data.unlimited) && $('#unlimitedItem').addClass('active') : $('#unlimitedItem').prop('checked', data.unlimited);
    //         $('#status').val(data.status);
    //         data.company_ip.map((item, index) => {
    //             $('#definedIpItem').append(item.ip + '\n');
    //         });
    //     });

    // });
    //delete

    $(function() {

        $('body').on('click', '.delete', function(event) {
            event.preventDefault();
            var _self = $(this);
            var title;
            var id = $(this).data('id');
            $.get("{{ route('companies.index') }}" + '/' + id, function(data) {
                id = data.id;
                title = data.title;
                swal({
                        title: "Are you sure?",
                        text: title,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            //var id = $(this).data("id");
                            var token = $("meta[name='csrf-token']").attr("content");
                            $.ajax({
                                url: "companies/" + id,
                                type: 'DELETE',
                                data: {
                                    _token: token,
                                    id: id,
                                },

                            });
                            swal("Deleted!", {
                                icon: "info",
                            });
                            _self.closest('tr').remove();

                        }
                    });
            });
        });

        $('#bologna-list a').on('click', function(e) {
            e.preventDefault()
            $(this).tab('show')
        })
    })
</script>
@endsection