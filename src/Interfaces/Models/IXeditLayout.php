<?php

namespace Xedit\Base\Interfaces\Models;

use Xedit\Base\Core\IBase;

interface IXeditLayout extends IBase
{
    /**
     * This flag indicate content node
     */
    const CONTENT_DOCUMENT = 'content';

    /**
     * This flag indicate include node
     */
    const INCLUDE_DOCUMENT = 'include';

    /** Attributes */
    public function getContent(): string;

    /** Methods */
    public static function get($attribute, $value): IXeditLayout;

    /** Relations */
    public function getComponent($condition): IXeditComponent;
}
