<x-etudiant.wrapper>
    @if(session('status'))
        <script >
            Swal.fire({
                title: "information !",
                text: "{{session('status')}}",
                icon: "warning"
            });
        </script>
    @endif

    <div class="section-title w-[fit-content] mx-auto">
        <h1 class="py-2 text-xl uppercase mx-auto px-4">
            orientation result
        </h1>
        <div class="hr h-[1px] bg-gray-400"></div>
    </div>

    <div class="main-container bg-gray-50 drop-shadow-md p-2 mx-auto my-4 w-1/3">


        <div class="mx-auto">
            @csrf
            <input type="hidden" name="guard" value="etudiant">
            <div class="form-errors my-2"></div>
            <div class="inputs">


                @foreach($choices as $choice)
                    <div class="w-4/5 border text-center py-2 my-2 mx-auto">
                        <span @class(['font-medium' , 'text-red-500' => $oriented && $dir->id != $choice->id, 'text-green-500' => $oriented &&  $dir->id == $choice->id ])>
                             #{{$loop->iteration}} {{$choice->name}}
                        </span>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="result font-medium my-2 text-center mx-auto">
            @if($oriented)
                oriented to : {{$dir->name}}
            @else
                not yet oriented
            @endif
        </div>
    </div>


</x-etudiant.wrapper>
