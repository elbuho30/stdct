<div class="flex items-center space-x-2">
    @php
        if(!empty($this->record->nombre1)){
            $nombres = $this->record->nombre1 . ' ' . $this->record->nombre2;
            $apellidos = $this->record->apellido1 . ' ' . $this->record->apellido2;
            $full_name = $nombres . ' ' . $apellidos;
        }else{
            $full_name = $this->record->razon_social;
        }
    @endphp
    <span style="width: 50%" class="h-24 text-2xl w-full">{{$full_name}}</span>
    {{-- <span style="width: 50%" class="h-24 justify-end flex">
        @if (file_exists(public_path('/img/fotos/'.$this->record->nro_documento.".png")))
            <Img src="/img/fotos/{{$this->record->nro_documento}}.png" style="border: solid 1px rgba(var(--primary-500),1); box-shadow: 0px 0px 3px rgba(var(--gray-950),1);" class="h-full w-20 rounded"></Img>
        @else
            <Img src="/img-resources/user.png" style="border: solid 1px rgba(var(--primary-500),1); box-shadow: 0px 0px 3px rgba(var(--gray-950),1);" class="h-full w-20 rounded"></Img>
        @endif
    </span> --}}

    <span style="width: 50%" class="h-24 justify-end flex">
        @if (file_exists(public_path('/img/fotos/'.$this->record->nro_documento.".jpg")))
            <Img src="/img/fotos/{{$this->record->nro_documento}}.jpg" style="border: solid 1px rgba(var(--primary-500),1); box-shadow: 0px 0px 3px rgba(var(--gray-950),1);" class="h-full w-20 rounded"></Img>
        @elseif (file_exists(public_path('/img/fotos/'.$this->record->nro_documento.".png")))
            <Img src="/img/fotos/{{$this->record->nro_documento}}.png" style="border: solid 1px rgba(var(--primary-500),1); box-shadow: 0px 0px 3px rgba(var(--gray-950),1);" class="h-full w-20 rounded"></Img>
        @else
            <Img src="/img-resources/user.png" style="border: solid 1px rgba(var(--primary-500),1); box-shadow: 0px 0px 3px rgba(var(--gray-950),1);" class="h-full w-20 rounded"></Img>
        @endif
    </span>

</div>
