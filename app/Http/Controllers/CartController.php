<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    private function getCartIdentifier()
    {
        return [
            'user_id' => Auth::id(),
            'session_id' => Auth::id() ? null : session()->getId(),
        ];
    }

    public function add(Request $request)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:999999',
            'unit' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1|max:5',
        ]);

        try {
            $identifier = $this->getCartIdentifier();

            DB::transaction(function () use ($request, $identifier) {
                $cart = Cart::getOrCreateCart($identifier['user_id'], $identifier['session_id']);
                $cartData = $cart->getCartData();

                $product = $request->product;
                $quantity = $request->quantity;

                if (isset($cartData[$product])) {
                    $cartData[$product]['quantity'] += $quantity;
                    // Ensure max quantity
                    $cartData[$product]['quantity'] = min($cartData[$product]['quantity'], 5);
                } else {
                    $cartData[$product] = [
                        'name' => $product,
                        'price' => $request->price,
                        'unit' => $request->unit,
                        'quantity' => $quantity,
                    ];
                }

                $cart->setCartData($cartData);
                $cart->save();
            });

            return redirect()->back()->with('success', 'Item added to cart!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add item to cart. Please try again.');
        }
    }

    public function index()
    {
        try {
            $identifier = $this->getCartIdentifier();
            $cart = Cart::getCart($identifier['user_id'], $identifier['session_id']);

            $cartData = $cart ? $cart->getCartData() : [];
            $total = 0;

            foreach ($cartData as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            return view('cart', compact('cartData', 'total'));
        } catch (\Exception $e) {
            \Log::error('Cart display failed', ['error' => $e->getMessage(), 'user_id' => $identifier['user_id']]);
            return view('cart', ['cartData' => [], 'total' => 0])->with('error', 'Unable to load cart. Please try again.');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'integer|min:0|max:5',
        ]);

        try {
            $identifier = $this->getCartIdentifier();

            DB::transaction(function () use ($request, $identifier) {
                $cart = Cart::getCart($identifier['user_id'], $identifier['session_id']);

                if ($cart) {
                    $cartData = $cart->getCartData();

                    foreach ($request->quantities as $product => $quantity) {
                        if ($quantity == 0) {
                            unset($cartData[$product]);
                        } else {
                            if (isset($cartData[$product])) {
                                $cartData[$product]['quantity'] = $quantity;
                            }
                        }
                    }

                    $cart->setCartData($cartData);
                    $cart->save();
                }
            });

            return redirect()->back()->with('success', 'Cart updated!');
        } catch (\Exception $e) {
            \Log::error('Cart update failed', ['error' => $e->getMessage(), 'user_id' => $identifier['user_id']]);
            return redirect()->back()->with('error', 'Failed to update cart. Please try again.');
        }
    }

    public function remove($product)
    {
        try {
            $identifier = $this->getCartIdentifier();

            DB::transaction(function () use ($product, $identifier) {
                $cart = Cart::getCart($identifier['user_id'], $identifier['session_id']);

                if ($cart) {
                    $cartData = $cart->getCartData();
                    unset($cartData[$product]);
                    $cart->setCartData($cartData);
                    $cart->save();
                }
            });

            return redirect()->back()->with('success', 'Item removed from cart!');
        } catch (\Exception $e) {
            \Log::error('Cart remove failed', ['error' => $e->getMessage(), 'user_id' => $identifier['user_id']]);
            return redirect()->back()->with('error', 'Failed to remove item. Please try again.');
        }
    }

    public function clear()
    {
        try {
            $identifier = $this->getCartIdentifier();

            DB::transaction(function () use ($identifier) {
                $cart = Cart::getCart($identifier['user_id'], $identifier['session_id']);

                if ($cart) {
                    $cart->setCartData([]);
                    $cart->save();
                }
            });

            return redirect()->back()->with('success', 'Cart cleared!');
        } catch (\Exception $e) {
            \Log::error('Cart clear failed', ['error' => $e->getMessage(), 'user_id' => $identifier['user_id']]);
            return redirect()->back()->with('error', 'Failed to clear cart. Please try again.');
        }
    }
}
