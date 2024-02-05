---
name: World
---

# Bladedown Test Page

## Hello, {{ $name }}!

---

## New x-component syntax

<x-example-component />

<x-example-component message="custom message" />

<x-example-component>
    Example component with slot content
</x-example-component>

<x-example-component>
    <x-slot name="title">
        Custom title slot
    </x-slot>

    <div class="custom">Custom body slot with title</div>
</x-example-component>

<x-example-component>
    <blockquote class="my-0" style="border-color: rebeccapurple">
        <p>
            Component with custom <abbr title="HyperText Markup Language">HTML</abbr> slot content 
        </p>   
    </blockquote>
</x-example-component>

---

## Classic @component syntax

@include('example-include')

@include('example-include', ['message' => 'custom message'])

@component('example-include')
    Example include with slot content
@endcomponent

@component('example-include')
    @slot('title')
        Custom included title slot
    @endslot

    <div class="custom">Custom included body slot with title</div>
@endcomponent

@component('example-include')
    <blockquote class="my-0" style="border-color: cornflowerblue">
        <p>
            Include with custom <abbr title="HyperText Markup Language">HTML</abbr> slot content 
        </p>   
    </blockquote>
@endcomponent
