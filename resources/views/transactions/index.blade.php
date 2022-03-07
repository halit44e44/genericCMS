@extends("layouts.main")
@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('wrapper')
    <div class="page-wrapper">

        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"><a href="/transactions"><i class='bx bx-layer font-18 me-1'></i> {{__('transaction.mainTitle')}}</a></div>
            
                <div class="ps-3">
                    
                </div>
            
            </div>
            @include('common.message')

            <hr />

            <div class="card-body">
                <ul class="nav nav-tabs mb-0" role="tablist">
                    <li class="nav-item waitBtn" role="presentation">
                        <a class="nav-link custom-tab position-relative" dataurl="103" type="submit" href="/resetNote?status=103" role="tab"
                            aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-rotate-right font-18 me-1'></i>
                                </div>
                                <div class="tab-title" id="div-wait">Onay Bekleyen İşlemler</div>

                                <label for="wait" class="alert-count"
                                    style="position: absolute; top: 0; left: auto; right: 0;"
                                    id="wait">{{ $flags[0]->note }}
                                </label>
                                </span>
                            </div>

                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link custom-tab" href="/resetNote?status=100" dataurl="100" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-check-double font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Başarılı İşlemler</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link custom-tab meta-data" href="/transactions?status=111" dataurl="111" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-block font-18 me-1'></i>
                                </div>
                                <div class="tab-title">İptal Edilen İşlemler</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link custom-tab position-relative" href="/resetNote?status=301" dataurl="301" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-time font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Ön Siparişler</div>
                                <span class="alert-count preorder" style="position: absolute; top: 0; left: auto; right: 0;"
                                    id="alert-preorder">{{ $flags[1]->note }}</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            @include('common.dataTable')

        </div>
    </div>
@endsection
@section('script')
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table dropdownTable">
                                    <tr>
                                        <td style="width: 250px">{{ __('transaction.code') }} :</td>
                                        <td><label for="soldCodes" id="soldCodes" class="form-label"></label></td>
                                        <td style="width: 250px">{{ __('transaction.cName') }}  :</td>
                                        <td><label for="cName" id="cName" class="form-label"></label></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('transaction.percentage') }} :</td>
                                        <td><label for="Percantage" id="percentage" class="form-label"></label></td>      
                                        <td>{{ __('transaction.cEmail') }} :</td>
                                        <td><label for="cEmail" id="cEmail" class="form-label"></label></td>      
                                    </tr> 
                                    <tr>
                                        <td>{{ __('transaction.percentageSp') }} :</td>
                                        <td><label for="percentage_single_price" id="percentage_single_price" class="form-label"></label></td>
                                        <td>{{ __('transaction.cPhone') }} :</td>
                                        <td><label for="cPhone" id="cPhone" class="form-label"></label></td>      
                                    </tr>
                                    <tr>
                                        <td>{{ __('transaction.percentageTp') }} :</td>
                                        <td><label for="percentage_total_price" id="percentage_total_price" class="form-label"></label></td> 
                                        <td>{{ __('transaction.cIp') }} :</td>
                                        <td><label for="cIp" id="cIp" class="form-label"></label></td> 
                                    </tr>
                                </table>
                            </script>

    {{-- <script>
    $('body').on('click', '.details-control', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.get("{{ route('transactions.index') }}" + '/' + id, function(data) {
            // $('#modal-id').modal('show');
            // alert(data.total_price);
            $('#id').text(data.id);
            $('#total_price').text(data.total_price);
            $('#conversationId').text(data.conversationId);
        
   

        })
    });
</script> --}}
    <script>
        //panel music
        var isPlayed = false;
        var audio = {};
        audio["pikachu"] = new Audio();
        audio["pikachu"].src = "api-panel2.mp3";

        setInterval(function() {
            var test = $.ajax({
                type: "GET",
                url: "{{ route('flagStatus.index') }}",
                datatype: "json",

                success: function(data) {

                    data && data.map((key, index) => {
                        if (key.value == 1 && key.keys == 'wait') {

                            key.note++;
                            $('#btnPika').trigger('click');
                            $('#wait').html(key.note);
                            audio["pikachu"].play();

                            $('.yajra-datatable').DataTable().ajax.reload();
                        } else if (key.value == 1 && key.keys == 'preorder') {

                            key.note++;
                            $('#btnPika').trigger('click');
                            $('#alert-preorder').html(key.note);
                            audio["pikachu"].play();

                            $('.yajra-datatable').DataTable().ajax.reload();
                        } else if (key.value == 1 && key.keys == 'success') {
                            $('.yajra-datatable').DataTable().ajax.reload();
                        }
                    });
                }
            });

        }, 3000); //time in milliseconds 


        $('#btnPika').on('click', function() {
            $(audio["pikachu"]).muted = false;
            audio["pikachu"].play();
            $(audio["pikachu"]).muted = true;
            audio["pikachu"].play();
        });

        $(function() {

            $(window).on('load', function() {
                var currentUrl = window.location.search;
                if(currentUrl.indexOf('status=') > 0) {
                    var number = currentUrl.split('?status=')[1];
                    $('.custom-tab').map(function(index, item) {
                        if(number === $(item).attr('dataurl')) {
                            $(item).addClass('active');
                        }
                    });
                }
            })
        })
        
    </script>

@endsection
