<div class="mb-3">
    <label for="{{ $name }}" class="form-label text-capitalize">{{ $label ? $label : $name }}</label>
    <input type="text" class="form-control" id="{{ $id }}" name="{{ $name }}"
        placeholder="{{ $placeholder }}" required>
    <x-input-error :messages="$errors->get('{{ $name }}')" class="mt-2" />
</div>
