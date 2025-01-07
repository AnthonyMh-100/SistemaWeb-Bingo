<?php

namespace App\Livewire\Forms;

use App\Models\Award;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormPrize extends Form
{
    public $open = false;
    public $open_edit = false;

    public $edit_id;

    public $name;
    public $status;

    public $img;

    public function post_award(){
        
        if ($this->img) {
            $path = $this->img->store('awards', 'public');
            Award::create([
                'img_path' => $path,
                'name' => $this->name,
                'status' => false,
            ]);
        }

        $this->reset(['img','name','status','open']);
    }

    public function delete_award($id){
        $award = Award::find($id);
        $award->delete();  
    }

    public function edit_award($id){
        $this->open_edit = true;

        $award = Award::findOrFail($id);

        $this->edit_id = $award->id;
        $this->name = $award->name;
        $this->status = $award->status;

    }

    public function update_award(){
        $award = Award::findOrFail($this->edit_id);

        $award->update([
            // 'img_path' => $this->img,
            'name' => $this->name,
            'status' => $this->status,
        ]);

        $this->reset(['open_edit','edit_id']);

    }




}
