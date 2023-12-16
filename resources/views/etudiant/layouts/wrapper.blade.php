<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: "rubik";
        }

        #app {
            grid-template-areas: "nav"
                "content";
            grid-template-rows: auto 1fr;
        }

        #content {
            grid-template-areas: "main"
                "footer";

            grid-template-rows: 1fr auto;
        }

        .main-content {
            grid-area: main;
        }

        .loader {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .3);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 9px solid #474bff;
            animation: spinner-bulqg1 0.8s infinite linear alternate,
            spinner-oaa3wk 1.6s infinite linear;
        }

        @keyframes spinner-bulqg1 {
            0% {
                clip-path: polygon(50% 50%, 0 0, 50% 0%, 50% 0%, 50% 0%, 50% 0%, 50% 0%);
            }

            12.5% {
                clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 0%, 100% 0%, 100% 0%);
            }

            25% {
                clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 100%, 100% 100%, 100% 100%);
            }

            50% {
                clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 100%, 50% 100%, 0% 100%);
            }

            62.5% {
                clip-path: polygon(50% 50%, 100% 0, 100% 0%, 100% 0%, 100% 100%, 50% 100%, 0% 100%);
            }

            75% {
                clip-path: polygon(50% 50%, 100% 100%, 100% 100%, 100% 100%, 100% 100%, 50% 100%, 0% 100%);
            }

            100% {
                clip-path: polygon(50% 50%, 50% 100%, 50% 100%, 50% 100%, 50% 100%, 50% 100%, 0% 100%);
            }
        }

        @keyframes spinner-oaa3wk {
            0% {
                transform: scaleY(1) rotate(0deg);
            }

            49.99% {
                transform: scaleY(1) rotate(135deg);
            }

            50% {
                transform: scaleY(-1) rotate(0deg);
            }

            100% {
                transform: scaleY(-1) rotate(-135deg);
            }
        }
    </style>
    <title>dashboard</title>
</head>

<body style="overflow-y:hidden" class="w-screen overflow-x-hidden h-screen min-h-screen relative">

<div class="loader">
    <div class="spinner" style="scale: 4;"></div>
</div>
<script>
    window.onload = function() {
        document.querySelector('.loader').remove();
        document.querySelector('body').style.overflowY = "auto"
    }
</script>

<div id="app" class="relative w-full grid overflow-hidden bg-[#f5f5f5]" x-data="{ tabOpened: false, tab: null }"
     :class="{
            'h-screen': tabOpened,
            'min-h-screen': !tabOpened
        }">
    <nav
        class="w-full h-14 bg-[#f5f5f5] border-b border-slate-500 flex justify-between px-4 relative
                    sm:px-4
                    lg:px-10
                    xl:px-20">
        <div class="toggler h-full flex py-2" style="z-index: 500;">
            <i class="bi bi-list mx-2 text-2xl flex justifi-center items-center px-2
                 border border-slate-500 rounded-md cursor-pointer hover:bg-gray-200 duration-300 ease"
               @click="tabOpened = true, tab = $el.dataset.trigger" data-trigger="tools"></i>
            <div class="brand h-full">
                <img class="h-full" src="./assets/media/guelma-logo.png" alt="">
            </div>
        </div>


        <div class="float-right py-1 h-full">
            <div class="px-2 h-full flex items-center">



                <div class="add h-full py-2 mx-10  relative" x-data="{ open: false }">
                    <div class="toggler drop-shadow-md h-full  flex items-center px-2
                        text-slate-800 cursor-pointer hover:bg-green-300 duration-300 font-medium rounded-md border border-slate-500 text-xl"
                         @click="open = !open">
                        <i class="bi bi-plus text-2xl mr-2 "></i>
                        <i class="bi bi-caret-down text-xs duration-300" :class="{ 'rotate-180': open }"></i>
                    </div>
                    <div style="z-index: 500;" @click.outside="open=false"
                         class="menu absolute -right-4 bg-gray-100 rounded-md border top-full whitespace-nowrap
                         py-2"
                         x-show="open" x-duration.300ms>
                        <ul class="px-2 w-full" x-data="{
                                list: [{
                                        icon: 'bi bi-card-checklist',
                                        link: '{{route('etudiant.chose')}}',
                                        title: 'chose specialities',
                                    }
                                ]
                            }">
                            <template x-for="li in list">
                                <li class="w-full">
                                    <a :href="li.link"
                                       class="flex w-full px-2 py-1 rounded-md hover:bg-gray-200">
                                        <i :class="li.icon" class="mr-2"></i>
                                        <span x-text="li.title"></span>
                                    </a>
                                </li>
                            </template>

                        </ul>
                    </div>
                </div>

                <div data-trigger="personal" @click="tabOpened = true, tab = $el.dataset.trigger"
                     class="tab-toggler h-full ">
                    <div
                        class="img-container border border-sky-500 h-full w-12 rounded-xl overflow-hidden cursor-pointer
                            drop-shadow-lg ">
                        <img class="h-full w-full" src="{{ Auth::user()->profile_photo_url }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="content mt-2 grid relative" style="z-index: 1;" id="content">
        <div
            class="main-content flex justify-center">


            <!-- main banner in all screens -->
            <div class="px-2 w-full mx-auto  ">
                {{ $slot }}
            </div>

            <!-- right banner in just large screens -->


        </div>


        <footer class="text-gray-600 body-font">
            <div
                class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
                <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
                    <a
                        class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                        <img src="./assets/media/guelma-logo.png" alt="">
                    </a>
                    <p class="mt-2 text-sm text-gray-500">projet de system aid descision 2023 univ guelma 1945</p>
                </div>
                <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES
                        </h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES
                        </h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES
                        </h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES
                        </h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100">
                <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                    <p class="text-gray-500 text-sm text-center sm:text-left">© chaima brahmia - amira djebala —
                        <a href="https://twitter.com/knyttneve" rel="noopener noreferrer"
                           class="text-gray-600 ml-1" target="_blank">@isil 2023</a>
                    </p>
                    <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                            <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a class="ml-3 text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path
                                        d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                    </path>
                                </svg>
                            </a>
                            <a class="ml-3 text-gray-500">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                     stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5">
                                    </rect>
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                </svg>
                            </a>
                            <a class="ml-3 text-gray-500">
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                     stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path stroke="none"
                                          d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                                    </path>
                                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                                </svg>
                            </a>
                        </span>
                </div>
            </div>
        </footer>

    </div>


    <div class="tabs absolute left-0 top-0 w-full h-full" x-show="tabOpened" x-duration.300ms>
        <div class="absolute w-full h-full bg-black opacity-20" style="z-index: 600;"></div>
        <div class="left-tab h-full duration-500 ease-in-out overflow-hidden bg-white absolute left-0"
             style="z-index: 650;"
             :class="{
                    'w-72': tab == $el.dataset.tab,
                    'w-0 hidden': !tabOpened || $el.dataset.tab != tab
                }"
             data-tab="tools" @click.outside="tab == $el.dataset.tab? (tab = null, tabOpened = false) : ''"
             x-duration.300ms>

            <div class="left-tab-header h-14 px-2">
                <div class="toggler h-full flex justify-between py-2">
                    <div class="brand h-full">
                        <img class="h-full" src="./assets/media/guelma-logo.png" alt="">
                    </div>
                    <i class="bi bi-x mx-2 text-2xl flex justify-center items-center w-8 h-8
                      rounded-md cursor-pointer bg-gray-200 text-red-400 hover:bg-red-400 hover:text-white duration-300 ease"
                       @click="tabOpened = false, tab = null"></i>
                </div>

            </div>
            <div class="hr h-[1px] w-full bg-gray-300"></div>
            <ul class="w-full px-4 mt-4 capitalize font-light tracking-wide" x-data="{
                    list: [{
                            icon: 'bi bi-house-door',
                            link: '{{route('etudiant.home')}}',
                            title: 'home'
                        },
                        {
                            icon: 'bi bi-card-checklist',
                            link: '{{route('etudiant.chose')}}',
                            title: 'chose speciality'
                        },
                        {
                            icon: 'bi bi-signpost-split',
                            link: '{{route('etudiant.result')}}',
                            title: 'result and choices'
                        }
                    ]
                }">

                <template x-for="li in list">
                    <li class="w-full">
                        <a :href="li.link"
                           class="block w-full py-2 px-2
                             hover:bg-gray-200 rounded-md ">
                            <i :class="li.icon" class="mr-1"></i>
                            <span x-text="li.title"></span>
                        </a>
                    </li>
                </template>

            </ul>

            <div class="orienter-btn block sm:hidden text-center my-10">
                <form action="{{route('admin.orientation')}}" method="post">
                    @csrf
                    <button class="p-2 bg-sky-500 hover:bg-sky-600 text-white rounded-md">
                        orient students
                    </button>
                </form>

            </div>


        </div>
        <div class="right-tab px-2 h-full duration-500 ease-in-out overflow-hidden bg-white absolute right-0"
             style="z-index: 650;"
             :class="{
                    'w-72': tab == $el.dataset.tab,
                    'w-0 hidden': !tabOpened || $el.dataset.tab != tab
                }"
             data-tab="personal" @click.outside="tab == $el.dataset.tab? (tab = null, tabOpened = false) : ''"
             x-duration.300ms>

            <div class="right-tab-header h-14 px-1 flex justify-between items-center py-1">
                <div class="info flex">
                    <div
                        class="img-container border border-sky-500 h-full w-12 rounded-xl overflow-hidden cursor-pointer
                                drop-shadow-lg ">
                        <img class="h-full w-full" src="{{ Auth::user()->profile_photo_url }}" alt="">
                    </div>
                    <div
                        class="ml-2 flex items-center font-normal capitalize tracking-wider text-md text-slate-400">
                        {{auth()->user()->name}}
                    </div>
                </div>
                <i class="bi bi-x mx-2 text-2xl flex justify-center items-center w-8 h-8
                      rounded-md cursor-pointer bg-gray-200 text-red-400 hover:bg-red-400 hover:text-white duration-300 ease"
                   @click="tabOpened = false, tab = null"></i>
            </div>

            <div class="hr h-[1px] w-full bg-gray-300"></div>
            <ul class="w-full px-4 mt-4 capitalize font-light tracking-wide" x-data="{
                    list: [{
                            icon: 'bi bi-gear',
                            link: '/user/profile',
                            title: 'seettings',
                            pushClass: ''
                        }
                    ]
                }">

                <template x-for="li in list">
                    <li class="w-full">
                        <a :href="li.link"
                           class="block w-full py-2 px-2
                         hover:bg-gray-200 rounded-md"
                           :class="li.pushClass">
                            <i :class="li.icon" class="mr-1"></i>
                            <span x-text="li.title"></span>
                        </a>
                    </li>
                </template>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="block w-full py-2 px-2
                          rounded-md bg-red-300 my-2 font-medium hover:bg-red-400 text-white">
                        <i class="bi bi-box-arrow-left mr-1"></i>
                        log out
                    </button>
                </form>

            </ul>

        </div>


    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>



