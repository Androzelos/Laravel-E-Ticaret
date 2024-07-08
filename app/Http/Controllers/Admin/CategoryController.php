<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $datalist = DB::select('select * from categories');
        return view('admin.category', ['datalist' => $datalist], ['user' => $user]);
    }

    public function add()
    {
        $user = Auth::user();
        $datalist = DB::table('categories')->get()->where('parent_id', 0);
        return view('admin.category_add', ['datalist' => $datalist] ,['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $datalist = DB::table('categories')->get()->where('parent_id', 0);

        DB::table('categories')->insert([
            'parent_id' => $request->input('parent_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'keywords' => $request->input('keywords'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status')
        ]);
        return redirect()->route('admin_category_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "form geldi mi";
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
