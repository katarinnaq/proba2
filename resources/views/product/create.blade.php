@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <h3>Dodaj novi proizvod</h3>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">Nazad na listu proizvoda</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="naziv" class="form-label">Naziv proizvoda</label>
            <input type="text" class="form-control" id="naziv" name="naziv" value="{{ old('naziv') }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategorija</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Izaberi kategoriju</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->naziv }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="opis" class="form-label">Opis</label>
            <textarea class="form-control" id="opis" name="opis" rows="3">{{ old('opis') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tip_vode" class="form-label">Tip vode</label>
            <select class="form-select" id="tip_vode" name="tip_vode" required>
                <option value="">Izaberi tip vode</option>
                <option value="mineralna" {{ old('tip_vode') == 'mineralna' ? 'selected' : '' }}>Mineralna</option>
                <option value="gazirana" {{ old('tip_vode') == 'gazirana' ? 'selected' : '' }}>Gazirana</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="ambalaza" class="form-label">Ambalaža</label>
            <input type="text" class="form-control" id="ambalaza" name="ambalaza" value="{{ old('ambalaza') }}" required>
        </div>

        <div class="mb-3">
            <label for="cena" class="form-label">Cena (RSD)</label>
            <input type="number" step="0.01" class="form-control" id="cena" name="cena" value="{{ old('cena') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Dodaj proizvod</button>
    </form>
</div>
@endsection
