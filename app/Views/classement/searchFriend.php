<table>
    <tbody class="flex justify-center items-center flex-col gap-1">
        <?php foreach ($people as $friend) : ?>
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
                <td>
                    <!-- Bouton avec un attribut data pour stocker l'id_user -->
                    <button class="text-primary-500 font-bold addBtn" data-userid="<?= $friend['id_user'] ?>">Ajouter</button>
                    <div id="id"></div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // Attendez que le document soit prêt
    $(document).ready(function() {
        // Ajoutez un écouteur d'événements clic à chaque bouton avec la classe addBtn
        $('.addBtn').click(function() {
            // Récupérer l'id_user à partir de l'attribut data
            const userId = $(this).data('userid');

            $.ajax({
                type: 'get',
                url: '<?php echo base_url('dashboard/addFriend'); ?>',
                data: {
                    id_friend: userId
                },
                success: function(response) {
                    console.log(response)
                    if (response.success) {
                        alert('Friend added successfully.');

                        // Désactivez le bouton
                        $(this).unwrap();

                    } else {
                        alert('Failed to validate goal.');
                    }
                }
            });
        });
    });
</script>