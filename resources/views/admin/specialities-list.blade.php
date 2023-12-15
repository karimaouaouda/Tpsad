<x-admin.wrapper>

    <div class="section-title w-[fit-content] mx-auto">
        <h1 class="py-2 text-xl uppercase mx-auto px-4">
            specialities list
        </h1>
        <div class="hr h-[1px] bg-gray-400"></div>
    </div>

    <div class="w-full flex justify-center ">
        <div class="container flex justify-center mx-auto">
            <div class="flex flex-col">
                <div class="w-full overflow-auto">
                    <div class="border-b border-gray-200 shadow">
                        <table class="divide-y divide-gray-300 ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        ID
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Name
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Email
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        places
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Created_at
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Edit
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300">

                                @if(count($specialities) > 0)
                                    @foreach ($specialities as $speciality)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            #{{$speciality->id}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{$speciality->name}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500 underline cursor-pointer">{{$speciality->university}}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{$speciality->places}}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{$speciality->created_at}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="px-4 py-1 text-sm text-indigo-600 bg-indigo-200 rounded-full">Edit</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            sorry no speciality found,
                                            <a class="underline text-sky-500" href="{{route('admin.create.speciality')}}">create one</a>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin.wrapper>
