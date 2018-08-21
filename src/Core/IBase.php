<?php

namespace Xedit\Base\Core;


interface IBase
{

    /** Attributes */
    public function getId();

    public static function getUniqueName(): string;

}
