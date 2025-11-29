<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService
    ) {}

    /**
     * Display the cart
     */
    public function index()
    {
        $items = $this->cartService->getItems();
        $total = $this->cartService->getTotal();

        return view('cart.index', compact('items', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request, string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('primaryImage', 'category')
            ->firstOrFail();

        // Check if product is in stock
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Produkt ist leider ausverkauft.');
        }

        $quantity = $request->input('quantity', 1);

        // Validate quantity
        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Nicht genug Lagerbestand verfügbar.');
        }

        $this->cartService->add($product, $quantity);

        return redirect()->back()->with('success', 'Produkt wurde zum Warenkorb hinzugefügt.');
    }

    /**
     * Remove product from cart
     */
    public function remove(int $productId)
    {
        $this->cartService->remove($productId);

        return redirect()->route('cart.index')->with('success', 'Produkt wurde aus dem Warenkorb entfernt.');
    }

    /**
     * Update quantity of product in cart
     */
    public function updateQuantity(Request $request, int $productId)
    {
        $quantity = $request->input('quantity', 1);

        $this->cartService->updateQuantity($productId, $quantity);

        return redirect()->route('cart.index')->with('success', 'Menge wurde aktualisiert.');
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        $this->cartService->clear();

        return redirect()->route('cart.index')->with('success', 'Warenkorb wurde geleert.');
    }
}
