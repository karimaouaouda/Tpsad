<x-admin.wrapper>

    <div class="section-title w-[fit-content] mx-auto">
        <h1 class="py-2 text-xl uppercase mx-auto px-4">
            new etudiant
        </h1>
        <div class="hr h-[1px] bg-gray-400"></div>
    </div>

    <div class="container drop-shadow-lg mt-2 mx-auto w-full md:w-4/5 bg-[#f5f5f5] rounded-lg p-2">
        <form action="{{route('admin.create.etudiant')}}" class="mx-auto" method="post">
            @csrf
            <div class="form-errors my-2"></div>
            <div class="inputs">
                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="university" class="block text-gray-500">university:</label>
                        <input id="university" placeholder="university..." type="text" name="university"
                               class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('university')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="name" class="block text-gray-500">speciality name:</label>
                        <input id="name" placeholder="speciality name..." type="text" name="name"
                               class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('name')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>



                <div class="inpt my-4 w-full text-center">
                    <label for="branch_name" class="block">select branch</label>
                    <select  class="m-auto w-4/5 border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 " name="branch_name" id="branch_name">
                        <option value="none" selected disabled>chose main module name</option>
                    </select>
                    @error('branch_name')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="places" class="block text-gray-500">places available:</label>
                        <input id="places" placeholder="places ..." type="number" min="0" name="places"
                               class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('places')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative flex items-center">
                        <input id="places" class="w-4 h-4" type="checkbox" name="bac_only">
                        <label for="bac_only" class="inline-block mx-1 text-gray-500">with bac direct</label>
                    </div>
                    @error('bac_only')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>

            </div>
            <div class="text-center my-4 w-4/5 mx-auto flex flex-col items-center justify-center">
                <button
                    class="w-4/5 mx-auto bg-green-500 text-white py-2 rounded-lg hover:bg-green-700 duration-300 ease-in-out">
                    <i class="bi bi-person-plus mr-2"></i>
                    create speciality
                </button>
            </div>
        </form>
    </div>

</x-admin.wrapper>
