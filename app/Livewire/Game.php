<?php

namespace App\Livewire;

use App\Livewire\Forms\FormGame;
use App\Models\Award;
use App\Models\Game as Gameg;
use Livewire\Component;
use Cache;

class Game extends Component
{
    public FormGame $game_open;
    public $awards;
    public $games;
    
    public function render()
    {
        // if (Cache::has('showGames')) {
        //     $this->games = Cache::get('showGames');
        // }
        // else
        // {
           
        //     Cache::put('showGames',$this->games);
        // }
        $this->games = Gameg::with('award')
        ->orderBy('date_start','desc')
        ->get();
       
        return view('livewire.game',['games' => $this->games]);
    }

    public function openModalGame(){
        $this->game_open->open_modeal_game();
    }

    public function mount(){
       
        $this->awards = Award::all();
    }

    public function postGame(){

        $this->game_open->post_game();
        // Cache::forget('showGames');
        $this->games = Gameg::with('award')
                        ->orderBy('date_start','desc')
                        ->get();
    }


    public function editGame($id){
        $this->game_open->open_edit_modeal_game($id);

    }

    public function updateGame(){
        $this->game_open->update_game();

        $this->games = Gameg::with('award')
                        ->orderBy('date_start','desc')
                        ->get();
    }

    public function deleteGame($id){
        $this->game_open->delete_game($id);
        // Cache::forget('showGames');
        $this->games = Gameg::with('award')
                        ->orderBy('date_start','desc')
                        ->get();
    }
    
}
