<table>
    <tbody class="flex justify-center items-center flex-col gap-1">
        <?php
        foreach ($people as $friend) { ?>

            <tr class="bg-white flex h-16 w-full justify-between items-center rounded-md ring-2 ring-inset ring-gray-200 gap-4">
                <td class="items-center flex justify-center w-12">
                    <img class="inline-block h-8 !w-8 rounded-full ring-2 ring-white ring-inset object-cover" src="<?= base_url() ?>assets/avatar/<?= $friend['avatar']; ?>" alt="">
                </td>
                <td class="items-center flex justify-left w-24">
                    <div>
                        <p class="font-bold first-letter:uppercase"><?= $friend['pseudo'] ?></p>
                        <p class="text-gray-400">Niv. <?= $friend['level'] ?></p>
                    </div>
                </td>
            </tr>
        <?php
        }; ?>
    </tbody>
</table>