<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Bingo extends Model
{
    use HasFactory;

    protected $table = 'bingos';

    protected $fillable = [
        'date_game',
        'pay',
        'game_id',
        'people_id',
        'winner',
        'duty',
        'mount'
    ];

    protected function mount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value,2,'.',','),
            // Mutator: al establecer el valor
            // set: fn ($value) => strtolower($value)
        );
    }

    protected function duty(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value,2,'.',','),
            // Mutator: al establecer el valor
            // set: fn ($value) => strtolower($value)
        );
    }



    public function partcipants(){
        return $this->hasMany(People::class,'id','people_id');
    }
}
