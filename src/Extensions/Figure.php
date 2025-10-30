<?php

namespace Awcodes\RicherEditor\Extensions;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Figure extends Node
{
    public static $name = 'figure';

    public function addOptions(): array
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function addAttributes(): array
    {
        return [
            'src' => [
                'default' => null,
                'parseHTML' => function ($DOMNode) {
                    return $DOMNode->firstChild->getAttribute('src');
                },
            ],
            'alt' => [
                'default' => null,
                'parseHTML' => function ($DOMNode) {
                    return $DOMNode->firstChild->getAttribute('alt');
                },
            ],
            'title' => [
                'default' => null,
                'parseHTML' => function ($DOMNode) {
                    return $DOMNode->firstChild->getAttribute('title');
                },
            ],
            'id' => [
                'parseHTML' => fn ($DOMNode) => $DOMNode->firstChild->getAttribute('data-id') ?: null,
                'renderHTML' => fn ($attributes) => ['data-id' => $attributes->id ?? null],
            ],
        ];
    }

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'figure',
                'contentElement' => 'figcaption',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): array
    {
        return [
            'figure',
            $this->options['HTMLAttributes'],
            ['img', HTML::mergeAttributes($HTMLAttributes)],
            ['figcaption', 0],
        ];
    }
}
