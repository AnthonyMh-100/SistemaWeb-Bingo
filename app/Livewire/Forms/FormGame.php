<?php

namespace App\Livewire\Forms;

use App\Models\Game;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormGame extends Form
{
    public $open = false;    
    public $open_edit= false;   
    public $game_id;   
    public $name;
    public $img_path;
    public  $description;
    public  $date_start;
    public  $award_id = '';
    public  $cost;

    public function open_modeal_game(){
        $this->open = true;
        $this->reset(['name','description','date_start','award_id','cost']);

    }

    public function post_game(){
        Game::create([
            'name' => $this->name,
            'description' => $this->description,
            'date_start' => $this->date_start,
            'award_id' => $this->award_id,
            'cost' => $this->cost,
        ]);
        $this->reset(['name','description','date_start','award_id','open','cost']);
    }

    public function open_edit_modeal_game($id){
        $game = Game::with('award')
                    ->where('id',$id)
                    ->first();

        $this->open_edit = true;
        $this->game_id = $game->id;

        $this->name = $game->name;
        $this->description = $game->description;
        $this->date_start = $game->date_start;
        $this->award_id = $game->award->id;
        $this->cost = $game->cost;

        
    }

    public function update_game(){
        $game = Game::findOrFail($this->game_id);

        $game->update([
            'name' => $this->name,
            'description' => $this->description,
            'date_start' => $this->date_start,
            'award_id' => $this->award_id,
            'cost' => $this->cost,
        ]);
        $this->reset(['name','description','date_start','award_id','open_edit','cost']);
    }
    
    public function delete_game($id){
        $game = Game::findOrFail($id);
        $game->delete();
    }
}
