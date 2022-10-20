<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    protected $table = "site_user";
    public $connection = "mysql_chat";
    public $timestamps = false;
    public $fillable = [
        'first_name', 'last_name', 'username', 'email', 'pass', 'is_verified_email', 'gender', 'phone', 'address',
        'region', 'city', 'zip', 'country', 'dob', 'profile_url', 'photo_url', 'age', 'login_type', 'join_date',
        'tzone', 'last_login_time', 'status', 'user_social_session_data',
    ];
}
