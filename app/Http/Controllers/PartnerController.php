<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Intervention\Image\Facades\Image;

class PartnerController extends Controller
{
    function partners(Request $request)
    {
        $name = $request->input('name');
        $per_page = $request->input('per_page');
        $data = Partner::where("name","like",$name."%")->paginate($per_page);
        return view('list',['partners'=>$data]);
    }
    function partnersbyid($id)
    {
        $data =Partner::find($id);
        return view('single',["data"=>$data]);
    }
    function add(Request $req)
    {
        $partner = new Partner;
        $partner->name=$req->name;
        $partner->photo=$req->file('photo')->store('uploads', 'public');
        $photo = Image::make(public_path('storage/' . $partner->photo))->fit(100,100);
        $photo->save();
        $result=$partner->save();
        if($result)
        {
            return ["Result"=>"Data is saved to database"];
        }
        else
        {
            return ["Result"=>"Data couldn't saved to database"];
        }
    }
    function update(Request $req,$id)
    {
        $partner = Partner::find($id);
        $partner->photo=$req->file('photo')->store('uploads', 'public');
        $photo = Image::make(public_path('storage/' . $partner->photo))->fit(100,100);
        $photo->save();
        $result=$partner->save();
        if($result)
        {
            return ["Result"=>"Data is updated to database"];
        }
        else
        {
            return ["Result"=>"Data couldn't updated to database"];
        }
    }
    function deletepartner($id)
    {
        $partner = Partner::find($id);
        $result= $partner->delete();
        if($result)
        {
            return ["Result"=>"Partner is deleted from database"];
        }
    }
}
