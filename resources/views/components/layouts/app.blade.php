<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course Learing Platform</title>
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />

    @livewireStyles
    @livewireScripts
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>
    @vite('resources/css/app.css')


</head>

<body class="font-sans  bg-gray-950/95 grid grid-rows-[auto_1fr_auto] min-h-screen text-white">

    <!-- Header Section -->
    <header class="p-4 bg-gray-800 shadow-lg">
        <div class="container flex items-center justify-between mx-auto">
            <div class="flex space-x-10">
                {{-- <img src="" alt="Logo"> --}}
                <span class="text-2xl font-bold text-white">Learning Platform</span>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-white">Home</a>
                </div>
            </div>

            <div>
                <div class="flex items-center space-x-4">
                    <livewire:course-search />
                    <a href="#" class="text-white">Sign In</a>
                </div>

            </div>
        </div>
    </header>

    <!-- Main Section -->
    {{ $slot }}

    <!-- Footer Section -->
    <footer class="py-4 text-white bg-gray-800">
        <div class="container flex justify-center mx-auto">
            <p>&copy; 2023 Your Company Name. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
