<?php
    use App\Models\User;
?>
@extends('admin.layouts.app')
@section('content')
    
    @if(isset($do))

        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                @if($do == 'view')
                    <?php
                        $admins = User::all()->where('role', true);
                    ?>
                    
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            @if($admins->count() >= 1)
                                
                                <h6 class="mb-4">Admins Table</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>  
                                                <th scope="col">Adding Date</th>
                                                <th scope="col">control</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <th scope="row">{{$admin['id']}}</th>
                                                    <td>{{$admin['name']}}</td>
                                                    <td>{{$admin['email']}}</td>
                                                    <td>{{$admin['created_at']}}</td>
                                                    <td>
                                                        <a href="/admin/admins/edit/{{$admin['id']}}"><button type="button" class="btn btn-outline-warning m-2"><i class="fa fa-pen"></i> edit</button></a>
                                                        <a href="/admin/admins/delete/{{$admin['id']}}"><button type="button" class="btn btn-outline-danger m-2"><i class="fa fa-trash"></i> delete</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            @else
                                <div class="alert alert-info" role="alert">
                                    There is no admins.
                                </div>
                            @endif
                            
                            <a href="admins/add" class="btn btn-primary m-2">Add Admin</a>
                        </div>
                    </div>
                    
                @elseif($do == 'add')
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Admin Form</h6>
                            <form>
                                <div class="row mb-3">

                                    <label for="exampleInputName" class="form-label col-lg-2">Name</label>
                                    <div class="col-lg-4 ">    
                                        <input type="text" class="form-control" id="exampleInputName" required name="name">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label for="exampleInputEmail1" class="form-label col-lg-2">Email address</label>
                                    <div class="col-lg-4 ">    
                                        <input type="email" class="form-control" id="exampleInputEmail1" required name="email">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label for="exampleInputPassword" class="form-label col-lg-2">Password</label>
                                    <div class="col-lg-4 ">    
                                        <input type="password" class="form-control" id="exampleInputPassword" required name="password">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                    </div>
                @elseif($do == 'edit')
                    <?php
                        $admin = User::findOrFail($id);
                    ?>
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Edit Admin</h6>
                            <form>
                                <div class="row mb-3">

                                    <label for="exampleInputName" class="form-label col-lg-2">Name</label>
                                    <div class="col-lg-4 ">    
                                        <input type="text" class="form-control" id="exampleInputName" required name="name" value="{{$admin->name}}">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label for="exampleInputEmail1" class="form-label col-lg-2">Email address</label>
                                    <div class="col-lg-4 ">    
                                        <input type="email" class="form-control" id="exampleInputEmail1" required name="email" value="{{$admin->email}}">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label for="exampleInputPassword" class="form-label col-lg-2">Password</label>
                                    <div class="col-lg-4 ">    
                                        <input type="password" class="form-control" id="exampleInputPassword" required name="password" aria-describedby="passwordHelp">
                                        <div id="passwordHelp" class="form-text">Leave blank if you don't want to change your password.
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                    </div>
                @elseif($do == 'delete')
                    <?php
                        User::findOrFail($id)->where('role', true)->delete();
                    ?>
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="alert alert-danger" role="alert">
                                Admin deleted successfully.
                            </div>
                            <script>
                                setTimeout(function() {
                                    window.location.href = '/admin/admins';
                                }, 5000);
                            </script>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
    @else
        
    
    @endif
@endsection
