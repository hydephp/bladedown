@props(['message' => null])

<div style="border: 1px solid grey; padding: 1rem; margin-top: 1rem;">
    @isset($title)
        <strong>{{ $title }}</strong>
    @endisset

    @if(isset($slot) && filled((string) $slot))
        {{ $slot }}
    @else
        Example include was called with {{ $message ?? 'no message' }}
    @endif
</div>
