@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm khuyến mãi mới</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('promotions.store') }}" method="POST" id="promotionForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Mã khuyến mãi:</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code">
                                    @error('code')
                                    <div class="invalid-feedback alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount">Giảm giá:</label>
                                    <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount">
                                    @error('discount')
                                    <div class="invalid-feedback alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_type">Loại giảm giá:</label>
                                    <select class="form-control @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type">
                                        <option value="percentage">Phần trăm</option>
                                        <option value="fixed">Giá cố định</option>
                                    </select>
                                    @error('discount_type')
                                    <div class="invalid-feedback alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minimum_spend">Giá trị tối thiểu:</label>
                                    <input type="number" class="form-control @error('minimum_spend') is-invalid @enderror" id="minimum_spend" name="minimum_spend" placeholder="Không yêu cầu" min="0">
                                    @error('minimum_spend')
                                    <div class="invalid-feedback alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Thời gian bắt đầu:</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date">
                                    @error('start_date')
                                    <div class="invalid-feedback alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">Thời gian kết thúc:</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date">
                                    @error('end_date')
                                    <div class="invalid-feedback alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usage_limit">Giới hạn sử dụng:</label>
                                    <input type="number" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" name="usage_limit" placeholder="Không giới hạn" min="0">
                                    @error('usage_limit')
                                    <div class="invalid-feedback alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Không kích hoạt</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm khuyến mãi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Kiểm tra ngày
    document.getElementById('promotionForm').addEventListener('submit', function(event) {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);
        if (startDate > endDate) {
            alert("Thời gian bắt đầu không thể lớn hơn thời gian kết thúc.");
            event.preventDefault();
        }
    });
</script>
@endsection