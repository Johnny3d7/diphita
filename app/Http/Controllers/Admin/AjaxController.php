<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adherents;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function getBenefNomPnom($num_adhesion)
    {
        //
        echo json_encode(Adherents::where(['num_adhesion' => $num_adhesion])->first());
    }
}
