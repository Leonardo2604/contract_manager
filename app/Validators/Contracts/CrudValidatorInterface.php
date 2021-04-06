<?php

namespace App\Validators\Contracts;

use Illuminate\Contracts\Validation\Validator;

interface CrudValidatorInterface
{
    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    function onCreate(array $data): Validator;

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    function onUpdate(array $data): Validator;
}
