<?php

namespace app\enums;

class CategoriaEnum
{
    const ESPORTES = 1;
    const ELETRONICOS = 2;
    const LAZER = 3;

    public static function getLabels()
    {
        return [
            self::ESPORTES => 'Esportes',
            self::ELETRONICOS => 'Eletrônicos',
            self::LAZER => 'Lazer',
        ];
    }

    public static function getLabel($id)
    {
        return self::getLabels()[$id] ?? null;
    }

    public static function getValues()
    {
        return array_keys(self::getLabels());
    }

    public static function isValid($value)
    {
        return in_array($value, self::getValues());
    }
} 