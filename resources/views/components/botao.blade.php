@props(['cor' => 'custom', 'href' => null])

@if($href)
    <a href="{{ $href }}" class="btn btn-{{ $cor }} {{ $attributes->get('class') }}">
        {{ $slot }}
    </a>
@else
    <button class="btn btn-{{ $cor }} {{ $attributes->get('class') }}" {{ $attributes->except('class') }}>
        {{ $slot }}
    </button>
@endif

<style>
    .btn-custom {
        background-color: #784eca;
        border-color: #784eca;
        color: white;
    }
    
    .btn-custom:hover {
        background-color: #5d3aa2;
        border-color: #5d3aa2;
        color: white;
    }
    
    .btn-outline-custom {
        color: #784eca;
        border-color: #784eca;
        background-color: transparent;
    }
    
    .btn-outline-custom:hover {
        background-color: #784eca;
        border-color: #784eca;
        color: white;
    }
</style>