<?php

namespace App\Listeners;

use App\Helpers\APPIPData;
use Illuminate\Auth\Events\Registered;
class CreateChatUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event) {
        try {


            $user                                  = $event->user;
            $ip_data                               = APPIPData::get();
            $data_chat['first_name']               = $user->first_name;
            $data_chat['last_name']                = $user->last_name;
            $data_chat['email']                    = $user->email;
            $data_chat['pass']                     = md5($_POST['password']);
            $data_chat['user_type']                = 'U';
            $data_chat['status']                   = 'A';
            $data_chat['tzone']                    = $ip_data->time_zone;
            $data_chat['country']                  = $ip_data->country_code;
            $data_chat['is_verified_email']        = 'N';
            $data_chat['join_date']                = now()->toDateTimeString();
            $data_chat['login_type']               = 'N';
            $data_chat['profile_url']              = '';
            $data_chat['user_social_session_data'] = '';
            $foundedBefore['email']                = $user->email;
            //saving the chat user in chat db
            $created       = \App\Models\ChatUser::updateOrCreate($foundedBefore, $data_chat);
            $created->pass = md5($created->id.$_POST['password']);
            $created->save();
        }catch(\Exception $ex){
            logger('CreateChatUser: there are some error when creating a chat user  '.$ex->getMessage());
        }

    }

}
