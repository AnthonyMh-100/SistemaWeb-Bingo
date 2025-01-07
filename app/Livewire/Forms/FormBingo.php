<?php

namespace App\Livewire\Forms;

use App\Mail\SendPeople;
use App\Models\Bingo;
use App\Models\People;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Game;
use Mail;

class FormBingo extends Form
{
    public $open = false;
    public $open_edit = false;
    public $bingo_id = false;
    public $search;
    public $search_people;
    public $participant;
    public $people;
    public $payment;
    public $mount;
    public $duty;
    public $game;
    public $winner='';

    public function search_game(){

        if($this->search){
            $game = Game::whereAny(['name','description'],'like','%'.$this->search.'%')
            ->first();
        }else{
            $game = null;
        }
      
        $this->game = $game;
    }

    public function search_people(){
        $people = People::whereAny(['name','last_name'],'like','%'.$this->search_people.'%')
                ->first();

        $this->people = $people;
        $this->participant = "{$people->name} {$people->last_name}";
    }

    public function add_participant(){

        $game_cost = floatval($this->game->cost);
        $this->mount = floatval($this->mount);
        $this->duty = $game_cost - $this->mount;

        Bingo::create([
            'date_game' => $this->game->date_start,
            'pay' =>  $this->payment,
            'game_id' => $this->game->id,
            'people_id' =>  $this->people->id,
            'mount' => $this->mount,
            'duty' => $this->duty,
            'winner' => $this->winner
        ]);
        $this->reset(['open','search_people','participant','people','payment','mount','duty','winner']); 
    }   

    public function delete_participant($id){
        Bingo::find($id)->delete();
    }

    public function edit_participant($id){
        $this->open_edit = true;
        $bingo = Bingo::with('partcipants')
                        ->where('id',$id)
                        ->first();

        $this->bingo_id = $bingo->id;
        $this->participant = "{$bingo->partcipants[0]->name} {$bingo->partcipants[0]->last_name}";
        $this->payment = $bingo->pay ? true : false;
        $this->mount = $bingo->mount;
        $this->winner = $bingo->winner ? true : false;
    }
    public function update_participant(){
        Bingo::find($this->bingo_id)
            ->update([
                'pay' => $this->payment,
                'mount' => $this->mount,
                'duty' => $this->duty,
                'winner' => $this->winner
            ]);
        $this->reset(['open_edit','search_people','participant','people','payment']);
    }

    public function send_mail(){

        $bingoGamer = Bingo::with(['partcipants'])
                            ->where('game_id', $this->game->id)
                            ->where('winner', true)
                            ->first();

        $game = Game::find($bingoGamer->game_id);
        $bingoGamer = $bingoGamer->partcipants[0];

        Mail::to($bingoGamer->email)->send(new SendPeople($bingoGamer,$game));
    }
}
