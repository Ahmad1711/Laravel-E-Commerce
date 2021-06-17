@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        All Products
    </div>
    <div class="card-body">
        <table class="table table-light">
            <thead>
                <td>Image</td>
                <td>Name</td>
                <td>Price</td>
                <td>Description</td>
                <td>Edit</td>
                <td>Delete</td>
            </thead>
            <tbody>
                @if($products->count()>0)
                @foreach($products as $product)
                <tr>
                    <td>
                        <img src="{{$product->image}}" width="90px" height="50px" alt="Faild Upload">
                    </td>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        {{$product->price}}
                    </td>
                    <td>
                        {{str_limit($product->desc,100)}}
                    </td>
                    <td>
                        <a href="{{route('products.edit',['id'=>$product->id])}}" class="btn btn-info btn-sm">
                            Edit
                        </a>
                    </td>
                    <td>
                        <form action="{{route('products.destroy',['id'=>$product->id])}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <th colspan="5" class="text-center">No Products yet.</th>
                </tr>
                @endif
            </tbody>
        </table>

    </div>
</div>
<br>
<div class="text-center">
    {{$products->links()}}
</div>

@endsection