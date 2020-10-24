<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
class PartnerController extends Controller
{
    function partners($id=null)
    {
        return $id?Partner::find($id):Partner::all();
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
}
