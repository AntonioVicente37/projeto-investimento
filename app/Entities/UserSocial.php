<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use illuminate\Foundation\Auth\UserSocial as Authenticatatble;

class UserSocial extends Model
{
    use SoftDeletes;
    use Notifiable;
    //

    public $timestemp = true;
    protected $table = 'user_socials';
    protected $fillable = ['user_id','social_network','social_id','social_email','social_avatar'];
    protected $hidden = [];
}
