@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h3 class="mb-4">Campagne actuelle: {{ $currentCampaign }}</h3>

                <h4 class="mb-4">Produits phares</h4>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($popularProducts as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            @if($product->image_product)
                            <img src="/storage/uploads/{{$product->image_product}}" class="card-img-top" alt="Image de {{ $product->name_product }}" style="height: 200px; object-fit: cover;">
                            @endif
                            @if($product->photo_product)
                            <img src="/storage/uploads/{{$product->photo_product}}" class="card-img-top" alt="Image de {{ $product->name_product }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <p class="card-text"><strong>Catégorie:</strong> {{ $product->category->name_category }}</p>
                                <h5 class="card-title">{{ $product->name_product }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description_product, 100) }}</p>
                                <p class="card-text"><strong>Description:</strong> {{ $product->content_product }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('products.edit', $product->id)}}" class="btn btn-primary btn-sm">Editer</a>
                                <form action="{{ route('products.destroy', $product->id)}}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <h4 class="mb-4 mt-5">Produits les mieux notés</h4>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($topRatedProducts as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            @if($product->image_product)
                            <img src="/storage/uploads/{{$product->image_product}}" class="card-img-top" alt="Image de {{ $product->name_product }}" style="height: 200px; object-fit: cover;">
                            @endif
                            @if($product->photo_product)
                            <img src="/storage/uploads/{{$product->photo_product}}" class="card-img-top" alt="Image de {{ $product->name_product }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <form method="POST" action="{{ route('products.rate', $product->id) }}"> @csrf <button type="submit" class="btn btn-primary">Оценить</button> </form>
                            <div class="card-body">
                                <p class="card-text"><strong>Catégorie:</strong> {{ $product->category->name_category }}</p>
                                <h5 class="card-title">{{ $product->name_product }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description_product, 100) }}</p>
                                <p class="card-text"><strong>Description:</strong> {{ $product->content_product }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('products.edit', $product->id)}}" class="btn btn-primary btn-sm">Editer</a>
                                <form action="{{ route('products.destroy', $product->id)}}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection