<?php

namespace Quill\Tag;

use Vellum\Module\Quill;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Quill\Tag\Listeners\RegisterTagModule;
use Quill\Tag\Listeners\RegisterTagPermissionModule;
use Quill\Tag\Resource\TagResource;
use App\Resource\Tag\TagRootResource;
use Quill\Tag\Models\TagObserver;

class TagServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadModuleCommands();
        $this->loadRoutesFrom(__DIR__ . '/routes/tag.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'tag');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/tag.php', 'tag');

        TagResource::observe(TagObserver::class);

        if (class_exists('App\Resource\Tag\TagRootResource')) {
        	TagRootResource::observe(TagObserver::class);
        }

        // $this->publishes([
        //     __DIR__ . '/config/tag.php' => config_path('tag.php'),
        // ], 'tag.config');

        // $this->publishes([
        //    __DIR__ . '/views' => resource_path('/vendor/tag'),
        // ], 'tag.views');

        $this->publishes([
        	__DIR__ . '/database/factories/TagFactory.php' => database_path('factories/TagFactory.php'),
            __DIR__ . '/database/seeds/TagTableSeeder.php' => database_path('seeds/TagTableSeeder.php'),
        ], 'tag.migration');
    }

    public function register()
    {
        Event::listen(Quill::MODULE, RegisterTagModule::class);
        Event::listen(Quill::PERMISSION, RegisterTagPermissionModule::class);
    }

    public function loadModuleCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([

            ]);
        }
    }
}
