<?php

namespace App\Entity;

use Elao\Enum\Enum;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Role
 *
 * @author sebastianvillar
 */
final class Role extends Enum
{
    public const ADMIN = 'ADMIN';
    public const PAGE_1 = 'PAGE_1';
    public const PAGE_2 = 'PAGE_2';

    public static function values(): array
    {
        return [
            self::ADMIN,
            self::PAGE_1,
            self::PAGE_2,
        ];
    }
}
