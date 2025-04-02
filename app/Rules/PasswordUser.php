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
        // Vérifier qu'il y a au moins une lettre minuscule
        if (!preg_match('/[a-z]/', $value)) {
            $this->message = 'Veuillez insérer au moins une lettre minuscule dans votre mot de passe !';
            return false;
        }

        // Vérifier qu'il y a au moins 4 lettres minuscules
        if (preg_match_all('/[a-z]/', $value) < 4) {
            $this->message = 'Votre mot de passe doit contenir au moins 4 lettres minuscules !';
            return false;
        }

        // Vérifier qu'il y a au moins un caractère spécial
        if (!preg_match('/[@$!%*?&]/', $value)) {
            $this->message = 'Veuillez insérer au moins un caractère spécial dans votre mot de passe !';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
