<?php

namespace App\Http\Controllers\CartItem;

use App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartItem\CreateCartItemRequest;
use App\Http\Requests\CartItem\UpdateCartItemRequest;
use App\Http\Resources\Cart\ListCartItemResource;
use App\Http\Resources\CartItem\CreateCartItemResource;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use function Symfony\Component\Clock\now;

class crudCartItemController extends APIController
{
    /**
 * @group CartItem
 *
 */
    public function show()
    {
        $user_id = auth('customer')->id();

        $Cart = Cart::where('user_id', $user_id)->first();
        // dd($Cart);
        if (!$Cart) {
            return $this->sendResponce([], 'NO_CART_FOUND', 404);
        }

        return $this->sendResponce(ListCartItemResource::make($Cart), 'SUCCESS', 200);
    }
        /**
 * @group CartItem
 * @header X-CSRF-TOKEN required CSRF token.
 */
    public function create(CreateCartItemRequest $request)
    {

        $user_id = auth('customer')->id();

        $data = $request->validated();
        $Cart = Cart::where('user_id', $user_id)->first();
        if (!$Cart) {
            $Cart = Cart::create([
                'user_id' => $user_id,
                'expire_at' => Carbon::now()->addMinutes(30),
            ]);
        }
        // return $this->sendResponce($Cart->id, 'success', 200);


        $CartItem = CartItem::create([
            'quantity' => $data['quantity'],
            'product_id' => $data['product_id'],
            'color_image_products_id' => $data['color_image_products_id'],
            'cart_id' => $Cart->id
        ]);
        $unit_price = $CartItem->product->price;
        $total_price = $unit_price * $CartItem->quantity;
        $CartItem->total_price = $total_price;
        $CartItem->unit_price = $unit_price;
        $CartItem->save();
        return $this->sendResponce(CreateCartItemResource::make($CartItem), 'success', 200);
    }
    /**
 * @group CartItem
 */
    public function update(UpdateCartItemRequest $request, $id)
    {
        $data = $request->validated();
        $quantity = $data['quantity'] ?? null;
        $CartItem = CartItem::findOrFail($id);
           if($quantity ){
            if($data['quantity']!=$CartItem->quantity ){
                $unit_price = $CartItem->product->price;
                 $total_price = $unit_price * $data['quantity'];
                 $CartItem->total_price = $total_price;
                 $CartItem->unit_price = $unit_price;
                 $CartItem->save();
            }

        }


        $CartItem->update([
            'color_image_products_id' => $data['color_image_products_id'] ?? $CartItem->color_image_products_id,
            'quantity' => $data['quantity']?? $CartItem->quantity,
        ]);
        return $this->sendResponce(null, 'success', 200);
    }
       /**
 * @group CartItem
 */
    public function delete(UpdateCartItemRequest $request)
    {
        $user_id = auth('customer')->id();
        $data = $request->validated();
        $CartItem = CartItem::findOrFail($id);
        $CartItem->delete();
        return $this->sendResponce(null, 'success deleted', 200);
    }


    }

