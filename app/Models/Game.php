<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = "games";
    protected $fillable =[
        'img_path',
        'name',
        'description',
        'date_start',
        'award_id',
        'cost'
    ];

    // protected function cost(): Attribute
    // {
    //     return Attribute::make(
    //         // Accessor: al obtener el valor
    //         get: fn ($value) => 'S/'.number_format($value,2,'.',','),
    //         // Mutator: al establecer el valor
    //         // set: fn ($value) => strtolower($value)
    //     );
    // }

    public function award(){
        return $this->belongsTo(Award::class);
    }

}
