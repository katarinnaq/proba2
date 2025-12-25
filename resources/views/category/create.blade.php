@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>Dodaj novu kategoriju</h4>
                </div>
                <div class="card-body">
                    <!-- Prikaz grešaka -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="naziv" class="form-label">Naziv kategorije</label>
                            <input type="text" name="naziv" class="form-control" id="naziv" value="{{ old('naziv') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="opis" class="form-label">Opis kategorije</label>
                            <textarea name="opis" class="form-control" id="opis" rows="3">{{ old('opis') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Sačuvaj kategoriju</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Nazad</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
