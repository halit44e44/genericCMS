<div class="card">

    <div class="card-body">

        <table class="table table-bordered yajra-datatable table-striped table-bordered">
            <thead>
                <tr>
                    @foreach ($data['dataTable']['columnsTitles'] as $value)

                        <th>{{ $value }}</th>
                    @endforeach
                    <th>{{ __('dataTable.tableAction') }}</th>
                </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<?php if($data['dataTable']['popup']){?>
<script>
    var routeUrl = "<?php echo $data['dataTable']['route']; ?>";

    $('body').on('click', '.edit', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.get(routeUrl + '/' + id, function(data) {
            $.each(data, function(index, item) {
                if (typeof item == 'object') {
                    if ($.isArray(item)) {
                        $.each(item, function(index, item) {
                            $('#' + index).empty();
                            $.each(item, function(index, item) {
                                if (index != 'id') {
                                    $('#' + index).append(item + '\n');
                                }
                            })
                        });

                    } else {
                        $.each(item, function(index, item) {
                            if ($('#' + index).is('input[type="checkbox"]' ||
                                    'input[type="radio"]')) {
                                item == true ? $('#' + index).prop('checked', item) &&
                                    $('#' + index).addClass('active') : $('#' + index)
                                    .prop('checked', item) && $('#' + index)
                                    .removeClass('active');
                            }
                            $('#' + index).val(item);
                        });
                    }
                } else if ($('#' + index).is('input[type="checkbox"]' ||
                        'input[type="radio"]')) {
                    item == true ? $('#' + index).prop('checked', item) && $('#' + index)
                        .addClass('active') : $('#' + index).prop('checked', item) && $('#' +
                            index).removeClass('active');
                } else {
                    $('#' + index).val(item);
                }
            });
            $('#submit').val("Edit Companies");
            $('#modal-id').modal('show');
            $('#id').val(data.id);
            // console.log(data);
            // $('#modal-id').modal('show');
            // $('#id').val(data.id);
            // $('#title').val(data.title);
            // $('#description').val(data.description);
            // $('#statusIn').prop('checked', data.status);
            // $('#price').val(data.price);
            // $('#stock_code').val(data.stock_code);
            // $('#old_id').val(data.old_id);
            // $('#imgUrl').val(data.imgUrl);
            // $('#accounting_code').val(data.accounting_code);
        })
    });
</script>
<?php }?>

<script>
    $(function() {

        var source = '<?php echo $data['dataTable']['source']; ?>';
        var queryId = '<?php echo isset($data['dataTable']['queryId']) ? $data['dataTable']['queryId'] : null; ?>';
        var columnsStr = '<?php echo json_encode($data['dataTable']['columns']); ?>';
        var id='<?php if(isset( $data['dataTable']['id'])){ echo $data['dataTable']['id'];}else{echo '';}?>';
        var status='<?php if(isset( $data['dataTable']['status'])){ echo $data['dataTable']['status'];}else{echo '';}?>';

        var columnsArr = JSON.parse(columnsStr);

        var tempArr = [];
        $.each(columnsArr, function(index, item) {
            tempArr.push({
                data: item,
                name: item
            });
        });
        tempArr.push({
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        });
        $.fn.dataTableExt.sErrMode = 'throw';
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            createdRow: function(row) {
                $(row).addClass("label-warning");
            },
            ajax: {
                url: "{{ route('getAjaxData') }}",
                data: {
                    model: source,
                    queryId: queryId,
                    id:id,
                    status:status
                }
            },
            
            columns: tempArr,
        });

    });

    //delete
    $(function() {
        $('body').on('click', '.delete', function(event) {
            event.preventDefault();
            // var _self = $(this);
            var title;
            var id = $(this).data('id');
            var routeUrl = "<?php echo $data['dataTable']['route']; ?>";
            var titleField = "<?php echo $data['dataTable']['delete']['titleField']; ?>";
            $.get(routeUrl + '/' + id, function(data) {
                id = data.id;
                if (titleField == 'title') {
                    title = data.title;
                } else {
                    title = data.name;
                }

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
                                url: routeUrl + "/" + id,
                                type: 'DELETE',
                                data: {
                                    _token: token,
                                    id: id,
                                },
                            });
                            swal("Deleted!", {
                                icon: "info",

                            });
                            // _self.closest("tr").remove();
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

<script>

    $(function() {
        // console.log($('#formshow').remove());
        $('#form').closest('td').css('display', 'flex');
    });

    $('.yajra-datatable tbody').on('click', '.details-control', function() {
        var template = Handlebars.compile($("#details-template").html());
        // var _self = this;
        // // if($(this).closest('tr').after())
        // $('.open-modal').remove();
        // if($(this).closest('tr').hasClass('shown')) {
        //     $('.open-modal').remove();
        //     $(this).closest('tr').removeClass('shown');
        // } else {
        //     $(this).closest('tr').after('<label class="open-modal">Fiyat : </label><label id="total_price" class="open-modal"></label><br>');
        //     $(this).closest('tr').after('<label class="open-modal">Single : </label><label id="single_price" class="open-modal"></label>');
        //     $('tr').removeClass('shown');
        //     $(this).closest('tr').addClass('shown');
        // }

        // var totalPrice;
        var tr = $(this).closest('tr');
        var row = $('.yajra-datatable').DataTable().row( tr );
        var id = $(this).data('id');
        $.get("{{ route('transactions.index') }}" + '/' + id, function(data) {
            // $('#modal-id').modal('show');
            // alert(data.total_price);
            $('#id').text(data.id);
            $('#soldCodes').text(data.soldCodes);
            // $('#single_price').text(data.single_price);
            $('#percentage').text(data.percentage);
            $('#percentage_single_price').text(data.percentage_single_price);
            $('#percentage_total_price').text(data.percentage_total_price);
            $('#cName').text(data.cName);
            $('#cEmail').text(data.cEmail);
            $('#cPhone').text(data.cPhone);
            $('#cIp').text(data.cIp);
           
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

        // console.log($(this).closest('tr').next().addClass('active'));
    });
</script>
