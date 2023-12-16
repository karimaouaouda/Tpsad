<x-etudiant.wrapper>
    <div class="section-title w-[fit-content] mx-auto">
        <h1 class="py-2 text-xl uppercase mx-auto px-4">
            chose specialities
        </h1>
        <div class="hr h-[1px] bg-gray-400"></div>
    </div>

    <div class="main-container bg-gray-50 drop-shadow-md p-2 mx-auto my-4 w-1/3">
        <p class="border border-red-400 px-4 py-2">
            <i class="bi bi-patch-exclamation px-1"></i> please be aware when you try to chose, because this is your futur
        </p>

        <form action="{{route('etudiant.chose')}}" class="mx-auto" method="post">
            @csrf
            <input type="hidden" name="guard" value="etudiant">
            <div class="form-errors my-2"></div>
            <div class="inputs">


                <div class="inpt my-4 w-full text-center">
                    <label for="choice_1" class="block">choice 1</label>
                    <select class="m-auto w-4/5 border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 " name="choice_1" id="choice_1">
                        <option value="none" selected disabled>chose branch name</option>
                        @foreach($specialities as $branch)
                            <option @selected( old('choice_1') == $branch->id ) value="{{$branch->id}}" >{{$branch->name}}</option>
                        @endforeach
                    </select>
                    @error('choice_1')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full text-center">
                    <label for="choice_2" class="block">choice 2</label>
                    <select class="m-auto w-4/5 border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 " name="choice_2" id="choice_2">
                        <option value="none" selected disabled>chose branch name</option>
                        @foreach($specialities as $branch)
                            <option @selected( old('choice_2') == $branch->id ) value="{{$branch->id}}" >{{$branch->name}}</option>
                        @endforeach
                    </select>
                    @error('choice_2')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full text-center">
                    <label for="choice_3" class="block">choice 3</label>
                    <select class="m-auto w-4/5 border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 " name="choice_3" id="choice_3">
                        <option value="none" selected disabled>chose branch name</option>
                        @foreach($specialities as $branch)
                            <option @selected( old('choice_3') == $branch->id ) value="{{$branch->id}}" >{{$branch->name}}</option>
                        @endforeach
                    </select>
                    @error('choice_3')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>


            </div>

            <div class="text-center my-4 w-4/5 mx-auto flex flex-col items-center justify-center">
                <button type="submit"
                        class="w-4/5 mx-auto bg-green-500 text-white py-2 rounded-lg hover:bg-green-700 duration-300 ease-in-out">
                    <i class="bi bi-card-checklist mr-2"></i>
                    validate
                </button>
            </div>
        </form>
    </div>


</x-etudiant.wrapper>
