<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>


    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <img class="h-14" src="{{asset('./assets/media/guelma-logo.png')}}" alt="univ-guelma logo">
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900">First Link</a>
                <a class="mr-5 hover:text-gray-900">Second Link</a>
                <a class="mr-5 hover:text-gray-900">Third Link</a>
                <a class="mr-5 hover:text-gray-900">Fourth Link</a>
            </nav>
            <button
                class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Button
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </header>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                <h1 class="title-font font-medium text-3xl text-gray-900">Slow-carb next level shoindcgoitch ethical
                    authentic, poko scenester</h1>
                <p class="leading-relaxed mt-4">Poke slow-carb mixtape knausgaard, typewriter street art gentrify
                    hammock starladder roathse. Craies vegan tousled etsy austin.</p>
            </div>
            <form class="lg:w-2/6 md:w-1/2 md:ml-auto" action="{{route('login')}}" method="post">
                @csrf
                <input type="hidden" name="guard" value="{{ request()->input('type') ?? 'etudiant' }}">
                
                <div class="bg-gray-100 rounded-lg p-8 flex flex-col  w-full mt-10 md:mt-0">
                    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Sign In</h2>
                    @if( session('status') )
                    <div class="alert font-medium text-red-400">
                        {{ session('status') }}
                    </div>
                    @endif
                    @error('guard')
                    <div class="alert font-medium text-red-400">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="relative mb-4">
                        <label for="email" class="leading-7 text-sm text-gray-600">email</label>
                        <input type="email" id="email" name="email"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">

                            @error('email')
                            <div class="alert font-medium text-red-400">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    <div class="relative mb-4">
                        <label for="password" class="leading-7 text-sm text-gray-600">password</label>
                        <input type="password" id="password" name="password"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    
                            @error('email')
                            <div class="alert font-medium text-red-400">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    <button
                        class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Sign in</button>
                    <p class="text-xs text-gray-500 mt-3">Literally you probably haven't heard of them jean shorts.</p>
                </div>
            </form>
        </div>
    </section>



    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>