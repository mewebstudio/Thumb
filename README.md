# PHPThumb for Laravel 4 (Personal version)

A simple [Laravel 4](http://four.laravel.com/) service provider for including the [PHPThumb for Laravel 4](https://github.com/mewebstudio/Thumb).

## Installation

The PHPThumb Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`mews/phpthumb` package and setting the `minimum-stability` to `dev` (required for Laravel 4) in your
project's `composer.json`.

```json
{
    "require": {
        "laravel/framework": "4.0.*",
        "mews/thumb": "dev-master"
    },
    "minimum-stability": "dev"
}
```

Update your packages with ```composer update``` or install with ```composer install```.

## Usage

To use the PHPThumb Service Provider, you must register the provider when bootstrapping your Laravel application. There are
essentially two ways to do this.

Find the `providers` key in `app/config/app.php` and register the PHPThumb Service Provider.

```php
    'providers' => array(
        // ...
        'Mews\Thumb\ThumbServiceProvider',
    )
```

Find the `aliases` key in `app/config/app.php`.

```php
    'aliases' => array(
        // ...
        'Thumb' => 'Mews\Thumb\Facades\Thumb',
    )
```

## Example

```php
    //[your site path]/app/routes.php

    Route::get('/media/image/{width}x{height}/{image}', function($width, $height, $image)
    {
        $file = base_path() . '/' . $image;
        // for remote file
        //$file = 'http://i.imgur.com/1YAaAVq.jpg';
        Thumb::create($file)->make('resize', array($width, $height))->show()->save(base_path() . '/', 'aaa.jpg');
        /*
            Thumb::create($file)->make('resize', array($width, $height))->make('crop', array('center', $width, $height))->show();
            Thumb::create($file)->make('resize', array($width, $height))->make('crop', array('basic', 100, 100, 300, 200))->show();
            Thumb::create($file)->make('resize', array($width, $height))->make('resize', array($width, $height))->show();
            Thumb::create($file)->make('resize', array($width, $height))->make('resize', array($width, $height, 'adaptive'))->save(base_path() . '/', 'aaa.jpg')->show();
            Thumb::create($file)->make('resize', array($width, $height))->rotate(array('degree', 180))->show();
            Thumb::create($file)->make('resize', array($width, $height))->reflection(array(40, 40, 80, true, '#a4a4a4'))->show();
            Thumb::create($file)->make('resize', array($width, $height))->save(base_path() . '/', 'aaa.jpg');
            Thumb::create($file)->make('resize', array($width, $height))->show();
        */

    });
```

^_^                         


## Links

* [PHPThumb Library website](http://phpthumb.gxdlabs.com/)

* [L4 PHPThumb on Github](https://github.com/mewebstudio/Thumb)
* [L4 PHPThumb on Packagist](https://packagist.org/packages/mews/thumb)
* [License](http://www.opensource.org/licenses/mit-license.php)
* [Laravel website](http://laravel.com)
* [Laravel Turkiye website](http://www.laravel.gen.tr)
* [MeWebStudio website](http://www.mewebstudio.com)
