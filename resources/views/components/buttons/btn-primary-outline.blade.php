<button 
    id="{{ $id }}" 
    type="button" 
    class="btn btn-outline-primary d-flex align-items-center justify-content-center btn-{{ $size }}"
    data-trans-loading="{{ $text_loading }}"
    onclick="{{ $onclick }}">

    @if ($useLoader)
        <x-loader 
            class="d-none spinner-loader"
            size="{{ $size }}"
        />
    @endif

    <span class="btn-text ms-1">{{ $text }}</span>
</button>

