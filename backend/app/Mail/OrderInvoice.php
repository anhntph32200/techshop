<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Mail\Mailable;

class OrderInvoice extends Mailable
{
    public $order;
    public $orderDetails;

    /**
     * Tạo một đối tượng email mới.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        
        // Lấy tất cả các bản ghi trong OrderDetail với order_id trùng với id của Order
        $this->orderDetails = OrderDetail::where('order_id', $order->id)->get();
    }

    /**
     * Xây dựng thông điệp email.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->view('email.order_invoice')
                    ->with([
                        'order' => $this->order,
                        'orderDetails' => $this->orderDetails, // Truyền danh sách orderDetails vào view
                    ])
                    ->subject('Hóa đơn đơn hàng #' . $this->order->code);
    }
}
