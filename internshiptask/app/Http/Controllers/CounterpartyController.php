<?php
namespace App\Http\Controllers;
use App\Models\Counterparty;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CounterpartyController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'counterpartyname' => 'required|string|max:255',
            'bulstat' => 'required|numeric|unique:counterparties,bulstat',
            'address' => 'required|string|max:250',
            'email' => 'required|email|unique:counterparties,email|ends_with:gmail.com,mail.bg,abv.bg,yahoo.com'
        ]);

        $product = Counterparty::createCounterparty($validatedData);

        return redirect()->back()->with('success', 'Counterparty created successfully!');
    }

    public function index()
    {
        $counterparties = Counterparty::all();
        return view('pages.counterparties', ['counterparties' => $counterparties]);
    }

    public function destroy(Counterparty $counterparty)
    {
        $counterparty->delete();

        return redirect()->route('counterparties')->with('success', 'Counterparty deleted successfully!');
    }    

    public function edit($id)
    {
        $counterparty = Counterparty::find($id); 
        return view('counterparties.edit', compact('counterparty'));
    }

    public function update(Request $request, $id)
    {
        $counterparty = Counterparty::find($id);
        $request->validate([
            'counterpartyname' => 'required|string|max:255',
            'bulstat' => ['required','numeric',Rule::unique('counterparties')->ignore($counterparty->id),],
            'address' => 'required|string|max:250',
            'email' => [
            'required',
            'email',
            Rule::unique('counterparties')->ignore($counterparty->id),
            'ends_with:@gmail.com,@mail.bg,@abv.bg,@yahoo.com'
        ]
        ]);

        $counterparty->counterpartyname = $request->input('counterpartyname');
        $counterparty->bulstat = $request->input('bulstat');
        $counterparty->address = $request->input('address');
        $counterparty->email = $request->input('email');
        $counterparty->save();

        return redirect('/counterparties')->with('success', 'Counterparty updated successfully');
    }

    public function show(Product $product)
    {
        //
    }

    public function create()
    {
        //
    }
}
