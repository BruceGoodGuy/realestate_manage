<?php

namespace App\Providers;

use App\Interfaces\Client\ClientRepositoryInterface;
use App\Repositories\Clients\ClientRepository;
use App\Interfaces\Property\PropertyRepositoryInterface;
use App\Repositories\Properties\PropertyRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Posts\PostRepository;
use App\Interfaces\Post\PostRepositoryInterface;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(
            PostRepositoryInterface::class,
            PostRepository::class,
        );
        $this->app->singleton(
            ClientRepositoryInterface::class,
            ClientRepository::class
        );
        $this->app->singleton(
            PropertyRepositoryInterface::class,
            PropertyRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->numbers()
                ->mixedCase()
                ->uncompromised();
        });

        Validator::extend('file_extension', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof UploadedFile) {
                return false;
            }

            $extensions = implode(',', $parameters);
            $validator->addReplacer('file_extension', function (
                $message,
                $attribute,
                $rule,
                $parameters
            ) use ($extensions) {
                return \str_replace(':values', $extensions, $message);
            });

            $extension = strtolower($value->getClientOriginalExtension());

            return $extension !== '' && in_array($extension, $parameters);
        });
    }
}
