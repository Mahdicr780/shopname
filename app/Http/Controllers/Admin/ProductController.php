<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('admin-monstar.products.all',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin-monstar.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $data = $request->validate([
            'title' => 'required|min:3|max:25',
            'text' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'user_id' => 'required',
            'metaTitle' => 'nullable',
            'metaDescription' => 'nullable'
        ]);
        //image
        if($request->hasFile('image')){
            $image = $request->image;
            $path = time() . $image->getClientOriginalName();
            $path = str_replace('','-',$path);
            $image->move('storage/products/',$path);
            $path = 'storage/products/'.$path;
        }

        $product = Product::create($data);
        $product->categories()->sync($data['categories']);
        $product->update([
            'image' => $path
        ]);
        $product = Product::all();
        toast()->success('محصول جدید با موفقیت ایجاد شد');
        return redirect('dashboard/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin-monstar.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:25',
            'text' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'categories' => 'required'

        ]);
        $product->update($data);
        $product->categories()->sync($data['categories']);
        $product = Product::all();
        toast()->success('محصول جدید با موفقیت ویرایش شد');
        return redirect('dashboard/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        toast()->success('محصول جدید با موفقیت حذف شد');
        return back();
    }
}
