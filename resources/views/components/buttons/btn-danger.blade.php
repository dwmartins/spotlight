<button 
    @if($id)
    id="{{ $id }}"   
    @endif

    class="btn btn-danger d-flex align-items-center justify-content-center btn-{{ $size }}"
    data-trans-loading="{{ $text_loading }}"
    onclick="{{ $onclick }}"
    type="{{ $type }}">

    @if ($useLoader)
        <x-loader 
            class="d-none spinner-loader"
            size="{{ $size }}"
            color="white"
        />
    @endif

    <span class="btn-text ms-1">{{ $text }}</span>
</button>