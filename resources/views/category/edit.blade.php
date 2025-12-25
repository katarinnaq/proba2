@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <h3>Izmena kategorije</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="naziv" class="form-label">Naziv</label>
                    <input type="text" name="naziv" id="naziv" class="form-control" value="{{ old('naziv', $category->naziv) }}" required>
                </div>

                <div class="mb-3">
                    <label for="opis" class="form-label">Opis</label>
                    <textarea name="opis" id="opis" class="form-control" rows="3">{{ old('opis', $category->opis) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Sačuvaj izmene</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Otkaži</a>
            </form>
        </div>
    </div>
</div>
@endsection
