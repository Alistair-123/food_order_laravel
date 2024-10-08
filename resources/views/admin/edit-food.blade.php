@extends('layouts.app')

@section('content')
    <h2>Edit Food Item</h2>

    <form action="/admin/update-food/{{ $foodItem->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $foodItem->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $foodItem->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $foodItem->price }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <p>Current Image: <img src="{{ Storage::url($foodItem->image) }}" width="50" alt="{{ $foodItem->name }}"></p>
        </div>
        <button type="submit" class="btn btn-primary">Update Food Item</button>
    </form>
@endsection
