<?php

namespace App\Validators\V1\Registers;

use App\Validators\Contracts\Registers\ModuleValidatorInterface;
use App\ValueObjects\Version;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as Validation;

class ModuleValidator implements ModuleValidatorInterface
{
    public function onCreate(array $data): Validation
    {
        return Validator::make($data, $this->onCreateRules());
    }

    public function onCreateAll(array $data): Validation
    {
        return Validator::make($data, $this->onCreateAllRules());
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
            'version' => "required|regex:" . Version::PATTERN,
            'value' => 'required|numeric|min:0|max:999999.99',
            'monthly_value' => 'required|numeric|min:0|max:99999.99'
        ];
    }

    private function onCreateAllRules(): array
    {
        $rules = [];

        foreach ($this->onCreateRules() as $input => $rule) {
            $rules["*.$input"] = $rule;
        }

        return $rules;
    }

    private function onUpdateRules(): array
    {
        return [
            'name' => 'required|max:120',
            'description' => 'nullable|max:450',
            'version' => "required|regex:" . Version::PATTERN,
            'value' => 'required|numeric|min:0|max:999999.99',
            'monthly_value' => 'required|numeric|min:0|max:99999.99'
        ];
    }
}
