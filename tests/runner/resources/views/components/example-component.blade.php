@props(['message' => null])

@if(filled((string) $slot))
    <p>
        {{ $slot }}
    </p>
@else
    <p>
        Example component was called with {{ $message ?? 'no message' }}
    </p>
@endif
