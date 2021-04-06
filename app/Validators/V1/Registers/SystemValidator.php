<?php

namespace App\Validators\V1\Registers;

use App\Validators\Contracts\Registers\SystemValidatorInterface;
use App\ValueObjects\Version;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as Validation;

class SystemValidator implements SystemValidatorInterface
{
    public function onCreate(array $data): Validation
    {
        return Validator::make($data, $this->onCreateRules());
    }

    public function onUpdate(array $data): Validation
    {
        return Validator::make($data, $this->onUpdateRules());
    }

    private function onCreateRules(): array
    {
        return [
            'name' => 'required|max:120',
            'description' => 'nullable|max:450',
            'version' => "required|regex:" . Version::PATTERN
        ];
    }

    private function onUpdateRules(): array
    {
        return [];
    }
}
