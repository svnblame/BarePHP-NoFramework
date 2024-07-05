<?php
require(view_path('partials/head.view.php'));
require(view_path('partials/nav.view.php'));
require(view_path('partials/banner.view.php'));
?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <p class="text-2xl font-bold">You are not authorized to view the requested resource</p>
            <p class="mt-4">
                <a href="/" class="text-blue-600 hover:underline">Home Page</a>
            </p>
        </div>
    </main>

<?php require(view_path('partials/foot.view.php')); ?>