<h1>Classement de mes amis</h1>
<br>

<table class="w-[20vw]">

    <tbody class="flex justify-center items-center flex-col gap-1">
        <?php
        $n = 1;
        foreach ($rankingFriend as $friend) : ?>
            <?php

            if ($friend['id_user'] == $id_user) { ?>
                <tr class="bg-primary-50 flex h-16 w-full justify-between rounded-md ring-inset ring-2 ring-primary-500 items-center">
                    <td <?php if ($n == 1) {
                            echo 'class="text-yellow-500 ml-2 ring-2 w-6 ring-inset ring-yellow-500 rounded-full h-6 flex justify-center items-center m-0 p-0 w-[10%]"';
                        }
                        if ($n == 2) {
                            echo 'class="text-zinc-500 ml-2 ring-2 w-6 ring-inset ring-zinc-500 rounded-full h-6 flex justify-center items-center m-0 p-0 w-[10%]"';
                        }
                        if ($n == 3) {
                            echo 'class="text-amber-800 ml-2 ring-2 w-6 ring-inset ring-amber-800 rounded-full h-6 h-full flex justify-center items-center m-0 p-0 w-[10%]"';
                        } else {
                            echo 'class="ml-2 w-6 rounded-full h-6 h-full flex justify-center items-center m-0 p-0 w-[10%]"';
                        } ?>>
                        <?= $n ?>
                    </td>
                    <td class="items-center flex justify-center w-[20%]">
                        <img class="inline-block h-8 !w-8 rounded-full ring-2 ring-inset ring-white object-cover" src="<?= base_url() ?>/assets/avatar/<?= $friend['avatar']; ?>" alt="">
                    </td>
                    <td class="items-center flex justify-left w-[40%]">
                        <div>
                            <p class="font-bold first-letter:uppercase"><?= $friend['pseudo'] ?></p>
                            <p class="text-gray-400">Niv. <?= $friend['level'] ?></p>
                        </div>
                    </td>
                    <td class="items-center flex justify-center w-[20%]">
                        <img class="h-4 w-4" src="<?= base_url() ?>/assets/icons/coin.png" alt="">
                        <p class="ml-2">
                            <?= $friend['points'] ?>
                        </p>
                    </td>
                </tr>
            <?php } else {
            ?>
                <tr class="bg-white flex h-16 w-full justify-between items-center rounded-md ring-2 ring-inset ring-gray-200">
                    <td <?php if ($n == 1) {
                            echo 'class="text-yellow-500 ml-2 ring-2 w-6 ring-inset ring-yellow-500 rounded-full h-6 flex justify-center items-center m-0 p-0 w-[10%]"';
                        }
                        if ($n == 2) {
                            echo 'class="text-zinc-500 ml-2 ring-2 w-6 ring-inset ring-zinc-500 rounded-full h-6 flex justify-center items-center m-0 p-0 w-[10%]"';
                        }
                        if ($n == 3) {
                            echo 'class="text-amber-800 ml-2 ring-2 w-6 ring-inset ring-amber-800 rounded-full h-6 h-full flex justify-center items-center m-0 p-0 w-[10%]"';
                        } else {
                            echo 'class="ml-2 w-6 rounded-full h-6 h-full flex justify-center items-center m-0 p-0 w-[10%]"';
                        } ?>>
                        <?= $n ?>
                    </td>
                    <td class="items-center flex justify-center w-[20%]">
                        <img class="inline-block h-8 !w-8 rounded-full ring-2 ring-white ring-inset object-cover" src="<?= base_url() ?>/assets/avatar/<?= $friend['avatar']; ?>" alt="">
                    </td>
                    <td class="items-center flex justify-left w-[40%]">
                        <div>
                            <p class="font-bold first-letter:uppercase"><?= $friend['pseudo'] ?></p>
                            <p class="text-gray-400">Niv. <?= $friend['level'] ?></p>
                        </div>
                    </td>
                    <td class="items-center flex justify-center w-[20%]">
                        <img class="h-4 w-4" src="<?= base_url() ?>/assets/icons/coin.png" alt="">
                        <p class="ml-2">
                            <?= $friend['points'] ?>
                        </p>
                    </td>
                </tr>
        <?php }
            $n += 1;
        endforeach; ?>
    </tbody>
</table>