<!-- Ajoutez ce code à votre HTML -->
<!-- Ajoutez ce code à votre HTML -->
<div id="popup" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-4 rounded-md w-full">
        <h2 id="popupTitle" class="font-semibold text-lg mb-2"></h2>
        <div id="popupContent"></div>
    </div>
</div>

<table id="goalsTable" class="flex flex-col">
    <tbody class="w-full flex flex-col justify-center items-center gap-1">
        <?php foreach ($goals as $goal) : ?>
            <tr class="bg-white flex h-auto w-full justify-between items-center ring-gray-200 box">
                <td class="flex items-center justify-center w-2/12">
                    <button class="w-6 h-6 toggle-description"><img src="<?= base_url('assets/icons/info.png') ?>" alt="Coin Icon"></button>
                </td>
                <td class="items-start flex flex-col justify-evenly w-7/12 h-full">
                    <div class="leading-none gap-1">
                        <!-- Ajout de la classe "title" -->
                        <p class="title font-semibold"><?= strlen($goal['title']) > 30 ? substr($goal['title'], 0, 30) . '...' : esc($goal['title']) ?></p>
                        <!-- Ajout de la classe "description" -->
                        <div class="description text-gray-400">
                            <p class="excerpt"><?= strlen($goal['description']) > 30 ? substr($goal['description'], 0, 30) . '...' : esc($goal['description']) ?></p>

                            <p class="hidden full-description"><?= esc($goal['description']) ?></p>

                        </div>
                        <div class="flex items-center">
                            <img class="h-4 w-4" src="<?= base_url('assets/icons/coin.png') ?>" alt="Coin Icon">
                            <p class="ml-2"><?= esc($goal['earning']) ?></p>
                        </div>
                    </div>
                </td>
                <td class="flex items-center justify-center w-3/12">
                    <?php if (empty($goalsRealised) || !in_array($goal['id_goal'], array_column($goalsRealised, 'fk_goal'))) : ?>
                        <button class="bg-primary-500 text-white py-1 px-2 rounded validate-goal" data-goal="<?= esc($goal['id_goal']) ?>">Valider</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Assurez-vous d'inclure jQuery avant ce script -->
<script>
    document.querySelectorAll('.toggle-description').forEach(button => {
        button.addEventListener('click', function() {
            // Trouver l'élément description et titre dans la même ligne que le bouton cliqué
            const description = this.closest('tr').querySelector('.description .full-description');
            const title = this.closest('tr').querySelector('.title');
            const popupContent = document.getElementById('popupContent');
            const popupTitle = document.getElementById('popupTitle');

            // Mettre le contenu de full-description et titre dans le popupContent et popupTitle
            if (description && title) {
                popupContent.innerHTML = description.innerHTML;
                popupTitle.innerText = title.innerText;

                // Afficher le popup
                document.getElementById('popup').classList.remove('hidden');
            } else {
                console.error('Description ou titre non trouvés');
            }
        });
    });

    $(document).ready(function() {
        $('#closePopup').click(function() {
            $('#popup').addClass('hidden');
        });

        $('#popup').click(function(event) {
            if (event.target === this) {
                $(this).addClass('hidden');
            }
        });

        $('.validate-goal').click(function() {
            var button = $(this); // Stockez une référence au bouton

            // Vérifiez si le bouton est déjà désactivé
            if (!button.hasClass('disabled')) {
                var goalId = button.data('goal');
                $.ajax({
                    type: 'get',
                    url: '<?php echo base_url('dashboard/validateGoal'); ?>',
                    data: {
                        goal_id: goalId
                    },
                    success: function(response) {
                        console.log(response)
                        // Si l'insertion réussit, affichez un message de succès ou effectuez toute autre action nécessaire
                        if (response.success) {

                            location.reload();

                            // Désactivez le bouton

                            // Mettre à jour les points de l'utilisateur
                            $.ajax({
                                type: 'post',
                                url: '',
                                data: {
                                    goal_id: goalId
                                },
                                success: function(response) {

                                }
                            });
                        }
                    }
                });
            }
        });
    });
</script>