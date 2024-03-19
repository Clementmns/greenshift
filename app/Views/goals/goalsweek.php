<h2>Your Goals for This Week:</h2>
<table id="goalsTable">
    <?php foreach ($goals as $goal) : ?>
        <tr class="bg-white flex h-auto w-[40vw] justify-between items-center rounded-md ring-2 ring-inset ring-gray-200 gap-4 p-3">
            <td class="items-center flex justify-start w-4/6">
                <div>
                    <p><?= strlen($goal['title']) > 30 ? substr($goal['title'], 0, 30) . '...' : esc($goal['title']) ?></p>
                    <div class="description text-gray-400">
                        <p><?= strlen($goal['description']) > 30 ? substr($goal['description'], 0, 30) . '...' : esc($goal['description']) ?></p>
                        <?php if (strlen($goal['description']) > 30) : ?>
                            <p class="hidden full-description"><?= esc($goal['description']) ?></p>
                            <button class="text-blue-500 hover:underline toggle-description">Lire plus</button>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
            <td class="items-center flex justify-center w-1/6">
                <div class="flex items-center">
                    <img class="h-4 w-4" src="<?= base_url('assets/icons/coin.png') ?>" alt="Coin Icon">
                    <p class="ml-2"><?= esc($goal['earning']) ?></p>
                </div>
            </td>
            <td class="flex items-center w-1/6">
                <?php if (empty($goalsRealised) || !in_array($goal['id_goal'], array_column($goalsRealised, 'fk_goal'))) : ?>
                    <button class="bg-primary-500 text-white px-2 py-1 rounded validate-goal" data-goal="<?= esc($goal['id_goal']) ?>">Valider</button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    document.querySelectorAll('.toggle-description').forEach(button => {
        button.addEventListener('click', function() {
            const description = this.closest('.description').querySelector('.full-description');
            description.classList.toggle('hidden');
            if (description.classList.contains('hidden')) {
                this.textContent = 'Lire plus';
            } else {
                this.textContent = 'Lire moins';
            }
        });
    });




































    $(document).ready(function() {
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
                            alert('Goal validated successfully.');

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
                        } else {
                            alert('Failed to validate goal.');
                        }
                    }
                });
            }
        });
    });
</script>