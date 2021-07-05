<?php

namespace ELAO_ENUM_DT\Elao\Enum {

    if (!\class_exists(EnumInterfaceType::class)) {
        class EnumInterfaceType extends \Elao\Enum\Bridge\Doctrine\DBAL\Types\AbstractEnumType
        {
            public const NAME = 'role';

            protected function getEnumClass(): string
            {
                return \Elao\Enum\EnumInterface::class;
            }

            public function getName(): string
            {
                return static::NAME;
            }
        }
    }

}
