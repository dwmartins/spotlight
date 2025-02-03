<div class="textareaComponent position-relative">
    <textarea 
        id="{{ $id }}" 
        name="{{ $name }}" 
        maxlength="{{ $maxChars }}" 
        placeholder="{{ $placeholder }}" 
        rows="{{ $rows }}"
        class="form-control custom_focus text-secondary {{ $class }}"
        oninput="updateCharCount('{{ $id }}', {{ $maxChars }})"
    >{{ $value }}</textarea>

    <div class="char-counter text-secondary fs-7">
        <span id="char-counter-{{ $id }}">{{ strlen($value ?? '') }}</span>|{{ $maxChars }}
    </div>
</div>

<script>
    function updateCharCount(id, maxChars) {
        const textarea = document.getElementById(id);
        const counter = document.getElementById(`char-counter-${id}`);
        counter.textContent = textarea.value.length;
    }
</script>