<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
        }

        .header p {
            margin: 5px 0;
        }

        .order-details {
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-details table, .order-details th, .order-details td {
            border: 1px solid #ccc;
        }

        .order-details th, .order-details td {
            padding: 8px;
            text-align: left;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Hóa đơn đơn hàng</h1>
        <p>Mã đơn hàng: {{ $order->code }}</p>
        <p>Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="order-details">
        <h3>Chi tiết đơn hàng</h3>
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail) <!-- Lặp qua orderDetails -->
                    <tr>
                        <td>{{ $detail->name }}</td> <!-- Hiển thị tên sản phẩm trong order_detail -->
                        <td>{{ number_format($detail->sale_price) }} VND</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->sale_price * $detail->quantity) }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <p>Tổng cộng: {{ number_format($order->money_total) }} VND</p>
    </div>

    <div class="footer">
        <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
    </div>
</div>

</body>
</html>
