<div class="mb-3">
    <label for="{{ $name }}" class="form-label text-capitalize">{{ $label ?: $name }}</label>
    <input type="file" class="form-control" name="{{ $name }}">
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
