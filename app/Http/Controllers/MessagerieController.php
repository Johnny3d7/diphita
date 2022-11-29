<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use Illuminate\Http\Request;

class MessagerieController extends Controller
{
    public function index() {
        // dd(new Campagne());
        // Campagne::create([
        //     'titre' => '$faker->word()',
        //     'description' => '$faker->sentences()',
        //     'nbre_destinataires' => rand(1,5),
        //     'destinataires' => '$faker->sentences()',
        //     // 'status' => 'pending',
        // ]);
        $campagnes = Campagne::all();
        return view('admin.messagerie.index', compact('campagnes'));
    }
}
