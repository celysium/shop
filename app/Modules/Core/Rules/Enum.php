<?php

namespace App\Modules\Core\Rules;

use App\Modules\Core\Traits\HasEnumeration;
use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;

class Enum implements ValidationRule
{

    public function __construct(private string $model)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @throws Exception
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $uses = class_uses($this->model);
        if (!in_array(HasEnumeration::class, $uses)) {
            throw new Exception("$this->model does not implement HasEnumeration");
        }
        $result = (new $this->model)::validationField($attribute, $value);
        if (!$result) {
            $fail('validation.enum')->translate();
        }
    }
}
