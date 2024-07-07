<?php
    require(__DIR__ . '/../partials/head.view.php');
    require(__DIR__ . '/../partials/nav.view.php');
    require(__DIR__ . '/../partials/banner.view.php');
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-4">
            <a href="/notes" class="text-blue-600 hover:underline">Back to Notes</a>
        </p>
        <p><?= htmlspecialchars($note['body'] ?? '') ?></p>

        <footer class="mt-6">
            <a href="/note/edit?id=<?= $note['id'] ?? 0 ?>"
               class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</a>
        </footer>
    </div>
</main>

<?php require(__DIR__ . '/../partials/foot.view.php'); ?>
