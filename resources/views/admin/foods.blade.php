@extends('layouts.app')

@section('content')
    <h2>Manage Food Items</h2>

    <form action="/admin/add-food" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Food Item</button>
    </form>

    <h3 class="mt-5">Food Items</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foodItems as $foodItem)
                <tr>
                    <td>{{ $foodItem->name }}</td>
                    <td>{{ $foodItem->description }}</td>
                    <td>${{ $foodItem->price }}</td>
                    <td><img src="{{ Storage::url($foodItem->image) }}" width="50" alt="{{ $foodItem->name }}"></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="/admin/edit-food/{{ $foodItem->id }}" class="btn btn-warning">Edit</a>
                        
                        <!-- Delete Button -->
                        <a href="/admin/delete-food/{{ $foodItem->id }}" class="btn btn-danger"
                           onclick="return confirm('Are you sure you want to delete this food item?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $foodItems->links() }}
@endsection
