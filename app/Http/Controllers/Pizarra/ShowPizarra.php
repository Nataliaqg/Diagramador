<?php

namespace App\Http\Controllers\Pizarra;

use App\Http\Controllers\Controller;
use App\Models\pizarra;
use Illuminate\Http\Request;

class ShowPizarra extends Controller
{



    public function index($id){

         $pizarra = pizarra::find($id);       
       
        // return view('ecommerce.estudiofotografico',compact('estudiofotografico'),compact('especialidades'));
     
        return view('pizarra.ShowPizarra', compact('pizarra'));

    }
  

}
