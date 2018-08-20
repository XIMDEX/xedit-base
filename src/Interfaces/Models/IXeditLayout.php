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

    /** Relations */
    public function getComponent($condition): IXeditComponent;
}
