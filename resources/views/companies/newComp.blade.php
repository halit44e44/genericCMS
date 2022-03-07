<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form class="custom-form" id="companyForm" name="companyForm" action="{{ route('companies.store') }}" method="POST">

                <div class="modal-header mb-2">
                    <h4 class="modal-title" id="modelHeading">{{ __('company.formHeading') }}</h4>
                </div>
                <div class="row modal-bottom" style="margin-right: 0; margin-left: 0;">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kurum</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">API</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">IP</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    @csrf
                                    <div class="add-page col-lg-12 ">
                                        <div class="border border-top-0 p-3 rounded mb-2 mt-2">
                                            <div class="mb-0">
                                                <input type="hidden" name="id" class="form-control" id="id" required>
                                            </div>
                                            <div class="mb-5 row">
                                                <div class="col-lg-7">
                                                    <label for="title" class="form-label">{{ __('company.labelTitle') }}</label>
                                                    <input type="text" name="title"  class="form-control" id="title" placeholder="{{ __('company.titlePlaceholder') }}" required>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="accountingCode" class="form-label">{{ __('company.accountingCode') }}</label>
                                                    <input type="text" name="accountingCode" class="form-control" id="accountingCode" placeholder="{{ __('company.accountingCodePlaceholder') }}">
                                                </div>
                                                <div class="form-check form-switch col-lg-2">
                                                    <label class="form-check-label row" for="isActive">{{ __('company.isActive') }}</label>
                                                    <div class="radio-custom col-lg-12">
                                                        <input class="form-check-input" type="checkbox" name="isActive" id="isActive" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-5 row">
                                                <div class="col-lg-2">
                                                    <label for="maxTransactionLimit" class="form-label">{{ __('company.processLimit')}}</label>
                                                    <input type="text" name="maxTransactionLimit" class="form-control " id="maxTransactionLimit" placeholder="{{ __('company.processLimitPlaceholder')}}" >
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="percentage" class="form-label">{{ __('company.percentItem')}}</label>
                                                    <input type="text" name="percentage" class="form-control" id="percentage" placeholder="{{ __('company.percentItemPlaceholder')}}" >
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="limitControl" class="form-label">{{ __('company.limitControl')}}</label>
                                                    <input type="text" name="limitControl" class="form-control" id="limitControl" placeholder="{{ __('company.limitControlPlaceholder')}}" >
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="ballance" class="form-label">{{ __('company.ballanceItem')}}</label>
                                                    <input type="text" name="ballance" class="form-control" id="ballance" placeholder="{{ __('company.ballanceItemPlaceholder')}}" >
                                                </div>
                                            </div>

                                            <div class="mb-5 radio-custom-group row">
                                                <div class="form-check form-switch radio-custom-item">
                                                    <input class="form-check-input" name="constantPercentage" type="checkbox" id="constantPercentage">
                                                    <label class="form-check-label" for="constantPercentage">{{ __('company.constantPercentItem')}}</label>
                                                </div>
                                                <div class="form-check form-switch radio-custom-item">
                                                    <input class="form-check-input" value="smsmsmsmsmsmsms" name="sms" type="checkbox" id="sms">
                                                    <label class="form-check-label" for="sms">{{ __('company.smsItem')}}</label>
                                                </div>
                                                <div class="form-check form-switch radio-custom-item">
                                                    <input class="form-check-input" name="mail" type="checkbox" id="mail">
                                                    <label class="form-check-label" for="mail">{{ __('company.mailItem')}}</label>
                                                </div>
                                                <div class="form-check form-switch radio-custom-item">
                                                    <input class="form-check-input" name="unlimited" type="checkbox" id="unlimited">
                                                    <label class="form-check-label" for="unlimited">{{ __('company.unlimitedItem')}}</label>
                                                </div>
                                                <div class="form-check form-switch radio-custom-item">
                                                    <input class="form-check-input" name="preOrders" type="checkbox" id="preOrders">
                                                    <label class="form-check-label" for="preOrders">{{ __('company.threeHundredOneItem')}}</label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">{{ __('company.labelDescription') }}</label>
                                                <input type="text" name="description" class="form-control" id="description" placeholder="{{ __('company.descriptionPlaceholder') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">{{ __('company.labelEmail') }}</label>
                                                <input type="text" name="email" class="form-control" id="email" placeholder="{{ __('company.emailPlaceholder') }}" required>
                                            </div>
                                            {{-- <div class="mb-3">
                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success"
                                                data-offstyle="danger">
                                        </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="add-page col-lg-12 ">
                                        <div class="border border-top-0 p-3 rounded mb-2 mt-2">
                                            <div class="mb-5 row">
                                                <div class="col-lg-10">
                                                    <label for="authorization" class="form-label">{{ __('company.authorizationItem') }}</label>
                                                    <input type="text" name="authorization" class="form-control" id="authorization" placeholder="{{ __('company.authorizationItemPlaceholder') }}" >
                                                </div>
                                            </div>
                                            <div class="mb-5 row">
                                                <div class="col-lg-6">
                                                    <label for="api_name" class="form-label">{{ __('company.apiNameItem') }}</label>
                                                    <input type="text" name="api_name" class="form-control" id="api_name" placeholder="{{ __('company.apiNameItemPlaceholder') }}" >
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="api_key" class="form-label">{{ __('company.apiKeyItem') }}</label>
                                                    <input type="text" name="api_key" class="form-control" data-prop="" id="api_key" placeholder="{{ __('company.apiKeyItemPlaceholder') }}" >
                                                </div>
                                            </div>

                                            <div class="seperator-item">
                                                <p>{{ __('company.notiSeperator') }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <label for="feedback_url" class="form-label">{{ __('company.feedbackItem') }}</label>
                                                <input type="text" name="feedback_url" class="form-control" id="feedback_url" placeholder="{{ __('company.feedbackItemPlaceholder') }}" >
                                            </div>

                                            <div class="mb-3">
                                                <label for="client_id" class="form-label">{{ __('company.clientIdItem') }}</label>
                                                <input type="text" name="client_id" class="form-control" id="client_id" placeholder="{{ __('company.clientIdItemPlaceholder') }}" >
                                            </div>

                                            <div class="mb-3">
                                                <label for="client_key" class="form-label">{{ __('company.clientKeyItem') }}</label>
                                                <input type="text" name="client_key" class="form-control" id="client_key" placeholder="{{ __('company.clientKeyItemPlaceholder') }}" >
                                            </div>

                                            {{-- <div class="mb-3">
                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success"
                                                data-offstyle="danger">
                                        </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="add-page col-lg-12 ">
                                        <div class="border border-top-0 p-3 rounded mb-2 mt-2">
                                            <div class="row">
                                                <div class="col-lg-12 text-area-block">
                                                    <label for="ip" class="form-label">{{ __('company.definedIpItem') }}</label>
                                                    <textarea id="ip" class="custom-text-area" rows="4" cols="50" name="ip" placeholder="{{ __('company.definedIpItemPlaceholder') }}"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                </div>
                                            </div>
                                            {{-- <div class="mb-3">
                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success"
                                                data-offstyle="danger">
                                        </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-light">{{ __('company.btnSave') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>