<?php

namespace App\Livewire;

use App\Livewire\Forms\FormPeople;
use Livewire\Component;
use App\Models\People as Participant;

class People extends Component
{
    public FormPeople $form_open;
    public $people;
    public function render()
    {
        return view('livewire.people');
    }

    public function mount(){
        $this->people = Participant::all();
    }

    public function postPeople(){
        $this->form_open->post_people();
        $this->dispatch('postPeople','Participante creado');
        $this->people = Participant::all();

    }

    public function deletePeople($id){
        $people = Participant::find($id);
        $people->delete();
        $this->people = Participant::all();
    }

    public function editPeople($id){
        $this->form_open->edit_people($id);
    }

    public function updatePeople(){
        $this->form_open->edit_update();
        $this->people = Participant::all();
    }

}
