<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Contracts\Validation\Rule;

class PasswordUser implements Rule
{
    private $message;

    public function passes($attribute, $value)
    {
        if (!preg_match('/[A-Z]/', $value)) {
            $this->message = 'Veuillez inserer au moins une majuscule sur votre password !';
            return false;
        }

        if (!preg_match('/[a-z]/', $value)) {
            $this->message = 'Veuillez inserer au moins une minuscule sur votre password !';
            return false;
        }

        if (!preg_match('/\d/', $value)) {
            $this->message = 'Veuillez inserer au moins un chiffre sur votre password !';
            return false;
        }

        if (!preg_match('/[@$!%*?&]/', $value)) {
            $this->message = 'Veuillez inserer au moins un caractere sur votre password !';
            return false;
        }

        return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $value);
    }

    public function message()
    {
        return $this->message;
    }
}
