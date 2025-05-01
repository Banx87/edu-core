<div class="mb-3">
    <div class="form-label">{{ $label ? $label : $name }}</div>
    <label class="form-check form-switch">
        <input name="{{ $name }}" type="checkbox" class="form-check-input" value="1"
            @checked($checked)">
        <span class="form-check-label">
            {{ $description }}
        </span>
    </label>
    <x-input-error :messages="$errors->get('{{ $name }}')" class="mt-2" />
</div>
