@extends("layouts.main")

@section('style')
    <link href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
@endsection

@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ __('category.mainTitle') }} </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('category.create') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">{{ __('category.create') }}</h5>
                    <hr />
                  
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-body mt-4">
                        <div class="row add-page">
                            <div class="col-lg-12">
                                <form action="{{ route('categories.store') }}" name="form" method="POST"
                                    class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            
                                            {{-- <select class="form-select mb-3" aria-label="Default select example" id="category_id" name="category_id">
									<option disabled selected>-- {{ __('category.categorySelect') }} --</option>
									@foreach ($categories as $category)
									<option value="{{$category->id}}">{{$category->title}}</option>
									@endforeach
								</select> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">{{ __('category.title') }}
                                                        *</label>
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        placeholder="{{ __('category.title') }}" required>
                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description"
                                                        class="form-label">{{ __('category.description') }} *</label>
                                                    <textarea class="form-control" id="description" rows="3"
                                                        name="description"
                                                        placeholder="{{ __('category.description') }}"
                                                        required></textarea>
                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label for="parent_id" class="form-label">{{ __('category.parent_id') }}
                                                        *</label>
                                                    <input type="text" name="parent_id" class="form-control" id="parent_id"
                                                        placeholder="{{ __('category.parent_id') }}" required>
                                                    
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="inputCategoryTitle"
                                                        class="form-label">{{ __('category.productTr') }}</label>
                                                    <input type="text" name="titleTr" class="form-control"
                                                        id="inputCategoryDescription"
                                                        placeholder="{{ __('category.titlePlaceTr') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputCategoryDescription"
                                                        class="form-label">{{ __('category.descriptionTr') }}</label>
                                                    <textarea class="form-control" id="inputCategoryDescription" rows="3"
                                                        name="descriptionTr"
                                                        placeholder="{{ __('category.descriptionPlaceTr') }}"></textarea>
                                                </div>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="mb-3">
                                            <label for="inputCategoryDescription"
                                                class="form-label">{{ __('category.image') }}</label>
                                            <input id="image-uploadify" name="imgUrl" type="file"
                                                accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf"
                                                multiple>
                                        </div> --}}
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-light" id="btnSubmit"
                                            name="btnSubmit">{{ __('category.btnSave') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')
    {{-- <script src="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
	<script>
		$(document).ready(function () {
			$('#image-uploadify').imageuploadify();
		})
		
	</script> --}}

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>


@endsection
