<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use App\Models\Product as ProductModel;
use Illuminate\Validation\Rule;

class Items extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $products = ProductModel::all();
        return view('admin.products', [
            'do' => 'view',
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('admin.products', [
            'do' => 'add',
        ]);
    }
}
