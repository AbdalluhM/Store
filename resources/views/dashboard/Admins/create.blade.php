@extends('admin.layouts.master')
@section('content')
@if (session()->has('error'))
<div class="alert alert-danger text-center" role="alert">
    {{session()->get('error')}}
</div>
@endif
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Add User</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form action="{{route('users.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">User Name</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input type="text" name="name"
                                class="form-control form-control-lg form-control-solid" placeholder="User Name">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input type="email" name="email"
                                class="form-control form-control-lg form-control-solid" placeholder="Email">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Password</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input type="password" name="password"
                                class="form-control form-control-lg form-control-solid" placeholder="password">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Confirmed Password</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input type="password" name="confirm-password"
                                class="form-control form-control-lg form-control-solid" placeholder="confirm-password">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <select name="roles[]" aria-label="Select a Main Category" data-control="select2"
                            data-placeholder="Select a Main Category"
                            class="form-select form-select-solid form-select-lg select2-hidden-accessible"
                            data-select2-id="select2-data-13-i3r9" tabindex="-1" aria-hidden="true" multiple>
                            <option value="" data-select2-id="select2-data-15-ojrf">Select Role</option>
                            @foreach ($roles as $role )
                            <option data-kt-flag="flags/indonesia.svg" value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">Save
                        User</button>
                </div>
                <!--end::Actions-->
                {{-- <input type="hidden"> --}}
                <div></div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
</div>
@endsection
