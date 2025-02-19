@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admins.fillterDate') }}" class="mb-4">
                        @csrf
                        <div class="row d-flex align-items-center">
                            <div class="col-md-2">
                                <label for="start-date" class="me-2">Ngày bắt đầu:</label>
                                <input
                                    type="date"
                                    id="start-date"
                                    name="start_date"
                                    class="form-control"
                                    value="{{ isset($start_date) ? $start_date->toDateString() : '' }}">
                            </div>

                            <div class="col-md-2">
                                <label for="end-date" class="me-2">Ngày kết thúc:</label>
                                <input
                                    type="date"
                                    id="end-date"
                                    name="end_date"
                                    class="form-control"
                                    value="{{ isset($end_date) ? $end_date->toDateString() : '' }}">
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-10 mt-4">Lọc</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Kết thúc bộ lọc -->

        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Tổng giá tiền</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ $totalmoney }}"></span> VNĐ
                                            </h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                                <i class="bx bx-dollar-circle text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-md-4 col-12">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Sản phẩm đang chờ sử lý</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ $donhangdangchoxuly }}">0</span>
                                            </h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                                <i class="bx bx-hourglass text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-md-4 col-12">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Sản phẩm đã hủy</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ $donhangdahuy }}">0</span>
                                            </h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                <i class="bx bx-x-circle text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex flex-column flex-md-row justify-content-between">
                                    <h4 class="card-title mb-3 mb-md-0">
                                        Thống kê doanh số
                                    </h4>
                                    <form method="POST" action="{{route('admins.fillterYear')}}" class="d-flex align-items-end gap-3">
                                        @csrf
                                        <div class="form-group">
                                            <label for="years" class="form-label me-2">Chọn năm:</label>
                                            <select id="years" name="years" class="form-select">
                                                @for ($i = date('Y'); $i >= 2020; $i--) <!-- Bắt đầu vòng lặp từ năm hiện tại và giảm dần đến 2020 -->
                                                <!-- Tạo ra một thẻ <option> cho mỗi năm trong khoảng từ năm hiện tại đến 2020 -->
                                                <option value="{{ $i }}"
                                                    {{ $years == $i ? 'selected' : '' }}> <!-- Kiểm tra xem năm hiện tại có bằng năm trong vòng lặp không; nếu có, thêm thuộc tính 'selected' -->
                                                    {{ $i }} <!-- Hiển thị giá trị năm trong thẻ option -->
                                                </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Lọc</button>
                                    </form>
                                </div>

                                <div class="card-body p-0 pb-2">
                                    <div class="card-body">
                                        <!-- Biểu đồ -->
                                        <div id="monthly-sales-column" data-colors='["--vz-danger", "--vz-info", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Top 5 sản phẩm được mua nhiều nhất</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <tbody>
                                                @foreach ($top5productbought as $key => $top5productboughts)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="{{ Storage::url($top5productboughts['image']) }}"
                                                                    alt="" class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-12 my-1"><a
                                                                        href="apps-ecommerce-product-details.html"
                                                                        class="text-reset">{{ $top5productboughts['name'] }}</a>
                                                                </h5>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!-- <td>
                                                        <h5 class="fs-14 my-1 fw-normal"></h5>
                                                    </td> -->
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">
                                                            {{ $top5productboughts['total'] }}
                                                        </h5>
                                                        <span class="fs-12 text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">
                                                            {{ $top5productboughts['stock'] }}
                                                        </h5>
                                                        <span class="fs-12 text-muted">Stock</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thống kê theo danh mục</h4>

                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div id="store-visits-source"
                                        data-colors='["--vz-primary", "--vz-success", "--vz-warning"]' class="apex-charts"
                                        dir="ltr"></div>
                                </div>
                            </div> <!-- .card-->
                        </div> <!-- .col-->

                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Khách hàng tiền năng</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table
                                            class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th scope="col">Tên </th>
                                                    <th scope="col">Địa chỉ</th>
                                                    <th scope="col">email</th>
                                                    <th scope="col">Số điện thoại</th>
                                                    <th scope="col">Tổng số lượng mua</th>
                                                    <th scope="col">Số lần mua</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($top5Users as $top5Userss)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!-- <div class="flex-shrink-0 me-2">
                                                                <img src="assets/images/users/avatar-1.jpg"
                                                                    alt="" class="avatar-xs rounded-circle" />
                                                            </div> -->
                                                            <div class="flex-grow-1">{{ $top5Userss->name }}</div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $top5Userss->address }}</td>
                                                    <td>{{ $top5Userss->email }}</td>
                                                    <td>{{ $top5Userss->phone }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-success-subtle text-success">{{ $top5Userss->total }}
                                                            : sản phẩm</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-success-subtle text-success">{{ $top5Userss->SoLanMua }}
                                                            : mua hàng</span>
                                                    </td>
                                                </tr><!-- end tr -->
                                                @endforeach
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div>
                                </div>
                            </div> <!-- .card-->
                        </div> <!-- .col-->
                    </div> <!-- end row-->
                </div> <!-- end .h-100-->
            </div> <!-- end col -->

            <!-- Bình luận -->
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{{-- <!--datatable js-->
{{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}

<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    $(document).ready(function() {
        // Dữ liệu mẫu cho biểu đồ tròn
        const labels = @json(array_column($percentages, 'name')); // Lấy tên từ mảng phần trăm
        const series = @json($totalSales); // Lấy tổng sản phẩm

        // console.log(labels);
        // Khởi tạo biểu đồ donut
        const donutOptions = {
            chart: {
                type: 'donut',
                height: 350
            },
            colors: ['#FF4560', '#008FFB', '#00E396', '#775DD0', '#FEB019'], // Màu cố định
            series: series,
            labels: labels,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        // Tạo biểu đồ
        const donutChart = new ApexCharts(document.querySelector("#store-visits-source"), donutOptions);
        donutChart.render();

        // Dữ liệu cho biểu đồ cột
        // Dữ liệu mẫu cho biểu đồ cột với 12 phần
        // Nhãn các tháng
        const monthlyLabels = [
            'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ];

        // Tùy chọn cấu hình cho biểu đồ
        const monthlyOptions = {
            chart: {
                type: 'bar',
                height: 350,
            },
            colors: ['#FF4560', '#008FFB', '#00E396'],
            series: [{
                name: 'Doanh Số Hàng Tháng',
                data: @json($monthlySalesData) // Dữ liệu từ backend
            }],
            xaxis: {
                categories: monthlyLabels,
            },
            yaxis: {
                title: {
                    text: 'Doanh Số',
                },
            },
            tooltip: {
                y: {
                    formatter: (val) => val + ' sản phẩm'
                }
            },
        };

        // Khởi tạo và render biểu đồ
        const monthlyChart = new ApexCharts(document.querySelector("#monthly-sales-column"), monthlyOptions);
        monthlyChart.render();
    });
</script>
@endsection
<!-- End Page-content -->