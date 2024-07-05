<?php
    require(__DIR__ . '/../partials/head.view.php');
    require(__DIR__ . '/../partials/nav.view.php');
    require(__DIR__ . '/../partials/banner.view.php');
    $disabled = $_ENV['APP_ENV'] === 'production';
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <ul>
            <?php if (! empty($notes)) : ?>
                <?php foreach ($notes as $note) : ?>
                    <li>
                        <a href="/note?id=<?= $note['id'] ?>" class="text-blue-600 hover:underline">
                            <?= htmlspecialchars($note['body']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
        </ul>
            <?php else : ?>
            <p>You do not have any notes to display</p>
            <?php endif; ?>
        <?php if (! $disabled) : ?>
            <p class="mt-6">
                <a href="/note/create" class="text-blue-600 hover:underline">Create Note</a>
            </p>
        <?php endif; ?>
    </div>
</main>

<?php require(__DIR__ . '/../partials/foot.view.php'); ?>
