# Experimental HydePHP Bladedown Extension

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

<x-header image="media/my-image.png">
    <x-slot name="title">
        Lorem Ipsum
    </x-slot>

    Lorem ipsum dolor sit amet
</x-header>

## More stuff

Lorem ipsum dolor sit amet.

@include('related-posts')

@push('footer')
<script src="https://example.com/script.js"></script>
@endpush
```

## Supported components

**We currently support the following subset of components.** 

As you can see, dynamic features like conditionals and loops are not supported.
This is because those kinds of things can quickly get complex, and it's more maintainable to keep that logic in dedicated component files.
Instead, the idea with this package is that you can easily include those components, and pass in the data you need.

### Echoing variables

All front matter properties are available as variables in the Bladedown file.

```markdown
---
name: World
---

# Hello, {{ $name }}! <!-- World -->
```

### Including components

```markdown
@include('related-posts')

@include('related-posts', ['limit' => 5])

@component('faq-item')
    @slot('question') How do I get started? @endslot
    @slot('answer') Check our detailed documentation for step-by-step instructions. @endslot
@endcomponent

@component('faq-item')
    @slot('question') Can I customize the appearance? @endslot
    @slot('answer') Yes, the styles are easily customizable to fit your design. @endslot
@endcomponent
```

```markdown
<x-news-banner />

<x-news-banner message="New package released!" />

<x-feature-card image="media/feature-image.png">
    <x-slot name="title">Exciting Feature</x-slot>
    <p>This feature allows you to do incredible things!</p>
</x-feature-card>
```

### Pushing to stacks

The push directive allows you to push to any stack in your layout. Perfect if you need to add a script or style for a specific page.

```markdown
@push('header')
    ## My header
@endpush

@push('footer')
<script>
    console.log('Hello, World!');
</script>
@endpush
```

Note that only `@push` is supported and not similar ones like `@prepend`, `@pushonce`, `@pushIf`, or named layout `x-slots`.

## Information

### Contributing

Contributions are welcome. Please see the [hydephp/develop](https://github.com/hydephp/develop/issues) monorepo for details.

### Security Considerations

Remember that this package by design allows you to execute any arbitrary PHP code, regardless of the default HydePHP Markdown security settings.

The package assumes that you trust the authors of the Bladedown files, and take the same care as you would with any other PHP file in your project.

### Security Vulnerabilities

Please review the [security policy](../../security/policy) on how to report security vulnerabilities.

### License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
