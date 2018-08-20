<?php

namespace Xedit\Base\Interfaces\Models;

interface IXeditComponent
{

    /** Attributes */
    public function getContent(): string;

    /** Relations */
    public function getView($condition): IXeditView;
}
