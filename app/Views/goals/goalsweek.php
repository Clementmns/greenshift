<div class="box w-full h-[35vh] flex flex-col justify-center items-center mb-10" id="circle">
    <div class="absolute flex items-center text-gray-700">
        <p class="font-semibold text-5xl"><?php echo count($goalsRealised); ?></p>
        <p class="font-semibold text-5xl relative bottom-1">/</p>
        <p class="font-semibold text-5xl"><?php echo count($goals); ?></p>
    </div>
    <svg viewBox="0 0 100 100" class=" w-full h-full  origin-center">
        <path class="absolute rotate-[231.5deg] origin-center -z-10" id="bgArc" fill="transparent" stroke="#e5e7eB" stroke-linecap="round" stroke-width="10" d="M50 10 A40 40 0 1 1 11.002883512727053 58.90083735825259"></path>

        <path class="absolute rotate-[231.5deg] origin-center" id="progressArc" fill="transparent" stroke="#338954" stroke-linecap="round" stroke-width="10" d="M50 90 A40 40 0 0 1 30 90"></path>
    </svg>


</div>
<div id="popup" class="hidden fixed top-0 left-0 w-full h-full z-50 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-4 rounded-md w-[90%]">
        <h2 id="popupTitle" class="font-semibold text-lg mb-2"></h2>
        <div id="popupContent"></div>
    </div>
</div>
<h2 class="text-center font-bold text-xl mb-4">Vos objectifs :</h2>
<table id="goalsTable" class="flex flex-col">
    <tbody class="w-full flex flex-col justify-center items-center gap-1">
        <?php foreach ($goals as $goal) : ?>
            <tr class="bg-white flex h-auto w-full justify-between items-center ring-gray-200 box">
                <td class="flex items-center justify-center w-2/12">
                    <button class="w-6 h-6 toggle-description"><img src="<?= base_url('assets/icons/info.png') ?>" alt="Coin Icon"></button>
                </td>
                <td class="items-start flex flex-col justify-evenly w-7/12 h-full">
                    <div class="leading-none gap-1">
                        <p class="title font-semibold"><?= strlen($goal['title']) > 30 ? substr($goal['title'], 0, 30) . '...' : esc($goal['title']) ?></p>
                        <div class="description text-gray-400">
                            <p class="excerpt"><?= strlen($goal['description']) > 30 ? substr($goal['description'], 0, 30) . '...' : esc($goal['description']) ?></p>
                            <p class="hidden full-description"><?= esc($goal['description']) ?></p>
                        </div>
                        <div class="flex items-center">
                            <img class="h-4 w-4" src="<?= base_url('assets/icons/shifter.svg') ?>" alt="Coin Icon">
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
<script>
    var progressComplete = false; // Variable pour suivre si le progrès est complet

    updateProgressArc(); // Appeler la fonction pour mettre à jour l'arc de cercle lors du chargement de la page

    // Fonction pour mettre à jour l'arc de cercle
    function updateProgressArc() {
        if (!progressComplete) { // Vérifier si le progrès n'est pas complet
            var goalsTotal = 2 + <?php echo count($goals); ?>; // Nombre total de goals
            var goalsRealised = <?php echo count($goalsRealised); ?>; // Nombre de goals réalisés
            var progress = (goalsRealised / goalsTotal) * 360; // Calculer l'angle de progression

            var path = document.getElementById('progressArc'); // Obtenir l'élément SVG pour l'arc de cercle
            var angle = Math.PI * (progress / 180); // Convertir l'angle en radians
            var x = 50 + Math.sin(angle) * 40; // Calculer la position x du point final de l'arc
            var y = 50 - Math.cos(angle) * 40; // Calculer la position y du point final de l'arc
            var largeArcFlag = progress > 180 ? 1 : 0; // Définir le drapeau pour spécifier si l'arc est de plus de 180 degrés
            var sweepFlag = 1; // Indiquer que l'arc doit être dessiné dans le sens des aiguilles d'une montre
            var d = "M50 10 A40 40 0 " + largeArcFlag + " " + sweepFlag + " " + x + " " + y; // Définir la chaîne de commande pour l'attribut 'd' du chemin SVG
            path.setAttribute('d', d); // Mettre à jour l'attribut 'd' du chemin SVG avec la nouvelle valeur

        }
    }

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

    $('#closePopup').click(function() {
        $('#popup').addClass('hidden');
    });

    $('#popup').click(function(event) {
        if (event.target === this) {
            $(this).addClass('hidden');
        }
    });


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
                    console.log(response)
                    if (response.success) {
                        location.reload();
                        updateProgressArc(); // Mettre à jour l'arc de cercle après la validation d'un goal
                        $.ajax({
                            type: 'post',
                            url: '',
                            data: {
                                goal_id: goalId
                            },
                            success: function(response) {
                                // Mettre à jour les points de l'utilisateur si nécessaire
                            }
                        });
                    }
                }
            });
        }
    });
</script>