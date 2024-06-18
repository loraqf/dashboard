<?php
namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Counterparty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function store(Request $request)
    {
        $salesData = $request->input('sales');

        foreach ($salesData as $data) {
            $product = Product::findOrFail($data['product_id']);
            Sale::create([
                'counterparty_id' => $data['counterparty_id'],
                'product_id' => $data['product_id'],
                'amount' => $data['amount'],
                'price' => $product->price,
                'total_amount' => $product->price * $data['amount'],
            ]);
        } 
        
        return redirect()->back()->with('success', 'Form created successfully!');
    }

    public function index()
    {
        $sales = Sale::with(['product', 'counterparty'])->get();
        $products = Product::all();
        $counterparties = Counterparty::all();
        return view('pages.sales', compact('sales', 'products', 'counterparties'));
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales')->with('success', 'Form deleted successfully!');
    }

    public function edit(string $id)
    {
        $sale = Sale::find($id);
        $products = Product::all();
        $counterparties = Counterparty::all();

        return view('sales.edit', compact('sale', 'products', 'counterparties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'counterparty_id' => 'required|exists:counterparties,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $sale = Sale::find($id);
        $sale->counterparty_id = $request->input('counterparty_id');
        $sale->product_id = $request->input('product_id');
        $sale->amount = $request->input('amount');

        // Fetch the new product price
        $product = Product::find($request->input('product_id'));
        $sale->price = $product->price;

        // Recalculate the total amount
        $sale->total_amount = $product->price * $request->input('amount');
        $sale->save();

        return redirect('/sales')->with('success', 'Sale updated successfully');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['product' => $product]);
    }
    
    public function create()
    {
        // 
    }
}
