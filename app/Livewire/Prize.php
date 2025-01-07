<?php

namespace App\Livewire;

use App\Livewire\Forms\FormPrize;
use App\Models\Award;
use Livewire\Component;
use Livewire\WithFileUploads;
use Cache;
class Prize extends Component
{
    
    use WithFileUploads;
    public FormPrize $prize_open;
    public $awards;
    
    
    public function render()
    {
        // if (Cache::has('showAWards')) {
        //     $this->awards = Cache::get('showAWards');
        // }
        // else
        // {
        //     Cache::put('showAWards',$this->awards);
        // }
        
        $this->awards = Award::all();
        return view('livewire.prize',['awards' => $this->awards]);
    }

   

    public function postAward(){
        $this->prize_open->post_award();
        // Cache::forget('showAWards');
        $this->awards = Award::all();
        
    }

    public function deleteAward($id){
        $this->prize_open->delete_award($id);
        // Cache::forget('showAWards');
        $this->awards = Award::all();
    }

    public function editAward($id){
        $this->prize_open->edit_award($id);
    }   

    public function updateAward(){
        $this->prize_open->update_award();
        // Cache::forget('showAWards');
        $this->awards = Award::all();

    }

    
}
