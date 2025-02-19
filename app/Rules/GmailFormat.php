<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GmailFormat implements Rule
{
    private $message;

    public function passes($attribute, $value)
    {
        if (!str_contains($value, '@')) {
            $this->message = 'Veuillez inserer un caractere @ sur votre adresse !';
            return false;
        }

        // Vérifie qu'il y a un caractère avant et après le "@"
        if (!preg_match('/^[^@]+@[^@]+$/', $value)) {
            $this->message = 'Veuillez entrer une adresse email valide !';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
