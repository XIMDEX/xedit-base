<?php

namespace Xedit\Base\Interfaces\Models;

use Xedit\Base\Core\IBase;

interface IXeditComponent extends IBase
{

    /** Attributes */
    public function getContent(): string;

    /** Relations */
    public function getView(): IXeditView;
}
