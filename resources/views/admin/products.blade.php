@extends('admin.layouts.app')
@section('content')

    @if(isset($do))
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                @if($do == 'view')
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            @if($products->count() >= 1)
                                <h6 class="mb-4">Products Table</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Color</th>  
                                                <th scope="col">Price</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Adding Date</th>
                                                <th scope="col">Control</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <th scope="row">
                                                        {{$product['id']}}
                                                    </th>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                            <div>
                                                                <img src="{{asset('img/')}}/{{$product->images->first()->image_name}}" style="width:5rem;height:auto;" class="me-2" alt="{{$product['name']}}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{$product['name']}}
                                                    </td>
                                                    <td>{{$product['color']}}</td>
                                                    <td>{{$product['price']}}</td>
                                                    <td>{{nl2br($product['description'])}}</td>
                                                    <td>{{$product['created_at']}}</td>
                                                    <td>
                                                        <a href="/product/products/edit/{{$product['id']}}"><button type="button" class="btn btn-outline-warning m-2"><i class="fa fa-pen"></i> edit</button></a>
                                                        <a action="/product/products"  onclick="event.preventDefault(); document.getElementById('delete-form-{{$product['id']}}').submit();">
                                                        <button type="submit" class="btn btn-outline-danger m-2"><i class="fa fa-trash"></i> delete</button></a>
                                                        <form id="delete-form-{{$product['id']}}" action="/product/products" method="POST" class="d-none">
                                                            @method('delete')
                                                            @csrf
                                                            <input name="id" hidden type="text" value="{{$product['id']}}">
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            @else
                                <div class="alert alert-info" role="alert">
                                    There is no products.
                                </div>
                            @endif
                            
                            <a href="products/add" class="btn btn-primary m-2">Add Product</a>
                        </div>
                    </div>
                    
                @elseif($do == 'add')
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Admin Form</h6>
                            <form method="POST" >
                                @csrf
                                <div class="row mb-3">

                                    <label for="exampleInputName" class="form-label col-lg-2">Name</label>
                                    <div class="col-lg-4 ">    
                                        <input type="text" class="form-control" id="exampleInputName" required name="name" value="{{old('name')}}">
                                        @error('name')
                                            <p class="text-danger mt-1 mb-0">{{$message}}</p>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="row mb-3">

                                    <label for="exampleInputEmail1" class="form-label col-lg-2">Email address</label>
                                    <div class="col-lg-4 ">    
                                        <input type="email" class="form-control" id="exampleInputEmail1" required name="email" value="{{old('email')}}">
                                        @error('email')
                                            <p class="text-danger mt-1 mb-0">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label for="exampleInputPassword" class="form-label col-lg-2">Password</label>
                                    <div class="col-lg-4 ">    
                                        <input type="password" class="form-control" id="exampleInputPassword" required name="password">
                                        @error('password')
                                            <p class="text-danger mt-1 mb-0">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                    </div>
                
                @elseif($do == 'stored')
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="alert alert-success" role="alert">
                                User added successfully.
                            </div>
                            <script>
                                setTimeout(function() {
                                    window.location.href = '/admin/products';
                                }, 5000);
                            </script>
                        </div>
                    </div>
                @elseif($do == 'edit')
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Edit Admin</h6>
                            <form method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="row mb-3">

                                    <label for="exampleInputName" class="form-label col-lg-2">Name</label>
                                    <div class="col-lg-4 ">    
                                        <input type="text" class="form-control" id="exampleInputName" required name="name" value="{{$admin->name}}">
                                        @error('name')
                                            <p class="text-danger mt-1 mb-0">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label for="exampleInputEmail1" class="form-label col-lg-2">Email address</label>
                                    <div class="col-lg-4 ">    
                                        <input type="email" class="form-control" id="exampleInputEmail1" required name="email" value="{{$admin->email}}">
                                        @error('email')
                                            <p class="text-danger mt-1 mb-0">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label for="exampleInputPassword" class="form-label col-lg-2">Password</label>
                                    <div class="col-lg-4 ">    
                                        <input type="password" class="form-control" id="exampleInputPassword" name="password" aria-describedby="passwordHelp">
                                        @error('password')
                                            <p class="text-danger mt-1 mb-0">{{$message}}</p>
                                        @enderror
                                        <div id="passwordHelp" class="form-text">Leave blank if you don't want to change your password.
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                    </div>
                @elseif($do == 'updated')
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="alert alert-success" role="alert">
                                User uptaded successfully.
                            </div>
                            <script>
                                setTimeout(function() {
                                    window.location.href = '/admin/products';
                                }, 5000);
                            </script>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection
