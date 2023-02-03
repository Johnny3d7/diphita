<?php

namespace App\Http\Controllers;

use App\Models\Adherents;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        return view('admin.messagerie.messages.index');
    }

    public function postSendMessages(Request $request){
        $request->validate([
            'message' => 'required',
            'num_adhesion' => 'required|exists:adherents,num_adhesion'
        ]);

        $message = $request->message;
        $adherent = Adherents::whereNumAdhesion($request->num_adhesion)->first();

        $conversion = [
            '%Nom%' => $adherent->nom,
            '%Prénoms%' => $adherent->pnom,
            '%MontantTotal%' => $adherent->montant_du(),
            '%MontantCotisationAnnuelle%' => $adherent->montant_annuel_du(),
            '%MontantCotisationExceptionnelle%' => $adherent->montant_exceptionnel_du(),
        ];
        $result = implode('<br>', explode("\n", trim($message)));

        foreach ($conversion as $var => $val) {
            $result = str_replace($var, $val, $result);
        }

        return [
            'success' => true,
            'msg' => "Message transmis avec succès à ".$adherent->num_adhesion
        ];
    }
}
