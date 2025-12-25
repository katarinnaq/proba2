@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <h3>Detalji kategorije</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ $category->naziv }}</h5>
            <p class="card-text">{{ $category->opis ?? 'Nema opisa' }}</p>

            <a href="{{ route('categories.index') }}" class="btn btn-primary">Nazad na listu</a>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Izmeni</a>
        </div>
    </div>
</div>
@endsection
