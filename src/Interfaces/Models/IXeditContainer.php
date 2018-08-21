<?php

namespace Xedit\Base\Interfaces\Models;


use Xedit\Base\Core\IBase;

interface IXeditContainer extends IBase
{

    /** Attributes */
    public function getTitle(): string;

    public function getContent(): string;

    /** Methods */
    public function saveContent($content): bool;

    /** Relations */
    public function getLayout(): IXeditLayout;

}
