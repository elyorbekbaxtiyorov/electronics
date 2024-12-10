@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Elektronics</h1>

    <!-- Display categories and their products -->
    @if(isset($categories) && $categories->isNotEmpty())
        @foreach ($categories as $category)
            <div class="card mb-3">
                <div class="card-header">
                    <h2>{{ $category->name }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('compare') }}" method="POST">
                        @csrf
                        <div class="row">
                            @foreach ($category->products as $product)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="product_ids[]" value="{{ $product->id }}" id="product{{ $product->id }}">
                                        <label class="form-check-label" for="product{{ $product->id }}">
                                            <strong>{{ $product->name }}</strong> <br> ${{ number_format($product->price, 2) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Compare</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info">No categories available.</div>
    @endif

    <!-- Display all products -->
    <h2 class="my-4">All Products</h2>
    @if(isset($products) && $products->isNotEmpty())
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p><strong>${{ number_format($product->price, 2) }}</strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">No products available.</div>
    @endif
</div>
@endsection