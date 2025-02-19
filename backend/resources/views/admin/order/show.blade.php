@extends('admin.layout')
<style>
    .card-body {
        padding: 1.25rem;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
    }

    .table th,
    .table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }

    .table th {
        background-color: #f4f4f4;
        color: #333;
        font-weight: 600;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .status-column {
        display: flex;
        align-items: center;
    }

    .status-column span {
        font-size: 16px;
        font-weight: 500;
        margin-right: 8px;
        display: inline-block;
    }

    .status-column .from-status {
        color: #007bff;
        font-weight: bold;
    }

    .status-column .to-status {
        color: #28a745;
        font-weight: bold;
    }

    .status-column .arrow-icon {
        color: #888;
        margin: 0 8px;
    }

    .status-column .time {
        color: #666;
        font-size: 14px;
    }

    .status-column .user-name {
        font-size: 14px;
        color: #555;
        font-weight: 500;
        margin-left: 12px;
    }

    .status-column .badge {
        display: inline-block;
        background-color: #6c757d;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 14px;
    }
</style>
@section('title')
    danh sách đơn hàng
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Chi tiết đơn hàng</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                                <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Đơn hàng: {{ $order->code }} - Được đặt lúc:
                                    {{ $order->created_at->format('d/m/Y H:i') }}</h5>
                                <div class="flex-shrink-0">
                                    {{-- <a href="apps-invoices-details.html" class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> Invoice</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap align-middle table-borderless mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Sản phẩm</th>
                                            <th></th>
                                            <th></th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col" class="text-end">Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $detail)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                            <img src="{{ asset('storage/' . $detail->image) }}"
                                                                alt="{{ $detail->name }}"
                                                                style="width: 100px; height: auto; margin-right: 10px;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="fs-15"><a href="#"
                                                                    class="link-primary">{{ $detail->name }}</a></h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $detail->quantity }}</td>
                                                <td class="fw-medium text-end">
                                                    {{ number_format($detail->sale_price * $detail->quantity, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="border-top border-top-dashed">
                                            <td colspan="3"></td>
                                            <td colspan="2" class="fw-medium p-0">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>Shipping:</td>
                                                            <td class="text-end">
                                                                {{ number_format($order->shipping->cost, 0, ',', '.') }}đ -
                                                                {{ $order->shipping->name }}</td>
                                                        </tr>
                                                        @if ($order->promotion)
                                                            @if ($order->promotion->discount_type == 'fixed')
                                                                <tr>
                                                                    <td>Giảm giá: <span class="text-muted"></span></td>
                                                                    <td class="text-end">
                                                                        {{ number_format($order->promotion->discount, 0) }}
                                                                        VNĐ</td>
                                                                </tr>
                                                            @elseif($order->promotion->discount_type == 'percentage')
                                                                <tr>
                                                                    <td>Giảm giá: <span class="text-muted"></span></td>
                                                                    <td class="text-end">{{ $order->promotion->discount }}
                                                                        %
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <p>Không xác định loại giảm giá.</p>
                                                            @endif
                                                        @else
                                                            <p>Không có mã giảm giá.</p>
                                                        @endif
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row">Tổng :</th>
                                                            <th class="text-end">{{ number_format($order->money_total) }}
                                                                VNĐ</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end card-->

                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Trạng thái đơn hàng</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="profile-timeline">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    @foreach ($historyRecords as $index => $history)
                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingOne">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                                    href="#collapse{{ $index + 1 }}" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title bg-success rounded-circle">
                                                                <!-- Map icon based on from_status or to_status -->
                                                                @php
                                                                    // Determine icon based on from_status
                                                                    $icon = '';
                                                                    switch ($history->to_status) {
                                                                        case 'da_xac_nha':
                                                                            $icon =
                                                                                ' mdi-checkbox-marked-circle-outline';
                                                                            break;
                                                                        case 'dang_chuan_bi':
                                                                            $icon = 'mdi-gift-outline';
                                                                            break;
                                                                        case 'dang_van_chuyen':
                                                                            $icon = 'mdi-truck-minus-outline';
                                                                            break;
                                                                        case 'da_nhan_hang':
                                                                            $icon = 'mdi-gift-open-outline';
                                                                            break;
                                                                        default:
                                                                            $icon = 'mdi-package-variant';
                                                                    }
                                                                @endphp
                                                                <i class="mdi {{ $icon }}"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-0 fw-semibold">
                                                                <span class="fw-normal">
                                                                    {{ $history->from_status_display }}</span>
                                                                ->
                                                                {{ $history->to_status_display }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapse{{ $index + 1 }}" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <h6 class="mb-1">Đơn hàng được xử lý bởi
                                                        <strong>{{ $history->users->name }}</strong> lúc.
                                                    </h6>
                                                    <p class="text-muted">
                                                        {{ $history->updated_at->format('d/m/Y H:i') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--end accordion-->
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">Khách hàng</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 vstack gap-3">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-1">{{ $order->name }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->phone }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end card-->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Địa
                                chỉ</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                <li class="fw-medium fs-14">{{ $order->address }}</li>
                                <li>Ghi chú: {{ $order->note ?? 'Không có' }}</li>
                            </ul>
                        </div>
                    </div>
                    <!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Trạng thái thanh toán</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                <li>Phương thức thanh toán: <strong>{{ $order->payment_type }}</strong></li>
                                <li>Trạng thái: <strong>{{ $orderPayment }}</strong></li>
                            </ul>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>

            <!--end row-->

        </div><!-- container-fluid -->
    </div><!-- End Page-content -->
@endsection
