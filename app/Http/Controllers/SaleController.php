<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = Sale::all(); 
        return view('sales.create',compact('sales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_sales' => 'required', 
        ]);
        Sale::create([
            'name_sales' => $request->name_sales,
            
        ]);
        return redirect()->route('sales.index')
            ->with('success', 'sales ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sales = Sale::findOrFail($id);
        return view('sales.edit', compact('sales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateSale = $request->validate([
            'name_sales' => 'required',
        ]);
        Sale::whereId($id)->update($updateSale);
        return redirect()->route('sales.index')->with('success', 'La solde mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
