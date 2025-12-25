@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Kategorije</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Dodaj novu kategoriju</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($categories->isEmpty())
                <p>Nema dostupnih kategorija.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Naziv</th>
                            <th>Opis</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->naziv }}</td>
                            <td>{{ $category->opis }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Izmeni</a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Da li ste sigurni da želite da obrišete ovu kategoriju?')">Obriši</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
