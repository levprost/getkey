<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $sales = Sale::all(); 
        return view('products.index', compact('products','sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); 
        $sales = Sale::all();
        return view('products.create',compact('categories','sales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required',
            'content_product' => 'required',
            'description_product' => 'required',
            'price_product' => 'required',
            'photo_product' => 'required|image|mimes:jpeg,png,jpg,gif,jfif,svg',
            'image_product'=>'required|image|mimes:jpeg,png,jpg,gif,jfif,svg',
            'category_id' => 'required',
        ]);
        $filename = ""; 
        if ($request->hasFile('image_product')) { 
        // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg" 
          $filenameWithExt = $request->file('image_product')->getClientOriginalName(); 
          $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
        // On récupère l'extension du fichier, résultat $extension : ".jpg" 
          $extension = $request->file('image_product')->getClientOriginalExtension(); 
        // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg" 
          $filename = $filenameWithExt. '_' .time().'.'.$extension; 
        // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin 
        ///storage/app 
          $request->file('image_product')->storeAs('uploads', $filename); 
        } else { 
          $filename = Null; 
        } 
        $filename2 = ""; 
        if ($request->hasFile('photo_product')) { 
        // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg" 
          $filenameWithExt = $request->file('photo_product')->getClientOriginalName(); 
          $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
        // On récupère l'extension du fichier, résultat $extension : ".jpg" 
          $extension = $request->file('photo_product')->getClientOriginalExtension(); 
        // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg" 
          $filename2 = $filenameWithExt. '_' .time().'.'.$extension; 
        // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin 
        ///storage/app 
          $request->file('photo_product')->storeAs('uploads', $filename2); 
        } else { 
          $filename2 = Null; 
        } 
       $products = Product::create([
            'name_product' => $request->name_product,
            'content_product' => $request->content_product,
            'description_product' => $request->description_product,
            'price_product' => $request->price_product,
            'image_product' => $filename,
            'photo_product' => $filename2,
            'category_id' => $request->category_id,
            
                ]);
                if ($request->has('sales')) {  
                    $products->sales()->attach($request->sales); 
                } 
        return redirect()->route('products.index')
            ->with('succes-s', 'Produit ajouté avec succès !');
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $sales = Sale::all();

        $activeSales = $product->sales()->pluck('sales.id')->toArray();

        return view('products.edit', compact('product','categories','sales','activeSales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Валидация данных
        $validatedData = $request->validate([
            'name_product' => 'nullable',
            'content_product' => 'nullable',
            'description_product' => 'nullable',
            'price_product' => 'nullable',
            'photo_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,svg',
            'image_product'=>'nullable|image|mimes:jpeg,png,jpg,gif,jfif,svg',
            'category_id' => 'nullable',
            'sales' => 'nullable',
        ]);
    
        // Если есть новое изображение, обработать его
        if ($request->hasFile('image_product')) {
            // Сохранение нового файла изображения
            $filenameWithExt = $request->file('image_product')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_product')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
    
            // Сохранить в папке uploads
            $request->file('image_product')->storeAs('uploads', $filename);
    
            // Установить новое имя файла в данные для обновления
            $validatedData['image_product'] = $filename;
        } else {
            // Если изображения нет, оставить старое
            $validatedData['image_product'] = $product->image;
        }
        $filename2 = ""; 
        if ($request->hasFile('photo_product')) { 
        // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg" 
          $filenameWithExt = $request->file('photo_product')->getClientOriginalName(); 
          $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
        // On récupère l'extension du fichier, résultat $extension : ".jpg" 
          $extension = $request->file('photo_product')->getClientOriginalExtension(); 
        // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg" 
          $filename2 = $filenameWithExt. '_' .time().'.'.$extension; 
        // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin 
        ///storage/app 
          $request->file('photo_product')->storeAs('uploads', $filename2); 
        } else { 
          $filename2 = Null; 
        } 

        if ($request->has('sales')) { $product->sales()->sync($request->input('sales')); } else { $product->sales()->detach(); }
    
        // Обновление книги
        $product->update(array_filter($validatedData));
    
        // Перенаправление с сообщением об успехе
        return redirect()->route('products.index')->with('success', 'Produit a bien été modifié!');
       
    
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $product = Product::findOrFail($id);
      $product->delete();
      return redirect('/products')->with('success', 'Produit supprimé avec succès');
    }

}