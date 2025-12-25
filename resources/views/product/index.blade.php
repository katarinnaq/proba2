@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <h3>Lista proizvoda</h3>
    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Dodaj novi proizvod</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Kategorija</th>
                <th>Opis</th>
                <th>Tip vode</th>
                <th>Ambalaža</th>
                <th>Cena</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->naziv }}</td>
                <td>{{ $product->category->naziv ?? 'Nema kategorije' }}</td>
                <td>{{ $product->opis ?? '-' }}</td>
                <td>{{ $product->tip_vode }}</td>
                <td>{{ $product->ambalaza }}</td>
                <td>{{ number_format($product->cena, 2) }} RSD</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Prikaži</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Izmeni</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj proizvod?')">
                            Obriši
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
