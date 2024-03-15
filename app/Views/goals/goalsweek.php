<h2>Your Goals for This Week:</h2>
<ul>
    <?php foreach ($goals as $goal) : ?>
        <li class="flex">
            <?= esc($goal['title']) ?> - <?= esc($goal['description']) ?> - <img class="h-4 w-4" src="<?= base_url() ?>/assets/icons/coin.png" alt=""> <?= esc($goal['earning']) ?>

            <button class="bg-primary-500 validate-goal" data-goal="<?= esc($goal['id_goal']) ?>">valider</button>
        </li>
    <?php endforeach; ?>
</ul>

<script>
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

                            // Désactivez le bouton
                            button.addClass('disabled');
                            button.prop('disabled', true);

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