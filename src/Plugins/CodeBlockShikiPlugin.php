<?php

namespace Awcodes\RicherEditor\Plugins;

use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\Plugins\Contracts\RichContentPlugin;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Icons\Heroicon;
use Tiptap\Core\Extension;
use Tiptap\Nodes\CodeBlockHighlight;

class CodeBlockShikiPlugin implements RichContentPlugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    /**
     * @return array<Extension>
     */
    public function getTipTapPhpExtensions(): array
    {
        return [
//            app(CodeBlockHighlight::class, [
//                'languageClassPrefix' => 'language-',
//            ]),
        ];
    }

    /**
     * @return array<string>
     *
     * @throws Exception
     */
    public function getTipTapJsExtensions(): array
    {
        return [
            FilamentAsset::getScriptSrc('rich-content-plugins/code-block-shiki', 'awcodes/richer-editor'),
        ];
    }

    /**
     * @return array<RichEditorTool>
     */
    public function getEditorTools(): array
    {
        return [
            RichEditorTool::make('codeBlock')
                ->label(__('filament-forms::components.rich_editor.tools.code_block'))
                ->jsHandler('$getEditor()?.chain().focus().toggleCodeBlock().run()')
                ->icon(Heroicon::CodeBracket)
                ->iconAlias('forms:components.rich-editor.toolbar.code-block'),
        ];
    }

    /**
     * @return array<Action>
     */
    public function getEditorActions(): array
    {
        return [];
    }
}
