---
title: Custom Layout
extends: layouts.my-custom-layout # Todo we could try to prepend the layouts directory if that's standard and the file is not find in the view root
background: cornflowerblue
name: World
---

# Hello, {{ $name }}!

This uses the custom layout `layouts.my-custom-layout` and sets the background to `cornflowerblue`.

[Back to index](/)

[//]: # (---)

@push('header')
This was pushed to the layout's header section.
@endpush

@push('header')
Stacks can be pushed to multiple times.
@endpush

@push('footer')
Of course, you can also use HTML and scripts.

<script>
    console.log('Hello, World! (From footer push)');
</script>
@endpush

