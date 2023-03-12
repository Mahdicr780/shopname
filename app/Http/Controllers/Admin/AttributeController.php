<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();
        return view('admin-monstar.attributes.all',compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-monstar.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = Attribute::all();
        Attribute::create($request->all());
        toast()->success('ویژگی جدید با موفقیت ایجاد شد');
        return view('admin-monstar.attributes.all',compact('attributes'));
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
    public function edit(Attribute $attribute)
    {
        return view('admin-monstar.attributes.edit',compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $attribute->update($request->all());
        toast()->success('ویژگی با موفقیت ویرایش شد');
        return redirect('dashboard/attributes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return back();
    }
    public function getValues(Attribute $attribute)
    {
        $values = AttributeValue::where('attribute_id',$attribute->id)->get();
        return view('admin-monstar.attributes.values',compact('attribute','values'));
    }
    public function postValues(Request $request ,Attribute $attribute)
    {
        AttributeValue::create($request->all());
        toast()->success('مقدار مورد نظر با موفقیت ایجاد شد');
        return back();
    }
}
