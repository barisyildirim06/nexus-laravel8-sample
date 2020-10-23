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
            return ["Result"=>"Data saved to database"];
        }
        else
        {
            return ["Result"=>"Data couldn't saved to database"];
        }
    }
}
