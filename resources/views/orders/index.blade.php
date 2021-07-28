@extends('admin.layouts.master')
@section('content')
@section('title')
Orders
@endsection
@section('defintion')
Home |All Orders
@endsection
<div id="kt_content_container" class="container">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path
                                    d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                    fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-customer-table-filter="search"
                        class="form-control form-control-solid w-250px ps-15" placeholder="Search Orders">
                </div>
                <!--end::Search-->
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table id="kt_customer_details_invoices_table_1"
                        class="table align-middle table-row-dashed fs-6 fw-bolder gy-5 dataTable no-footer"
                        role="grid">
                        <!--begin::Thead-->
                        <thead
                            class="border-bottom border-gray-200 fs-7 text-uppercase fw-bolder">
                            <tr class="text-start text-muted gs-0" role="row">
                                <th class="min-w-100px">Order Id</th>
                                <th class="min-w-150px">Amount</th>
                                <th class="min-w-150px">Status</th>
                                <th class="min-w-150px">Created_at</th>
                                <th class="min-w-150px text-end">Action</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="fs-6 fw-bold text-gray-600">
                            @foreach ($orders as $order)
                            <tr class="odd">
                                <td data-order="Invalid date">
                                    {{$order->id}}
                                </td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->created_at}}</td>
                                <td class="text-end">
                                    <a href="{{route('orders.details',$order->id)}}"
                                        class="btn btn-sm btn-light btn-active-light-primary">view</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Tbody-->
                    </table>
                </div>
                 <div class="row">
                    <div
                        class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                    </div>
                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">
                            <div class="d-flex ">
                                {!! $orders->render() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

</div>

@endsection
