<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('manage subcategory'))
        {
            $user = \Auth::user()->current_store;
            $subcategorise   =  Subcategory::where('store_id',$user)->where('created_by', \Auth::user()->creatorId())->get();
            return view('subcategory.index',compact('subcategorise'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('create subcategory'))
        {
            $user = \Auth::user()->current_store;
            $category = Category::where('store_id',$user)->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            return view('subcategory.create',compact('category'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('create subcategory'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                'name' => 'required|max:120',
                            ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
            }

            $subcategory = new Subcategory();
            $subcategory->name = $request->name;
            $subcategory->category = $request->category;
            $subcategory->store_id = \Auth::user()->current_store;
            $subcategory->created_by = \Auth:: user()->creatorId();
            $subcategory->save();

            return redirect()->back()->with('success', __('Subcategory created successfully!'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        if(\Auth::user()->can('edit subcategory'))
        {
            $user = \Auth::user()->current_store;
            $category = Category::where('store_id',$user)->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            return view('subcategory.edit',compact('category','subcategory'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        if(\Auth::user()->can('edit subcategory'))
        {
            $validator = \Validator::make(
            $request->all(), [
                            'name' => 'required|max:120',
                        ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
            }

            $subcategory->name = $request->name;
            $subcategory->category = $request->category;
            $subcategory->created_by = \Auth:: user()->creatorId();
            $subcategory->update();

            return redirect()->back()->with('success', __('Subcategory updated successfully!'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        if(\Auth::user()->can('delete subcategory'))
        {
            $subcategory->delete();
            return redirect()->back()->with('success', __('Subategory deleted successfully.'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
