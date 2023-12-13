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
                        <label for="matricule" class="block text-gray-500">name:</label>
                        <input id="matricule" placeholder="matricule..." type="text" name="matricule"
                            class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('matricule')
                        <div class="text-center text-red-400 font-medium">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="name" class="block text-gray-500">name:</label>
                        <input id="name" placeholder="name..." type="text" name="name"
                            class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('name')
                        <div class="text-center text-red-400 font-medium">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full text-center">
                    <select class="m-auto w-4/5 border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 " name="branch_name" id="branch_name">
                        <option value="none" selected disabled>chose branch name</option>
                    </select>
                    @error('branch_name')
                        <div class="text-center text-red-400 font-medium">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="name" class="block text-gray-500">email:</label>
                        <input id="email" placeholder="email..." type="email" name="email"
                            class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('email')
                        <div class="text-center text-red-400 font-medium">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="password" class="block text-gray-500">password:</label>
                        <input id="password" placeholder="password..." type="password" name="password"
                            class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('password')
                        <div class="text-center text-red-400 font-medium">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="bac_note" class="block text-gray-500">bac_note:</label>
                        <input id="bac_note" placeholder="bac note..." type="number" min="0" name="bac_note"
                            class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('bac_note')
                        <div class="text-center text-red-400 font-medium">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="bac_note" class="block text-gray-500">math_note:</label>
                        <input id="math_note" placeholder="math note..." type="number" min="0" name="math_note"
                               class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('math_note')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="bac_note" class="block text-gray-500">arab_note:</label>
                        <input id="arab_note" placeholder="math note..." type="number" min="0" name="arab_note"
                               class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('arab_note')
                    <div class="text-center text-red-400 font-medium">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="inpt my-4 w-full">
                    <div class="hi m-auto w-4/5 relative">
                        <label for="bac_note" class="block text-gray-500">science note:</label>
                        <input id="sci_note" placeholder="science note..." type="number" min="0" name="sci_note"
                               class="border-b border-l bg-transparent focus:bg-white border-sky-300 focus:border focus:border-sky-500 duration-150 ease-in-out outline-none h-10 px-4 w-full">
                    </div>
                    @error('sci_note')
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
                    create etudiant
                </button>
            </div>
        </form>
    </div>

</x-admin.wrapper>
