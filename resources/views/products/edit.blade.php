@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <h3>Editer un produit</h3>
                        <!-- Message d'information -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- Formulaire -->
                        <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Nom de produit</label>
                                <input type="text" name="name_product" class="form-control"
                                    value="{{ $product->name_product }}">
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <input type="text" name="content_product" class="form-control"
                                    value="{{ $product->content_product }}">
                            </div>
                            <div class="form-group">
                                <label>Discription</label>
                                <input type="text" name="description_product" class="form-control"
                                    value="{{ $product->description_product }}">
                            </div>
                            <div class="form-group">
                                <label>Prix</label>
                                <input type="text" name="price_product" class="form-control"
                                    value="{{ $product->price_product }}">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="image_product" class="form-label">Image du produit</label>
                                <input type="file" class="form-control" name="image_product" id="image_product">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="photo_product" class="form-label">photo du produit</label>
                                <input type="file" class="form-control" name="photo_product" id="photo_product">
                            </div>
                            <div class="form-group">
                                <select name="category_id" class="custom-select">
                                    <option value=""> --Catégorie-- </option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="form-group">
                                    <label for="sales">Распродажи</label>
                                    @foreach($sales as $sale)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sale_{{ $sale->id }}" name="sales[]" value="{{ $sale->id }}" {{ in_array($sale->id, $activeSales) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sale_{{ $sale->id }}">
                                                {{ $sale->name_sales }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                            
                            <button type="submit" class="btn btn-primary  rounded-pill shadow-sm">Mettre à jour</button>
                        </form>
                        <!-- Fin du formulaire -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection