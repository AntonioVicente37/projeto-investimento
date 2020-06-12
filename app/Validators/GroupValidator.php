<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class GroupValidator.
 *
 * @package namespace App\Validators;
 */
class GroupValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'user_id' => 'required ',
            'instituition_id' => 'required', 
            //exists:nome_table,id
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
        ],
    ];
}
