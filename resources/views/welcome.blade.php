@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
    <h2 class="card-label"> Selamat Datang, <strong> {{ Auth::user()->name }}!</strong></h2>

    <div class="row mt-5">
        @hasanyrole(['admin', 'opti'])
            <div class="col-xl-3">
                <a href="{{ route('mst_cbg_dist.index') }}">
                    <!--begin::Stats Widget 29-->
                    <div class="card card-custom bg-purple bg-hover-info-o-5 card-stretch gutter-b" <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-2x svg-icon-white">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span
                                class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $user }}</span>
                            <span class="font-weight-bold text-white font-size-sm">Master User</span>
                        </div>
                        <!--end::Body-->
                    </div>
                </a>
                <!--end::Stats Widget 29-->
            </div>
            <div class="col-xl-3">
                <a href="{{ route('mst_cbg_dist.index') }}">
                    <!--begin::Stats Widget 29-->
                    <div class="card card-custom bg-blue bg-hover-primary-o-2 card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-2x svg-icon-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z"
                                            fill="#000000" />
                                        <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1" />
                                        <path
                                            d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span
                                class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $cbg_dist }}</span>
                            <span class="font-weight-bold text-dark-50 font-size-sm">Master Cabang Distributor</span>
                        </div>
                        <!--end::Body-->
                    </div>
                </a>
                <!--end::Stats Widget 29-->
            </div>
            <div class="col-xl-3">
                <a href="{{ route('mst_cbg_ph.index') }}">
                    <!--begin::Stats Widget 30-->
                    <div class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-2x svg-icon-white">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z"
                                            fill="#000000" />
                                        <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1" />
                                        <path
                                            d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span
                                class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $cbg_ph }}</span>
                            <span class="font-weight-bold text-white font-size-sm">Master Cabang Phapros</span>
                        </div>
                        <!--end::Body-->
                    </div>
                </a>
                <!--end::Stats Widget 30-->
            </div>
        @endrole
        <div class="col-xl-3">
            <a href="{{ route('mst_cust_dist.index') }}">
                <!--begin::Stats Widget 31-->
                <div class="card card-custom bg-success bg-hover-state-success card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-white">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path
                                        d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path
                                        d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                        fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span
                            class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $cust_dist }}</span>
                        <span class="font-weight-bold text-white font-size-sm">Master Customer Distributor PH</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
            <!--end::Stats Widget 31-->
        </div>
        <div class="col-xl-3">
            <a href="{{ route('mst_am.index') }}">
                <!--begin::Stats Widget 32-->
                <div class="card card-custom bg-light bg-hover-state-light card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-dark">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                        rx="1.5"></rect>
                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5">
                                    </rect>
                                </g>
                            </svg> <!--end::Svg Icon-->
                        </span>
                        <span
                            class="card-title font-weight-bolder text-dark-50 font-size-h2 mb-0 mt-6 d-block">{{ $cov_am }}</span>
                        <span class="font-weight-bold text-dark-50 font-size-sm">Coverage AM</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
            <!--end::Stats Widget 32-->
        </div>

        <div class="col-xl-3">
            <a href="{{ route('mst_gm.index') }}">
                <!--begin::Stats Widget 25-->
                <div class="card card-custom bg-pink bg-hover-danger-o-2 card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-dark">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                        rx="1.5"></rect>
                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5">
                                    </rect>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span
                            class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $cov_gm }}</span>
                        <span class="font-weight-bold text-dark-50 font-size-sm">Coverage GM</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
            <!--end::Stats Widget 25-->
        </div>
        <div class="col-xl-3">
            <a href="{{ route('mst_mr.index') }}">
                <!--begin::Stats Widget 26-->
                <div class="card card-custom bg-emerald bg-hover-success-o-2 card-stretch gutter-b">
                    <!--begin::ody-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-dark">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                        rx="1.5"></rect>
                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5">
                                    </rect>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span
                            class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $cov_mr }}</span>
                        <span class="font-weight-bold text-dark-50 font-size-sm">Coverage MR</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
            <!--end::Stats Widget 26-->
        </div>
        <div class="col-xl-3">
            <a href="{{ route('mst_rm.index') }}">
                <!--begin::Stats Widget 27-->
                <div class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-white">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                        rx="1.5"></rect>
                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5">
                                    </rect>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span
                            class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $cov_rm }}</span>
                        <span class="font-weight-bold text-white font-size-sm">Coverage RM</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
            <!--end::Stats Widget 27-->
        </div>
        <div class="col-xl-3">
            <a href="{{ route('mst_sam.index') }}">
                <!--begin::Stats Widget 28-->
                <div class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-white">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                        rx="1.5"></rect>
                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5">
                                    </rect>
                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5">
                                    </rect>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span
                            class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $cov_sam }}</span>
                        <span class="font-weight-bold text-white font-size-sm">Coverage SAM</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
            <!--end::Stat: Widget 28-->
        </div>
        <div class="col-xl-3">
            <a href="{{ route('top_marketing.index') }}">
                <!--begin::Stats Widget 32-->
                <div class="card card-custom bg-warning bg-hover-state-warning card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-white">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span
                            class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $top }}</span>
                        <span class="font-weight-bold text-white font-size-sm">Target Operational</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
            <!--end::Stats Widget 32-->
        </div>
    </div>
@endsection
