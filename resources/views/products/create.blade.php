@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <h3> Ajouter un livre</h3>
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
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nom produit</label>
                                <input type="text" name="name_product" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sumary</label>
                                <input type="text" name="content_product" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Discription</label>
                                <input type="text" name="discription_product" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Prix</label>
                                <input type="text" name="price_product" class="form-control">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="image" class="form-label">Image du product</label>
                                <input type="file" class="form-control" name="image_product" id="image_product">
                            </div>
                            <div class="form-group">
                                <select name="category_id" class="custom-select">
                                    <option value=""> --Catégorie-- </option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary  rounded-pill shadow-sm">
                                Ajouter un livre </button>
                        </form>
                        <!-- Fin du formulaire -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection