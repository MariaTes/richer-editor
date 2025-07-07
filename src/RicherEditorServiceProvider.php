<?php

namespace Awcodes\RicherEditor;

use Awcodes\RicherEditor\Support\RichContentRendererMixin;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RicherEditorServiceProvider extends PackageServiceProvider
{
    public static string $name = 'richer-editor';

    public static string $viewNamespace = 'richer-editor';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('awcodes/richer-editor');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
        //
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        RichContentRenderer::mixin(new RichContentRendererMixin);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'awcodes/richer-editor';
    }

    /** @return array<Asset> */
    protected function getAssets(): array
    {
        return [
            // Css::make('richer-editor-styles', __DIR__ . '/../resources/dist/richer-editor.css'),
            Js::make(
                id: 'rich-content-plugins/code-block-lowlight',
                path: __DIR__ . '/../resources/dist/code-block-lowlight.js'
            )->loadedOnRequest(),
            Js::make(
                id: 'rich-content-plugins/embed',
                path: __DIR__ . '/../resources/dist/embed.js'
            )->loadedOnRequest(),
        ];
    }

    /** @return array<class-string> */
    protected function getCommands(): array
    {
        return [
            //
        ];
    }

    /** @return array<string> */
    protected function getRoutes(): array
    {
        return [];
    }

    /** @return array<string, mixed> */
    protected function getScriptData(): array
    {
        return [];
    }
}
