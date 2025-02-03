<button 
    @if($id)
    id="{{ $id }}"   
    @endif
    
    class="btn btn-primary d-flex align-items-center justify-content-center {{ $size ? "btn-$size" : "" }} {{ $class }}"
    data-trans-loading="{{ $text_loading }}"
    onclick="{{ $onclick }}"
    type="{{ $type }}">

    @if ($useLoader)
        <x-loader 
            class="d-none spinner-loader"
            color="white"
            size="{{ $size }}"
        />
    @endif

    <span class="btn-text ms-1">{{ $text }}</span>
</button>

