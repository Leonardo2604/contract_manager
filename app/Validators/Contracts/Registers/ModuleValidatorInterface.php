<?php

namespace App\Validators\Contracts\Registers;

use Illuminate\Contracts\Validation\Validator;
use App\Validators\Contracts\CrudValidatorInterface;

interface ModuleValidatorInterface extends CrudValidatorInterface
{
    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    function onCreateAll(array $data): Validator;
}
