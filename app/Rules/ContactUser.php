<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Contracts\Validation\Rule;

class ContactUser implements Rule
{
    private $message;

    public function passes($attribute, $value)
    {
        if (!preg_match('/^6/', $value)) {
            $this->message = 'Veuillez inserer le numero 6 au debut du contact !';
            return false;
        }

        if (!preg_match('/^\d{9}$/', $value)) {
            $this->message = 'Veuillez entrer 09 chiffres au total !';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
