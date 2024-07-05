<?php
require(__DIR__ . '/../partials/head.view.php');
require(__DIR__ . '/../partials/nav.view.php');
require(__DIR__ . '/../partials/banner.view.php');
?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <form method="POST" action="/note/update">
                <input type="hidden" name="_method" id="_method" value="PATCH">
                <input type="hidden" name="id" id="id" value="<?= $note['id'] ?>">

                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">

                        <div class="col-span-full">
                            <label for="body"
                                   class="block text-sm font-medium leading-6 text-gray-900">Contents</label>
                            <div class="mt-2">
                                    <textarea id="body" name="body" rows="3"
                                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                              placeholder="Note to self...."><?= $note['body'] ?? ''; ?></textarea>

                                <?php if (isset($errors['body'])) : ?>
                                    <p class="text-red-600 text-xs font-bold mt-2"><?= $errors['body'] ?></p>
                                <?php endif; ?>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 flex gap-x-4 justify-end items-center">
                    <button type="button" class="text-red-500 mr-auto"
                            onclick="document.querySelector('#delete-form').submit()">Delete
                    </button>

                    <a
                            href="/notes"
                            class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Cancel
                    </a>

                    <button
                            type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Update
                    </button>
                </div>
            </form>

        </div>
    </main>

<?php require(__DIR__ . '/../partials/foot.view.php'); ?>