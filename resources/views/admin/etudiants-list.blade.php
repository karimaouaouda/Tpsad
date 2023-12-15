<x-admin.wrapper>

    <div class="section-title w-[fit-content] mx-auto">
        <h1 class="py-2 text-xl uppercase mx-auto px-4">
            etudiants list
        </h1>
        <div class="hr h-[1px] bg-gray-400"></div>
    </div>

    <div class="w-full flex justify-center">
        <div class="container flex justify-center mx-auto">
            <div class="flex flex-col">
                <div class="w-full">
                    <div class="border-b border-gray-200 shadow">
                        <table class="divide-y divide-gray-300 ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        matricule
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Name
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Email
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        branch
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        speciality
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

                                @if(count($etudiants) > 0)
                                    @foreach ($etudiants as $etudiant)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $etudiant->matricule  }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $etudiant->name  }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500">
                                                {{ $etudiant->email  }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $etudiant->branch->name  }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if($etudiant->oriented)
                                                {{$etudiant->speciality->name}}
                                            @else
                                                not yet
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{route('admin.etudiant.edit', ['etudiant' => $etudiant->matricule])}}" class="px-4 py-1 text-sm text-indigo-600 bg-indigo-200 rounded-full">Edit</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{route('admin.etudiant.remove', ['etudiant' => $etudiant->matricule])}}" method="post">
                                                @csrf
                                                <button class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full" type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            sorry no etudiant found,
                                            <a class="underline text-sky-500" href="{{route('admin.create.etudiant')}}">create one</a>
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
