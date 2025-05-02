<div class="mb-3" style="display: flex; flex-direction: column;">
    <label for="imagePreview" class="form-label text-capitalize">{{ $label }}</label>
    <img {{ $attributes->merge(['class' => 'img-fluid']) }} {{-- src="{{ $src }}" alt="{{ $alt }} --}} "
        id="imagePreview" name="imagePreview" style="max-width: 150px; margin-bottom: 25px; height: auto; object-fit: cover;">
</div>
