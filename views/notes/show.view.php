<?php
    require(__DIR__ . '/../partials/head.php');
    require(__DIR__ . '/../partials/nav.php');
    require(__DIR__ . '/../partials/banner.php');
    $disabled = $_ENV['APP_ENV'] === 'production';
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-4">
            <a href="/notes" class="text-blue-600 hover:underline">Back to Notes</a>
        </p>
        <p><?= htmlspecialchars($note['body']) ?></p>

        <?php if (! $disabled) : ?>
            <form class="mt-6" method="POST">
                <input type="hidden" name="_method" id="_method" value="DELETE">
                <input type="hidden" value="<?= $note['id'] ?>" name="id" id="id">
                <button class="text-sm text-red-500">Delete</button>
            </form>
        <?php endif; ?>
    </div>
</main>

<?php require(__DIR__ . '/../partials/foot.php'); ?>
