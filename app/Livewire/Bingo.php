<?php

namespace App\Livewire;

use App\Livewire\Forms\FormBingo;
use App\Mail\SendPeople;
use App\Models\People;
use Livewire\Component;
use App\Models\Bingo as BingoPeople;
use Mail;
use Twilio\Rest\Client;



class Bingo extends Component
{
    public FormBingo $bingo_open;
    public $bingo_participants;
   
    public function render()
    {
        if (isset($this->bingo_open->game)) {
            $this->bingo_participants = BingoPeople::with('partcipants')
                                            ->where('game_id',$this->bingo_open->game->id)
                                            ->get();
        }
        else
        {
            $this->bingo_participants = [];
        }

        return view('livewire.bingo',['bingo_participants'=>$this->bingo_participants]);
    }

    public function mount(){
        $this->bingo_open->game = null;
    }

    public function gameUpdate(){
        $this->bingo_open->search_game();
    }


    public function searchPeople(){
        $this->bingo_open->search_people();
    }   

    public function addParticipant(){
        $this->bingo_open->add_participant();
        $this->bingo_participants = BingoPeople::with('partcipants')->get();
    }

    public function deleteParticipant($id){
        $this->bingo_open->delete_participant($id);
        $this->bingo_participants = BingoPeople::with('partcipants')->get();

    }

    public function editParticipant($id){
        $this->bingo_open->edit_participant($id);
    }

    public function updateParticipant(){
        $this->bingo_open->update_participant();
        $this->bingo_participants = BingoPeople::with('partcipants')->get();

    }

    public function sendMail(){

        // PRUEBA GRATUITA CON TWILIO

        // $sid    = env("TWILIO_SID");
        // $token  = env("TWILIO_TOKEN");
        // $twilio = new Client($sid, $token);
        // $message = $twilio->messages
        // ->create("+51930406916", // to
        //     array(
        //     "body" => "Hola Anthony Mensaje enviado",
        //     "from" => "+12186632161"
        //     )
        // );

        $this->bingo_open->send_mail();
        $this->dispatch("notify", "Se envio correos de forma exitosa!");
    }

}
