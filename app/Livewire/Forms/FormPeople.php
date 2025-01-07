<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\People as Participant;

class FormPeople extends Form
{
    public $open = false;
    public $open_edi = false;
    public $edi_id;


    public $name;
    public $last_name;
    public $phone;
    public $email;

    
    public $name_edi;
    public $last_name_edi;
    public $phone_edi;
    public $email_edi;



    public function post_people(){
        
        Participant::create($this->only(['name','last_name','phone','email']));
        $this->reset(['name','last_name','phone','email','open']);
       
    }


    public function edit_people($id){
        $this->open_edi = true;

        $peolpe = Participant::findOrFail($id);

        $this->edi_id = $peolpe->id;

        $this->name_edi = $peolpe->name;
        $this->last_name_edi = $peolpe->last_name;
        $this->email_edi = $peolpe->email;
        $this->phone_edi = $peolpe->phone;

    }

    public function edit_update(){
        
        $people = Participant::findOrFail($this->edi_id);
        $people->update([
            'name' => $this->name_edi,
            'last_name' => $this->last_name_edi,
            'phone' => $this->phone_edi,
            'email' => $this->email_edi
        ]);

        $this->reset(['name_edi','last_name_edi','phone_edi','email_edi','open_edi','edi_id']);

    }



}
