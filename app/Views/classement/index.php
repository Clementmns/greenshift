<table>

    <tbody class=" flex justify-center items-center flex-col gap-1">
        <?php
        $n = 1;
        foreach ($rankingFriend as $friend) : ?>
            <?php

            if ($friend['id_user'] == $userInfo['id_user']) { ?>
                <tr class="bg-primary-50 flex h-16 w-full justify-between rounded-md ring-inset ring-2 ring-primary-500 items-center gap-4">
                    <td <?php if ($n == 1) {
                            echo 'class="text-yellow-500 ml-2 ring-2 min-w-8 w-8 ring-inset ring-yellow-500 rounded-full min-h-8 h-8 flex justify-center items-center m-0 p-0 w-[10%]"';
                        }
                        if ($n == 2) {
                            echo 'class="text-zinc-500 ml-2 ring-2 min-w-8 w-8 ring-inset ring-zinc-500 rounded-full min-h-8 h-8 flex justify-center items-center m-0 p-0 w-[10%]"';
                        }
                        if ($n == 3) {
                            echo 'class="text-amber-800 ml-2 ring-2 min-w-8 w-8 ring-inset ring-amber-800 rounded-full min-h-8 h-8 flex justify-center items-center m-0 p-0 w-[10%]"';
                        } else {
                            echo 'class="ml-2 min-w-8 w-8 rounded-full min-h-8 h-8 h-full flex justify-center items-center m-0 p-0 w-[10%]"';
                        } ?>>
                        <?= $n ?>
                    </td>
                    <td class="items-center flex justify-center w-12">
                        <img class="inline-block h-8 !w-8 rounded-full ring-2 ring-inset ring-white object-cover" src="<?= base_url() ?>assets/avatar/<?= $friend['avatar']; ?>" alt="">
                    </td>
                    <td class=" flex items-start w-24 flex-col">
                        <p class="font-bold first-letter:uppercase"><?= $friend['pseudo'] ?></p>
                        <div class="flex items-center">
                            <img class="h-4 w-4" src="<?= base_url() ?>/assets/icons/coin.png" alt="">
                            <p class="ml-2">
                                <?= $friend['points'] ?>
                            </p>
                        </div>

                    </td>
                    <td class="items-center flex justify-center w-24">
                        <p class="text-gray-400">Niv. <?= $friend['level'] ?></p>
                    </td>
                </tr>
            <?php } else {
            ?>
                <tr class="bg-white flex h-16 w-full justify-between items-center rounded-md ring-2 ring-inset ring-gray-200 gap-4">
                    <td <?php if ($n == 1) {
                            echo 'class="text-yellow-500 ml-2 ring-2 min-w-8 w-8 ring-inset ring-yellow-500 rounded-full min-h-8 h-8 flex justify-center items-center m-0 p-0 w-[10%]"';
                        }
                        if ($n == 2) {
                            echo 'class="text-zinc-500 ml-2 ring-2 min-w-8 w-8 ring-inset ring-zinc-500 rounded-full min-h-8 h-8 flex justify-center items-center m-0 p-0 w-[10%]"';
                        }
                        if ($n == 3) {
                            echo 'class="text-amber-800 ml-2 ring-2 min-w-8 w-8 ring-inset ring-amber-800 rounded-full min-h-8 h-8 flex justify-center items-center m-0 p-0 w-[10%]"';
                        } else {
                            echo 'class="ml-2 min-w-8 w-8 rounded-full min-h-8 h-8 h-full flex justify-center items-center m-0 p-0 w-[10%]"';
                        } ?>>
                        <?= $n ?>
                    </td>
                    <td class="items-center flex justify-center w-12">
                        <img class="inline-block h-8 !w-8 rounded-full ring-2 ring-white ring-inset object-cover" src="<?= base_url() ?>assets/avatar/<?= $friend['avatar']; ?>" alt="">
                    </td>
                    <td class=" flex items-start w-24 flex-col">
                        <p class="font-bold first-letter:uppercase"><?= $friend['pseudo'] ?></p>
                        <div class="flex items-center">
                            <img class="h-4 w-4" src="<?= base_url() ?>/assets/icons/coin.png" alt="">
                            <p class="ml-2">
                                <?= $friend['points'] ?>
                            </p>
                        </div>

                    </td>
                    <td class="items-center flex justify-center w-24">
                        <p class="text-gray-400">Niv. <?= $friend['level'] ?></p>
                    </td>
                </tr>
        <?php }
            $n += 1;
        endforeach; ?>
    </tbody>
</table>