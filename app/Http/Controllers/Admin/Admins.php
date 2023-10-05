<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class Admins extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $admins = User::all()->where('role', true);
        return view('admin.admins', [
            'do' => 'view',
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins', [
            'do' => 'add',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:8',
        ]);
        $attributes['role'] = 1;
        User::create($attributes);
        $id = User::where('role', true)->where('email', $attributes['email'])->first()['id'];
        return redirect("admin/admins/stored/{$id}");
    }

    public function stored(string $id)
    {   $admin = User::where('role', true)->where('id', $id)->first();
        return view('admin.admins', [
            'do' => 'stored',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = User::where('role', true)->where('id', $id)->first();
        return view('admin.admins', [
            'do' => 'edit',
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => ['required', 'max:255', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => 'nullable|max:255|min:8',
        ]);
        $attributes['password'] = ($attributes['password'] == null) ? User::where('role', true)->where('id', $id)->first()['password'] : $attributes['password'];
        User::where('role', true)->where('id', $id)->first()->update($attributes);
        $update_date = User::where('role', true)->where('id', $id)->first()['updated_at'];
        return redirect("admin/admins/updated/{$update_date}");
    }



    public function updated(string $id)
    {   $admin = User::where('role', true)->where('updated_at', $id)->first();
        
        return view('admin.admins', [
            'do' => 'updated',
        ]);
        
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        User::destroy($request->id);
        return redirect('/admin/admins');
    }
}
