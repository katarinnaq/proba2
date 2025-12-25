@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <h3>Detalji proizvoda</h3>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">Nazad na listu proizvoda</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->naziv }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Kategorija: {{ $product->category->naziv }}</h6>
            <p class="card-text"><strong>Opis:</strong> {{ $product->opis ?? 'Nema opisa' }}</p>
            <p class="card-text"><strong>Tip vode:</strong> {{ ucfirst($product->tip_vode) }}</p>
            <p class="card-text"><strong>Ambalaža:</strong> {{ $product->ambalaza }}</p>
            <p class="card-text"><strong>Cena:</strong> {{ number_format($product->cena, 2) }} RSD</p>
        </div>
    </div>
</div>
@endsection
