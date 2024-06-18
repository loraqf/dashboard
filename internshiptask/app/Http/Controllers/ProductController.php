<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    public function index()
    {
        $products = Product::all();
        return view('pages.products', ['products' => $products]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }

    public function edit($id)
    {
        $product = Product::find($id); 
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp'
        ]);

        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->save();

        return redirect('/products')->with('success', 'Product updated successfully');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['product' => $product]);
    }
    
    public function create()
    {
        // 
    }
}