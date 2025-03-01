<?php
    require('partials/head.view.php');
    require('partials/nav.view.php');
    require('partials/banner.view.php');
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello, <?= $_SESSION['user']['first_name'] ?? 'Guest' ?>. Welcome to the home page.</p>

        <?php if (isset($errors['email'])) : ?>
            <p class="text-red-600 text-xs font-bold mt-2"><?= $errors['email'] ?></p>
        <?php endif; ?>
    </div>
</main>

<?php require('partials/foot.view.php'); ?>
