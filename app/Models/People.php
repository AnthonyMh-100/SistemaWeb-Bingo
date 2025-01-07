<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $table = 'participants';
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
    ];

    public function bingo(){
        return $this->belongsTo(Bingo::class);
    }
}
