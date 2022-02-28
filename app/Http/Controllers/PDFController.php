<?php

namespace App\Http\Controllers;

use App\Models\Adherents;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $adherent = Adherents::find($id);
        if(!$adherent) return back();
        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            // 'date' => date('m/d/Y'),
            'adherent' => $adherent
        ];
          
        $pdf = PDF::loadView('myPDF', $data);
    
        return $pdf->stream("adhesion-".$adherent->id.".pdf");
    }
}
