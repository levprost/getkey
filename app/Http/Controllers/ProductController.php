<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentCampaign = Product::getCurrentCampaign();

        $campaignSales = Sale::where('name_sales', $currentCampaign)->first();

        $popularProducts = collect();
        if ($campaignSales) {
            $popularProducts = Product::whereHas('sales', function($query) use ($campaignSales) {
                $query->where('sale_id', $campaignSales->id);
            })->limit(3)->get();
        }

        $topRatedProducts = Product::withCount('users')
            ->orderBy('users_count', 'desc')
            ->limit(3)
            ->get();

        return view('products.index', compact('popularProducts', 'topRatedProducts', 'currentCampaign'));
    }

    /**
     * Rate a product.
     */
    public function rate(Request $request, $id, User $user)
    {
        $product = Product::findOrFail($id);

        // Проверяем, что пользователь аутентифицирован
        if (Auth::user()->id == $user->id) {
            $request->validate([
                'rating' => 'required|integer|between:1,5',
            ]);

            // Связываем пользователя и продукт
            $user->products()->syncWithoutDetaching([$id]);

            return redirect()->route('products.index')->with('success', 'Спасибо за вашу оценку!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Оценка невозможна']);
        }
    }

    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $sales = Sale::all();
        return view('products.create', compact('categories', 'sales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_product' => 'required|string|max:255',
            'content_product' => 'required|string',
            'description_product' => 'nullable|string',
            'price_product' => 'required|numeric',
            'photo_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = new Product($validatedData);

        if ($request->hasFile('image_product')) {
            $filename = $request->file('image_product')->store('uploads', 'public');
            $product->image_product = $filename;
        }

        if ($request->hasFile('photo_product')) {
            $filename = $request->file('photo_product')->store('uploads', 'public');
            $product->photo_product = $filename;
        }

        $product->save();

        if ($request->has('sales')) {
            $product->sales()->attach($request->input('sales'));
        }

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $sales = Sale::all();
        $activeSales = $product->sales()->pluck('sales.id')->toArray();

        return view('products.edit', compact('product', 'categories', 'sales', 'activeSales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name_product' => 'nullable|string|max:255',
            'content_product' => 'nullable|string',
            'description_product' => 'nullable|string',
            'price_product' => 'nullable|numeric',
            'photo_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'sales' => 'nullable|array',
        ]);

    }
}