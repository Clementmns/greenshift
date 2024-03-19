<h2>Your Goals for This Week:</h2>
<table id="goalsTable">
    <tbody class="flex flex-col justify-center items-center gap-1">
        <?php foreach ($goals as $goal) : ?>

            <tr class="bg-white flex h-auto w-[40vw] justify-between items-center rounded-md ring-2 ring-inset ring-gray-200 gap-4 p-3">
                <td class="items-center flex justify-start w-4/6">
                    <div>
                        <p><?= strlen($goal['title']) > 30 ? substr($goal['title'], 0, 30) . '...' : esc($goal['title']) ?></p>

                        <div class="description text-gray-400">
                            <p class="excerpt"><?= strlen($goal['description']) > 30 ? substr($goal['description'], 0, 30) . '...' : esc($goal['description']) ?></p>
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
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('.validate-goal').click(function() {
            var button = $(this);
            if (!button.hasClass('disabled')) {
                var goalId = button.data('goal');
                $.ajax({
                    type: 'get',
                    url: '<?php echo base_url('dashboard/validateGoal'); ?>',
                    data: {
                        goal_id: goalId
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>