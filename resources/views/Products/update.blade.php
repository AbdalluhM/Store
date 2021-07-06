@extends('admin.layouts.master')
@section('content')
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Add Product</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form action="{{route('products.update')}}" enctype="multipart/form-data" method="post">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">Image product</span>
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" data-kt-image-input="true"
                            style="background-image: url(/metronic8/demo1/assets/media/avatars/blank.png)">

                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px"
                                style="background-image: url(/metronic8/demo1/assets/media/avatars/150-2.jpg)"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="avatar_remove">
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Input-->
                        <select name="category_id" data-control="select2" data-placeholder="Select a Main Category"
                            class="form-select form-select-solid form-select-lg select2-hidden-accessible" tabindex="-1"
                            aria-hidden="true">
                            <option value="">Select a Main Category</option>
                            @foreach ($categories as $category )
                            <option data-kt-flag="flags/indonesia.svg" value="{{$category->id}}">
                                {{$category->category_name}}</option>
                            @endforeach
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Product</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                            <input type="text" name="name_product"
                                class="form-control form-control-lg form-control-solid" placeholder="product name">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-bold mb-2">Quantity</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="product quantity"
                                name="qty">
                            <!--end::Input-->
                            {{-- <div class="fv-plugins-message-container invalid-feedback"></div> --}}
                        </div>
                        <!--end::Col-->
                        {{-- </div> --}}
                        {{-- <div class="row mb-6"> --}}
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-bold mb-2">Price</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="product price"
                                name="price">
                            <!--end::Input-->
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    <!--end::Col-->
                    {{-- begin offer,size --}}
                    <div class="col-md-6 fv-row">
                        <label class="required fs-6 fw-bold mb-2">Sizes</label>
                        <select name="sizes[]" data-control="select2" data-placeholder="Select Size"
                            class="form-select form-select-solid form-select-lg select2-hidden-accessible" tabindex="-1"
                            aria-hidden="true" multiple>
                            <option value="">Select a Size</option>
                            @foreach ($sizes as $size )
                            <option data-kt-flag="flags/indonesia.svg" value="{{$size->id}}">
                                {{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="col-md-6 fv-row">
                        <label class="required fs-6 fw-bold mb-2">Colors</label>
                        <select name="parent_id" data-control="select2"
                            data-placeholder="Select Color"
                            class="form-select form-select-solid form-select-lg select2-hidden-accessible" tabindex="-1"
                            aria-hidden="true">
                            <option value="" >Select a Color</option>
                            @foreach ($colors as $color )
                            <option data-kt-flag="flags/indonesia.svg" value="{{$color->id}}">
                    {{$color->color}}</option>
                    @endforeach
                    </select>
                </div> --}}
                <div class="col-md-6 fv-row">
                    <label class="required fs-6 fw-bold mb-2">Offer</label>
                    <select name="offer_id" data-control="select2" data-placeholder="Select Offer"
                        class="form-select form-select-solid form-select-lg select2-hidden-accessible" tabindex="-1"
                        aria-hidden="true">
                        <option value="">Select Offer </option>
                        @foreach ($offers as $offer )
                        <option data-kt-flag="flags/indonesia.svg" value="{{$offer->id}}">
                            {{$offer->value}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- </div> --}}
            </div>
            {{-- end offer,size --}}
            {{-- begin desc --}}
            <div class="d-flex flex-column mb-12">
                <label class="fs-6 fw-bold mb-2">Product Details</label>
                <textarea class="form-control form-control-solid" rows="3" name="description"
                    placeholder="Type Target Details"></textarea>
            </div>
            {{-- end desc --}}
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary">Update
                    Product</button>
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
