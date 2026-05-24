<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function viewproducts()
{
    $products = \App\Models\Product::with('category')->latest()->get();

    return view('front.products.cartview', compact('products'));
}
    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    // =========================
    // STORE (WITH IMAGE UPLOAD)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_number' => 'required|unique:products',
            'category_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('products', $filename, 'public');

            $imagePath = 'storage/products/' . $filename;
        }

        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'product_number' => $request->product_number,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'unit_type' => $request->unit_type,
            'unit_value' => $request->unit_value,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // =========================
    // UPDATE (WITH IMAGE REPLACE)
    // =========================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required',
            'product_number' => 'required|unique:products,product_number,' . $id,
            'category_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $product->image;

        // NEW IMAGE UPLOAD
        if ($request->hasFile('image')) {

            // delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('products', $filename, 'public');

            $imagePath = 'storage/products/' . $filename;
        }

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'product_number' => $request->product_number,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'unit_type' => $request->unit_type,
            'unit_value' => $request->unit_value,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // delete image
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    // =========================
    // SHOW (optional)
    // =========================
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }
}