<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'instituition_id'];

    //Obtendo o somatorio de todos os valores ivestidos
    public function getTotalValueAttribute()
    {
        /*$total = 0;
        foreach($this->moviments as $moviment)
            $total += $moviment->value;*/
        return $this->moviments->sum('value');
    }

    //Com a funcao owner estamos a dizer que a variavel user_id e a outra pertecem ou sao relacionadas a user e i
    //instutuicao
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        //Relacionamento N:N com Many
        return $this->belongsToMany(User::class, 'user_groups');
    }

    public function instituition(){
        return $this->belongsTo(Instituition::class);
    }

    public function moviments()
    {
        return $this->hasMany(Moviment::class);
    }

}
