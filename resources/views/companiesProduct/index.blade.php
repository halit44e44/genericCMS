@extends("layouts.main")
@section('style')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<style>
    table>tbody>tr>td>.multiple-btn {
        font-size: 44px;
    }
</style>
@endsection
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="dropdown-container">
            <select class="form-select mb-3" aria-label="Default select example">
                @foreach ($companies as $companies)
                <option value="1">{{ $companies->title }}</option>
                @endforeach
            </select>
        </div>
        <form method="POST" action="{{route('companiesProduct.store')}}" class="card product-form">
            @csrf
            <div class="card-body">
                <div class="option-block" style="padding: .5rem .5rem;">
                    <!-- <input style="padding: .5rem .5rem;" class="form-check-input" name="selectAll" type="checkbox" id="selectAll"> -->
                    <div class="" style="display: flex; justify-content: flex-end">
                        <input type="text" id="filterInput" style="width: auto; background-color: transparent; color: white;" placeholder="Ürün Ara" class="mr-2 form-control">
                        <div class="multiple-btn btn btn-light mr-2" style="display: flex; align-items: center; padding: .3rem .3rem; font-size: .8rem;">Çoklu seçim</div>
                        <div id="selectAll" class="btn btn-light" style="display: flex; align-items: center; padding: .3rem .3rem; font-size: .8rem;">Tümünü kaldır</div>
                    </div>
                </div>
                <table id="content-table" class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Ürün</th>
                            <th scope="col">Yüzde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" id="companyId" name="companyId" value="{{$companyId}}">
                        @if ($products)
                        @foreach ($products as $product=>$value)
                        @php $flag = false; $percentage; @endphp
                        @if(isset($companyProduct))
                        @foreach ($companyProduct as $key=>$value2)
                        @if ($value2->company_id == $companyId && $value2->product_id == $value->id)
                        @php $flag = true; $percentage=$value2->percentage; $productId=$value2->id @endphp

                        @endif
                        @endforeach
                        @endif
                        <tr>
                            <td scope="row form-check" style="vertical-align: middle;">
                                <input type="hidden" class="hidden-input" name="{{$value->id}}" value="{{$value->id}}">
                                @if($flag)
                                <input class="form-check-input product-item" data-name="{{ $value->title }}" data-id="{{$productId}}" name="cbItem{{$value->id}}" checked type="checkbox" id="cbItem{{$value->id}}">
                                @else
                                <input class="form-check-input product-item" data-name="{{ $value->title }}" name="cbItem{{$value->id}}" type="checkbox" id="cbItem{{$value->id}}">
                                @endif
                                <label class="form-check-label" for="cbItem{{$value->id}}">{{ $value->title }}</label>
                            </td>
                            <td>
                                @if($flag)
                                <input class="form-control percent-item" value="{{$percentage}}" type="number" min="0" max="100" id="percentItem{{$value->id}}" name="percentItem{{$value->id}}" placeholder="Default input" aria-label="default input example">
                                @else
                                <input class="form-control percent-item" type="number" min="0" max="100" id="percentItem{{$value->id}}" disabled name="percentItem{{$value->id}}" placeholder="Default input" aria-label="default input example">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif

                    </tbody>
                </table>
                <!-- <button type="submit" class="btn mt-3 btn-primary">Güncelle</button> -->
            </div>
        </form>
        <div class="modal fade" id="multipleSetterModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header mb-2">
                        <h4 class="modal-title" id="modelHeading">Çoklu işlem</h4>
                        <div class="d-flex align-items-center">
                            <input type="text" id="filterModalInput" style="width: auto; background-color: transparent; color: white;" placeholder="Ürün Ara" class="mr-2 form-control">
                            <input type="checkbox" style="font-size: 12px;" id="selectAllBtn" class="multiple-btn btn btn-light mr-2">
                            <label for="selectAllBtn">Tümünü seç</label>
                        </div>
                    </div>
                    <div class="modal-bottom container" id="multipleSelectBlock" style="padding: 15px;">
                        <div class="content-block row" style="max-height: 500px; overflow-y: scroll">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {

        var token = $("meta[name='csrf-token']").attr("content");
        var sendTimer;
        var isModalSetter = false;
        var sendTimeOut = 600;
        var isAllSelect = false;

        $('.percent-item').on('keyup', function(e) {
            var _self = $(this);
            clearTimeout(sendTimer);
            if (parseInt(e.target.value) > 100 && e.which != 8) {
                e.target.value = 100;
                e.preventDefault();
            }
            var productId = $(this).parent('td').prev('td').children('input[type="hidden"]').val();
            var companyId = $('#companyId').val();
            var percentage = $(this).val();
            var isActive = $(this).parent('td').prev('td').children('input[type="checkbox"]').prop('checked');
            sendTimer = setTimeout(function() {
                if (percentage) {
                    var data = {
                        'isActive': isActive,
                        'company_id': companyId,
                        'product_id': productId,
                        'percentage': percentage,
                    };
                    $.ajax({
                        url: "saveCompanyProduct",
                        type: "POST",
                        data: {
                            _token: token,
                            data,
                        },
                        success: function(e) {
                            _self.parent('td').prev('td').children('input[type="checkbox"]').data("id", e.id);
                            var animationEvent = 'webkitAnimationEnd oanimationend msAnimationEnd animationend';
                            _self.addClass('successOut');
                            _self.one(animationEvent, function(event) {
                                _self.removeClass('successOut');
                            });
                        }
                    });
                }
            }, sendTimeOut);
        });

        $('.percent-item').on('keydown', function() {
            clearTimeout(sendTimer);
        });

        $('.product-item').on('click', function() {
            var _self = this;
            var isActive = $(this).prop('checked');
            if (isActive) {
                var isAllChecked = true;
                $(this).parent('td').next('td').find('input[type="number"]').prop('disabled', false);
                $('.product-item').map((index, item) => {
                    if (!$(item).prop('checked')) {
                        isAllChecked = false;
                        return false;
                    }
                });
                if (isAllChecked) {
                    $('#selectAll').prop('checked', true);
                }
            } else {
                $('#selectAll').prop('checked', false);
                var id = $(this).data("id");
                var data = {
                    _token: token,
                    isActive: false,
                    id,
                    id
                };

                $(this).parent('td').next('td').find('input[type="number"]').prop('disabled', true);
                $(this).parent('td').next('td').find('input[type="number"]').val('');
                $.ajax({
                    url: "saveCompanyProduct",
                    type: "POST",
                    data: data,
                });
            }
        });

        $('#selectAll').on('click', function() {

            swal({
                title: "Bu işlemi onayladığınız da bütün ürünler kapatılacaktır.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    $('.product-item').map((index, item) => {
                        $(item).prop('checked', true);
                        $(item).trigger('click');
                    });
                }
            });
        });

        fillModalTable = () => {

            var modal = $('#multipleSetterModal');
            var inputItems = $('.product-item');
            var labelItems = $('.product-item').next('label');
            var childContainer = $('#multipleSelectBlock');
            var childBlock = $('#multipleSelectBlock .content-block');
            inputItems && inputItems.map((index, item) => {
                childBlock.append(
                    "<div style='display: flex; margin: 10px 0' class='col-lg-4 modal-item' ><input style='width: 1.5em; height: 1.5em; margin-top: 0;' type='checkbox' data-id='" + $(item).prop('id') + "' name='" + $(item).prop('id') + index + "' id='" + $(item).prop('id') + index + "' class='multiple-input' >" +
                    "<label style='margin-left: 5px' for='" + $(item).prop('id') + index + "'> " + $(item).data("name") + " </label></div>"
                );
            });
            childContainer.append('<div style="display: flex; margin-top: 30px" class="col-lg-12" ><input class="form-control" type="number" id="setMultipleValue" placeholder="Deger girin"></div>' +
                '<div style="display: flex; margin-top: 15px" class="col-lg-12" ><button style="width: 100%" class="btn btn-light" id="setMultipleBtn">Send</button></div>'
            );

        }
        fillModalTable();

        $('#multipleSelectBlock').on('click', '#setMultipleBtn', function() {
            var inputValue = $('#setMultipleValue').val();
            isModalSetter = !isModalSetter;
            setData(inputValue);
            isModalSetter = !isModalSetter;
            $('#multipleSetterModal').modal('hide');
            $('#multipleSelectBlock input').val('');
            $('#multipleSelectBlock input[type="checkbox"]').prop('checked', false);
            $('#filterModalInput').val('');
        });

        function setData(inputValue) {
            if (inputValue >= 100) {
                inputValue = 100;
            }
            $('.multiple-input') && $('.multiple-input').map((index, item) => {

                if ($(item).prop('checked')) {
                    if (!$('#' + $(item).data('id')).prop('checked')) {
                        $('#' + $(item).data('id')).trigger('click');
                    }
                    $('#' + $(item).data('id')).parent('td').next('td').find('input[type="number"]').val(inputValue);
                    var productId = $('#' + $(item).data('id')).parent('td').children('input[type="hidden"]').val();
                    var companyId = $('#companyId').val();
                    var percentage = inputValue;
                    var isActive = $('#' + $(item).data('id')).parent('td').children('input[type="checkbox"]').prop('checked');
                    if (inputValue) {
                        var data = {
                            'isActive': isActive,
                            'company_id': companyId,
                            'product_id': productId,
                            'percentage': percentage,
                        };
                        $.ajax({
                            url: "saveCompanyProduct",
                            type: "POST",
                            data: {
                                _token: token,
                                data,
                            },
                            success: function(e) {
                                $('#' + $(item).data('id')).parent('td').children('input[type="checkbox"]').data("id", e);
                                var animationEvent = 'webkitAnimationEnd oanimationend msAnimationEnd animationend';
                                $('#' + $(item).data('id')).parent('td').next('td').find('input[type="number"]').addClass('successOut');
                                $('#' + $(item).data('id')).parent('td').next('td').find('input[type="number"]').one(animationEvent, function(event) {
                                    $('#' + $(item).data('id')).parent('td').next('td').find('input[type="number"]').removeClass('successOut')
                                });
                            }
                        });
                    }
                }
            });
        }

        $('.multiple-btn').click(function() {
            $('#multipleSetterModal').modal('show');
        });

        $('#selectAllBtn').on('click', function() {
            var isChecked = $(this).prop('checked');
            $('.multiple-input') && $('.multiple-input').map(function(index, item) {
                $(item).prop('checked', isChecked)
            });
        });

        $('#setMultipleValue').on('keyup', function(e) {
            if (parseInt(e.target.value) > 100 && e.which != 8) {
                e.target.value = 100;
                e.preventDefault();
            }
        });

        $('#filterInput').on('keyup', function() {
            var input, filter, tbody, tr, a, i, txtValue;
            input = $(this);
            filter = input.val().toUpperCase();
            tbody = $('#content-table tbody');
            tr = $('#content-table tbody tr');
            for (i = 0; i < tr.length; i++) {
                console.log("asdf")
                labelText = tr[i].getElementsByTagName('td')[0].getElementsByTagName('label')[0];
                txtValue = labelText.textContent || labelText.innerText;
                console.log(filter);
                console.log(txtValue.toUpperCase());
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        });
        $('#filterModalInput').on('keyup', function() {
            var input, filter, tbody, tr, a, i, txtValue;
            console.log("alşsdmfkamsdf");
            input = $(this);
            filter = input.val().toUpperCase();
            tbody = $('.content-block');
            tr = $('.content-block .modal-item');
            for (i = 0; i < tr.length; i++) {
                labelText = tr[i].getElementsByTagName('label')[0];
                txtValue = labelText.textContent || labelText.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        });
    });
</script>
@endsection