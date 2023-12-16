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



</x-etudiant.wrapper>

