<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Address;
use App\Homedistrict;
use App\Product;
use App\Language;

class districtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd('kj');
        $sort_search =null;
        $districts = district::orderBy('name', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $districts = $districts->where('name', 'like', '%'.$sort_search.'%')->get();
        
        }
$districts = $districts->get();
        return view('districts.index', compact('districts', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('districts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $district = new district;
        $district->name = $request->name;
        $district->shipping_charge = $request->shipping_charge;
      
        if ($request->slug != null) {
            $district->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $district->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);
        }
        

        $data = openJSONFile('en');
        $data[$district->name] = $district->name;
        saveJSONFile('en', $data);

        

        // $district->digital = $request->digital;
        if($district->save()){
            flash(__('district has been inserted successfully'))->success();
            return redirect()->route('districts.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
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
    public function edit($id)
    {
        $district = district::findOrFail(decrypt($id));
        return view('districts.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $district = district::findOrFail($id);

        foreach (Language::all() as $key => $language) {
            $data = openJSONFile($language->code);
            unset($data[$district->name]);
            $data[$request->name] = "";
            saveJSONFile($language->code, $data);
        }

        $district->name = $request->name;
        $district->shipping_charge = $request->shipping_charge;
        // $district->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $district->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $district->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);
        }
        // $district->digital = $request->digital;
        if($district->save()){
            flash(__('district has been updated successfully'))->success();
            return redirect()->route('districts.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $district = district::findOrFail($id);
    //  dd($district);

        if(District::where('id', $district->id)->delete()){
            Address::where('district_id', $id)->delete();
        }
        // Homedistrict::where('district_id', $district->id)->delete();

        if(district::destroy($id)){
            foreach (Language::all() as $key => $language) {
                $data = openJSONFile($language->code);
                unset($data[$district->name]);
                saveJSONFile($language->code, $data);
            }

            if($district->banner != null){
                //($district->banner);
            }
            if($district->icon != null){
                //unlink($district->icon);
            }
            flash(__('district has been deleted successfully'))->success();
            return redirect()->route('districts.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function updateFeatured(Request $request)
    {
        $district = district::findOrFail($request->id);
        $district->featured = $request->status;
        if($district->save()){
            return 1;
        }
        return 0;
    }
}
