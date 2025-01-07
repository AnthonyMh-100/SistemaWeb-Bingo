<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $table = 'awards';

    protected $fillable = [
        'img_path',
        'name',
        'status'
    ];
    public function game(){
        return $this->belongsTo(Game::class,'award_id');
    }

}
