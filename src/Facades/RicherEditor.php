<?php

namespace Awcodes\RicherEditor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Awcodes\RicherEditor\RicherEditor
 */
class RicherEditor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Awcodes\RicherEditor\RicherEditor::class;
    }
}
