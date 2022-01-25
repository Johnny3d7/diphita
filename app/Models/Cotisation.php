<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot() {
        parent::boot();
        
        static::creating(function($item) {
            // Log::info('Item Creating Event:'.$item);
            $newId = (count(static::all()->sortByDesc('id')) > 0 ? (int) substr(static::all()->sortByDesc('id')->first()->code_deces, 3) : 0) + 1;
            $item->code_deces = "AD-".($newId<10 ? '000' : ($newId<100 ? '00' : ($newId<1000 ? '0' : '') )).$newId;
            
            $date_annonce = $item->date_butoire;
            $date_annonce->subMonths(2);
            $item->date_annonce = Carbon::create($date_annonce->isoFormat('YYYY'), $date_annonce->isoFormat('MM'), 25, 0, 0, 0);
            $item->date_butoire->addMonths(2);
        });
    }

    public static function selectAll(){
        $tabYear = $result = [];
        $all = static::all();

        foreach ($all as $value) {
            $year = substr($value->date_butoire, 0, 4);
            if(!in_array($year, $tabYear)){
                $tabYear []= $year;
                $result[$year] = [];
            }
            $result[$year] []= $value;
        }

        return $result;
    }


}
