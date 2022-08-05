<?php

namespace App\Http\Controllers;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Http\Request;
use App\Models\User;

class BotmanController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) {
            $this->askName($botman);
        });

        $botman->listen();


    }

    public function askName($botman)
    {
        $botman->ask('Ismingiz nima?', function(Answer $answer) {

            $name = $answer->getText();
            $this->say('Tanishganimdan xursandman '.$name, '1307688882', TelegramDriver::class);
            $this->say($name.", iltimos formani to'ldiring");
            /*$this->say('<form>
                            <input type="hidden" name="_token" id="_token"value="MLWBn36UByqirtREJzQpYkjhm5Ucxik9CK1CofRK">
                            <input type="text" id="name"  name="name" placeholder="F.I.SH"/>
                            <input type="text" id="email" name="email" placeholder="Email"/>
                            <input type="text" id="phone" name="phone" placeholder="Telefon"/>
                            <button type="submit" id="btn">saqlash</button>
                        </form>'.
                        "<script>
    jQuery(document).ready(function(){
        jQuery('#btn').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('#_token').val()
                }
            });
            jQuery.ajax({
                url: '{{ url('/user/save') }}',
                method: 'post',
                data: {
                email: jQuery('#email').val(),
                    name: jQuery('#name').val(),
                    phone_number: jQuery('#phone').val()
                },
                success: function(result){
                console.log(result);
            }});
        });
    });
</script>");*/
        });

//        return $this->handle();

    }

    public function save(Request $request){

        User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone_number'=>$request->input('phone'),
        ]);


        return $this->handle();
    }

}
