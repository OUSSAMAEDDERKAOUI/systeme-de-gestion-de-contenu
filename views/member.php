<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
</head>
<body class="overflow-y-scroll">

    <!-- Header (assuming a static header) -->
    <header class="bg-gray-800 text-white p-4">
        <h1 class="text-lg">Profile Header</h1>
    </header>

    <h1 class="sr-only">Profile</h1>
    <div class="max-w-7xl mx-auto px-3 py-10 grid gap-4 grid-cols-[35%_1fr] items-start">
        <div class="border border-gray-200 rounded-lg px-3 py-7 text-center">
            <div>
                <div class="w-16 h-16 rounded-full border-2 border-green-500 bg-gray-300 mx-auto mb-5">
                    <img src="/assets/imgs/users/default.webp" class="w-full rounded-full" alt="User Image">
                </div>
                <h2 class="text-green-500 font-semibold mb-1 text-xl">First Last Name</h2>
                <span class="text-gray-500 text-sm">Joined On: January 1, 2023</span>
                <span class="h-[1px] w-3/6 bg-gray-200 mx-auto block my-5"></span>
            </div>
            <div>
                <h3 class="font-semibold text-lg mb-2">Statistics</h3>
                <ul>
                    <li class="mb-1">10 Posts</li>
                    <li class="mb-1">5 Comments</li>
                    <li class="mb-1">20 Reactions</li>
                </ul>
            </div>
        </div>
        <div id="option-blocks">
            <div class="border border-gray-200 rounded-lg flex-1 py-8 px-8" id="published-posts">
                <h2 class="text-3xl text-green-500 font-semibold mb-8 text-center">Published Posts</h2>

                <div class="mb-6">
                    <h3 class="font-semibold text-blue-500 text-lg">
                        <a href="/view.php?id=1">Sample Post Title 1</a>
                    </h3>
                    <span class="text-gray-400 text-md">January 1, 2023</span>
                    <p class="mt-2">This is a brief content of the post.</p>
                </div>
                <div class="mb-6">
                    <h3 class="font-semibold text-blue-500 text-lg">
                        <a href="/view.php?id=2">Sample Post Title 2</a>
                    </h3>
                    <span class="text-gray-400 text-md">January 2, 2023</span>
                    <p class="mt-2">This is a brief content of the post.</p>
                </div>
                <p class="text-center font-semibold text-md text-gray-600">This user has not published any posts yet.</p>

            </div>
        </div>
    </div>

</body>
</html>