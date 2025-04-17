# Laravel Authelia

Laravel Authelia is a package designed to integrate Laravel applications with [Authelia](https://www.authelia.com/), an open-source authentication and authorization server.

## Installation

Install the package via Composer:

```bash
composer require idoalit/laravel-authelia
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Idoalit\LaravelAuthelia\AutheliaServiceProvider"
```

This will create a `config/laravel-authelia.php` file where you can set up your Authelia integration.

## Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss changes.

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).