# My HydePHP Package Name

This basic starter skeleton for a HydePHP Composer plugin is designed for you to use as a starting point for your own HydePHP Composer plugin. It's quite minimal by design, as what you will need for your package will depend on what kind of package you are building.

Start by using the repository template feature on GitHub to create a new repository from this template. Then clone your new repository to your local machine and start building your package.

If you need help, please feel free to ask for help in the [HydePHP Discord](https://discord.hydephp.com) or the [GitHub Developer Discussions](https://github.com/hydephp/develop/discussions).

General development tips:

- Read the Extensions API documentation at https://hydephp.com/docs/1.x/extensions-api
- Since HydePHP is based on Laravel, the packages work similarly. You most likely will want to use a service provider to register information. If you need access to the discovery process (for example, if you add a new page type), you'll want to use the Extensions API. As long as your provider class is registered in the `composer.json` file, your plugin can be enabled automatically when installed.

> Tip: Why not deploy your package documentation using HydePHP?

---

## Installation

You can install the package via Composer:

```bash
composer require hyde/bladedown
```

## Usage

You can use this package by doing something:

```php
use Vendor\PackageName\Inspire;

function beInspired(): {
  return Inspire::workMagick();
}
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review the [security policy](../../security/policy) on how to report security vulnerabilities.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
