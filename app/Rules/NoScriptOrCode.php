<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoScriptOrCode implements Rule
{
    public function passes($attribute, $value)
    {
        // Vérifier si la valeur contient des balises HTML ou des caractères spéciaux
        if (strip_tags($value) !== $value || preg_match('/["<>{}()\/\\\\]/', $value)) {
            return false;
        }

        // Vérifier les mots-clés SQL potentiellement dangereux
        $sqlKeywords = [
            'SELECT', 'INSERT', 'UPDATE', 'DELETE', 'DROP', 'TRUNCATE', 'ALTER', 'CREATE',
            'RENAME', 'GRANT', 'REVOKE', 'UNION', 'JOIN', 'AND', 'OR', 'NOT'
        ];

        foreach ($sqlKeywords as $keyword) {
            if (stripos($value, $keyword) !== false) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'Ne pas saisir des injections (scripts, codes ou requêtes SQL) !';
    }
}
