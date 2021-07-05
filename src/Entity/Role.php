<?php

namespace App\Role;

use Elao\Enum\ReadableEnum;

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
final class Role extends ReadableEnum
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

    public static function readables(): array
    {
        return [
            self::ADMIN => 'Role ADMIN',
            self::PAGE_1 => 'Role ONE',
            self::PAGE_2 => 'Role TWO',
        ];
    }
}
