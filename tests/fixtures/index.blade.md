---
name: World
---

# Bladedown Test Page

## Hello, {{ $name }}!

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
