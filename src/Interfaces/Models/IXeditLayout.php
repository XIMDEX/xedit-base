<?php

namespace Xedit\Base\Interfaces\Models;

interface IXeditLayout
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
    public static function get($attribute, $value);

    /** Relations */
    public function getComponent($condition): IXeditComponent;
}
