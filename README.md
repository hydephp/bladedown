# Experimental HydePHP BladeDown Extension

**Blurring the lines between Blade and Markdown**

## Installation

You can install the package via Composer:

```bash
composer require hyde/bladedown
```

## Usage

This package adds a new page type, `.blade.md`, which is a combination of Blade and Markdown. This allows you to use Blade directives in your Markdown files.

```markdown
---
name: World
---

# Hello, {{ $name }}!

@push('header')
## My header
@endpush

<x-slot name="footer">
## My footer
</x-slot>

## More stuff

Lorem ipsum dolor sit amet.
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review the [security policy](../../security/policy) on how to report security vulnerabilities.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
