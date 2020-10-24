<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
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
        $partner->id=$req->id;
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
        $partner->name=$req->name;
        $partner->id=$req->id;
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
