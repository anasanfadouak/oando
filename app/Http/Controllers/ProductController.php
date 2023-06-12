<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
/*with('images')->get();*/
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        
        return view('dashboard.products', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $product = Product::create($request->only(['name', 'description', 'price']));

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                // Generate a unique name for the image
                $imageName = $product->name . '_' . time() . '.' . $image->getClientOriginalExtension();
    
                // Move the image to the appropriate directory
                $image->move(public_path('images'), $imageName);
    
                ProductImage::create([
                    'product_id' => $product->id,
                    'file' => $imageName, // Save the image file name instead of file_path
                ]);
            }
        }
    
        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only(['name', 'description', 'price']));

        // Assuming $images is an array of image file paths
        $images = $request->input('images');

        // Delete old images
        $product->images()->delete();

        // Add new images
        
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                // Generate a unique name for the image
                $imageName = $product->name . '_' . time() . '.' . $image->getClientOriginalExtension();
    
                // Move the image to the appropriate directory
                $image->move(public_path('images'), $imageName);
    
                ProductImage::create([
                    'product_id' => $product->id,
                    'file' => $imageName, // Save the image file name instead of file_path
                ]);
            }
        }
        

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->images()->delete();
        $product->delete();
        
        return redirect()->route('products.index');
    }

    public function addToCart(Request $request, $productId)
{
    $product = Product::findOrFail($productId);
    $cart = session()->get('cart', []);
    if(isset($cart[$productId])) {
        $cart[$productId]['quantity']++;
    } else {
        $cart[$productId] = [
            'name' => $product->name,
            'image' => $product->images[0]->file,
            'price' => $product->price,
            'quantity' => 1
        ];
    }
    session()->put('cart', $cart);
    return back();
}
public function updateQuantity(Request $request, $productId) {
    $quantity = $request->input('quantity');
    $cart = session()->get('cart', []);
    if(isset($cart[$productId])) {
        $cart[$productId]['quantity'] = $quantity;
        session()->put('cart', $cart);
    }
    return response()->json(['success' => true]);
}

public function removeFromCart(Request $request, $productId)
{
    $cart = session()->get('cart', []);
    if(isset($cart[$productId])) {
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }
    return back();
}
public function showCart()
{
    $cart = session()->get('cart', []);
    return view('cartitems.cart', compact('cart'));
}
public function showproduct($name)
{
    // Fetch the product details using the provided name from the database or any data source
    $product = Product::where('name', $name)->first();

    // Pass the product details to the view
    return view('productpage.index', compact('product'));
}


}
