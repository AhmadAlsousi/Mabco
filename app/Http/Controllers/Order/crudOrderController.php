<?php

namespace App\Http\Controllers\Order;

use App\Enum\Status\OrderEnum;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Resources\Order\CreateResource;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class crudOrderController extends APIController
{
        /**
 * @group Order
 */
    public function create(CreateOrderRequest $request)
    {
        $user_id = auth('customer')->id();
        $data = $request->validated();

        $order_status = Order::where('status', OrderEnum::PENDING->value)->first();
        if ($order_status) {
            $orders = OrderItems::create([
                'quantity' => $data['quantity'],
                'unit_price' => $data['unit_price'],
                'total_price' => $data['total_price'],
                'product_id' => $data['product_id'],
                'color_id' => $data['color_id'],
                'order_id' => $order_status->id

            ]);
            $order_status->update([
                'college_cost' => $order_status->college_cost + $data['total_price']
            ]);

            return $this->sendResponce(CreateResource::make($orders), 'success', 200);
        } else {
            $order = Order::create([
                'user_id' => $user_id,
                'college_cost' => 0,
                'status' => OrderEnum::PENDING->value
            ]);
            if ($order) {
                $orders = OrderItems::create([
                    'quantity' => $data['quantity'],
                    'unit_price' => $data['unit_price'],
                    'total_price' => $data['total_price'],
                    'product_id' => $data['product_id'],
                    'color_id' => $data['color_id'],
                    'order_id' => $order->id

                ]);
            }
            $order->update([
                'college_cost' => $order->college_cost + $data['total_price']
            ]);
            $order->save();
            return $this->sendResponce(CreateResource::make($orders), 'success', 200);
        }
    }
}
