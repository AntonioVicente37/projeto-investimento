<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['instituition_id', 'name', 'description', 'index', 'interest_rate'];

    public function instituition()
    {
        return $this->belongsTo(Instituition::class);
    }

    //Metodo para obter todas as operacoes de adicao de fundos
    public function valueFormUser(User $user)
    {
        $inflows = $this->moviments()->product($this)->applications()->sum('value');
        $outflows = $this->moviments()->product($this)->outflows()->sum('value');
        return $inflows - $outflows;
    }

    public function moviments()
    {
        return  $this->hasMany(Moviment::class);
    }

}
