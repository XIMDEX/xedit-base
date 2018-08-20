<?php

namespace Xedit\Base\Interfaces\Models;


interface IXeditContainer
{

    /** Attributes */
    public function getId();

    public function getTitle(): string;

    public function getContent(): string;

    /** Relations */
    public function getLayout(): IXeditLayout;

    public function getContainer($condition): IXeditContainer;


}
