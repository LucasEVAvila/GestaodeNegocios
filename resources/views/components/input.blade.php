@props(['type' => 'text', 'label' => null, 'name' => '', 'value' => '', 'placeholder' => '', 'required' => false])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    
    <input 
        type="{{ $type }}" 
        class="form-control" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->except(['type', 'label', 'name', 'value', 'placeholder', 'required']) }}
    >
    
    @error($name)
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>