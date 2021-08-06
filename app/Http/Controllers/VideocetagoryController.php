<?php

namespace App\Http\Controllers;

use App\Models\Videocetagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class VideocetagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!session()->get("userId")) {
        //     return Redirect::to('loginPage');
        // }
        return view("yamba/addVideoCategory");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $cetagory = new Videocetagory();
            $cetagory->name = $request->input("name");
            $cetagory->save();
            return Redirect::to("allVideoCategories");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Videocetagory $category)
    {
        return view("yamba/showVideoCategory")->with("registeredVideoCategories", Videocetagory::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Videocetagory $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videocetagory $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videocetagory $category, $cat_id)
    {
        Videocetagory::destroy(array("id", $cat_id));
        return Redirect::to("allVideoCategories");
    }
}
