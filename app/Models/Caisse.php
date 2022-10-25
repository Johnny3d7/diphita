<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function solde(){
        // return $this->solde;
        return $this->solde + Versement::getMontant() - Depense::getMontant();
    }

    public function updateSolde(){
        $this->update(['solde' => $this->solde()]);
    }
}
