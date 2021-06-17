@extends('layouts.app')

@section('content')
@include('include.error')

<div class="card">
    <div class="card-header">Create Product</div>

    <div class="card-body">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" class="form-control" type="text" value="{{old('name')}}" name="name">
            </div>
            <div class="form-group">
                <label for="featured">Featured Image</label>
                <input id="featured" class="form-control-file border" type="file" name="image">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input id="price" class="form-control" type="number" min="500" value="{{old('price')}}" name="price">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea id="desc" class="form-control" name="desc" rows="10" cols="10">{{old('desc')}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Store Product
                </button>
            </div>
        </form>
    </div>
</div>

@endsection