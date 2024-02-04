# Experimental HydePHP BladeDown Extension

**Blurring the lines between Blade and Markdown**

## Alpha software warning ⚠️

This package is currently a proof of concept, and is not even remotely ready for production use.

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

<x-tweet url='https://twitter.com/aarondfrancis/status/1705211030882684946'>
    The best part about being 90% done with a project is that you're almost halfway finished!
</x-tweet>

<x-header image="media/my-image.png">
    <x-slot name="title">
        Lorem Ipsum
    </x-slot>

    Lorem ipsum dolor sit amet
</x-header>

## More stuff

Lorem ipsum dolor sit amet.
```

## Supported components

**We currently support the following subset of components.** 

As you can see, dynamic features like conditionals and loops are not supported.
This is because those kinds of things can quickly get complex, and it's more maintainable to keep that logic in dedicated component files.
Instead, the idea with this package is that you can easily include those components, and pass in the data you need.

### Echoing variables

All front matter properties are available as variables in the BladeDown file.

```markdown
---
name: World
---

# Hello, {{ $name }}! <!-- World -->
```

### Including components

```markdown

@include('components.alert')

@include('components.alert', ['type' => 'error'])

@component('components.alert')
    Something went wrong
@endcomponent
```

```markdown
<x-alert/>

<x-alert type="error" />

<x-alert type="error">
    Something went wrong
</x-alert>

<x-header image="media/my-image.png">
    <x-slot name="title">
        Lorem Ipsum
    </x-slot>

    Lorem ipsum dolor sit amet
</x-header>
```

### Upcoming

```markdown
@push('header')
    ## My header
@endpush

<x-slot name="footer">
    ## My footer
</x-slot>
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review the [security policy](../../security/policy) on how to report security vulnerabilities.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
