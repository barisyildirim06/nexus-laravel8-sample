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
}
