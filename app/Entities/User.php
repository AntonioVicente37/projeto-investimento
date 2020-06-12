<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     *
     */
    public    $timestemp = true;
    protected $table = 'users';
    protected $fillable = ['cpf', 'name', 'phone','birth','gender', 'notes', 'email', 'password', 'status', 'permisssion'];
    protected $hidden = ['password', 'remenber_token'];

    public function setPassswordAttribute($value){
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value;
    }

    public function groups()
    {   //indica que o usuario pertence a varios grupos ele tem uma relacao N:N
        return $this->belongsToMany(Group::class, 'user_groups');
    }

    //Folucao usada para resolver o erro de cadastro de usuarios no nosso sistema 
    //user->cpf
    //user->formatted_cpf
    
    public function getFormattedCpfAttribute(){
        $cpf = $this->attributes['cpf'];
        return substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 7, 3).'-'.substr($cpf, -2);
    }

    public function getFormattedPhoneAttribute(){
        $phone = $this->attributes['phone'];
        return "(".substr($phone, 0, 2).")".substr($phone, 3, 4)."-".substr($phone, -4);
    }

    public function getFormattedBirthAttribute(){
        $birth = explode('-',$this->attributes['birth']);

        if(count($birth) != 3)
            return "";
        $birth = $birth[2].'/'.$birth[1].'/'.$birth[0];
        return $birth;
    }
}
