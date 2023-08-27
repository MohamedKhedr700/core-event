<?php
namespace Raid\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Raid\Core\Traits\Provider\WithCoreServiceProviderResolver;

class EventServiceProvider extends ServiceProvider
{
    use WithCoreServiceProviderResolver;

    /**
     * The commands to be registered.
     */
    protected array $commands = [];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerHelpers();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerEvents();
    }
}