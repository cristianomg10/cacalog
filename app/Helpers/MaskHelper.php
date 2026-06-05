<?php

namespace App\Helpers;

class MaskHelper
{
    public static function cnpj(?string $value): string
    {
        if (empty($value)) return '';

        $digits = preg_replace('/\D/', '', $value);

        if (strlen($digits) !== 14) return $value;

        return preg_replace(
            '/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/',
            '$1.$2.$3/$4-$5',
            $digits
        );
    }

    public static function telefone(?string $value): string
    {
        if (empty($value)) return '';

        $digits = preg_replace('/\D/', '', $value);

        if (strlen($digits) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $digits);
        }

        if (strlen($digits) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $digits);
        }

        return $value;
    }
}
