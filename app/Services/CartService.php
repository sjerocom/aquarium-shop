<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const CART_SESSION_KEY = 'cart';

    /**
     * Get all items in the cart
     */
    public function getItems(): array
    {
        return Session::get(self::CART_SESSION_KEY, []);
    }

    /**
     * Get cart item count
     */
    public function getCount(): int
    {
        return count($this->getItems());
    }

    /**
     * Add product to cart
     */
    public function add(Product $product, int $quantity = 1): void
    {
        $cart = $this->getItems();
        $productId = $product->id;

        if (isset($cart[$productId])) {
            // Product already in cart, increase quantity
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Add new product to cart
            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'latin_name' => $product->latin_name,
                'slug' => $product->slug,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->primaryImage?->path,
                'category' => $product->category->name,
            ];
        }

        Session::put(self::CART_SESSION_KEY, $cart);
    }

    /**
     * Remove product from cart
     */
    public function remove(int $productId): void
    {
        $cart = $this->getItems();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put(self::CART_SESSION_KEY, $cart);
        }
    }

    /**
     * Update quantity of a product in cart
     */
    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getItems();

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                $this->remove($productId);
            } else {
                $cart[$productId]['quantity'] = $quantity;
                Session::put(self::CART_SESSION_KEY, $cart);
            }
        }
    }

    /**
     * Clear the entire cart
     */
    public function clear(): void
    {
        Session::forget(self::CART_SESSION_KEY);
    }

    /**
     * Get total price of all items in cart
     */
    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Check if product is in cart
     */
    public function has(int $productId): bool
    {
        $cart = $this->getItems();
        return isset($cart[$productId]);
    }
}
