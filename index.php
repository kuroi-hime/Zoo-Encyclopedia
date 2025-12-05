<!DOCTYPE html>
<?php
    include 'php/connexion.php';
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zoo Encyclopédie</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gradient-to-br from-yellow-200 to-pink-200 min-h-screen p-4 font-sans">
        <!-- header -->
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-600 mb-2 animate-bounce">🦁 Zoo Magique !</h1>
            <nav class="flex justify-center space-x-4">
                <!-- <button id="toHome" class="bg-green-400 text-white px-6 py-3 rounded-full text-xl shadow-lg hover:scale-110 transition-all">Accueil</button> -->
                <button id="toAnimals" class="bg-purple-400 text-white px-6 py-3 rounded-full text-xl shadow-lg hover:scale-110 transition-all">Animaux</button>
                <button id="toHabitats" class="bg-pink-400 text-white px-6 py-3 rounded-full text-xl shadow-lg hover:scale-110 transition-all">Habitats</button>
                <button id="toStatistics" class="bg-red-400 text-white px-6 py-3 rounded-full text-xl shadow-lg hover:scale-110 transition-all">Statistiques</button>
                <button id="addAnimal" class="bg-yellow-400 text-white px-6 py-3 rounded-full text-xl shadow-lg hover:scale-110 transition-all">+ animal</button>
                <button id="addHabitat" class="bg-blue-400 text-white px-6 py-3 rounded-full text-xl shadow-lg hover:scale-110 transition-all">+ habitat</button>
                <!-- <button id="toGame" class="bg-orange-400 text-white px-6 py-3 rounded-full text-xl shadow-lg hover:scale-110 transition-all">Jeux</button> -->
            </nav>
        </header>
        <main id="content">
            <!-- Section Accueil -->
            <!-- <section id="home" class="grid place-items-center min-h-[60vh]">
                <div class="text-center">
                    <img src="https://plus.unsplash.com/premium_photo-1661810398337-1fddd20130c3?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Z2lyYWZvbnxlbnwwfHwwfHx8MA%3D%3Dtext=🦒+Girafon" alt="Girafon" class="w-64 h-64 mx-auto rounded-3xl shadow-2xl mb-4">
                    <h2 class="text-3xl font-bold text-red-500 mb-2">Bienvenue au Zoo !</h2>
                    <p class="text-xl text-gray-700 mb-6">Découvre les animaux rigolos ! Appuie sur un bouton pour commencer.</p>
                </div>
            </section> -->
            <!-- Section Animaux -->
            <section id="animaux" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class='col-span-full flex gap-4 p-4 rounded-3xl bg-white'>
                    <h2 class='text-xl font-medium text-orange-500'>Filtres: </h2>
                    <select id="filtreRegime">
                        <option value="" selected>tous les régimes</option>
                        <option value="Carnivore">Carnivore</option>
                        <option value="Herbivore">Herbivore</option>
                        <option value="Omnivore">Omnivore</option>
                    </select>
                    <select id="filtreHabitat">
                        <option value="" selected>tous les habitats</option>
                        <?php
                            $sql = "select IdHab, NomHab from Habitats";
                            $resultats = $connexion->query($sql);
                            foreach($resultats as $resultat){
                                $idHab = $resultat['IdHab'];
                                $nomHab = $resultat['NomHab'];
                                echo "<option value='$idHab'>$nomHab</option>";
                            }
                        ?>
                    </select>
                </div>
                <?php
                    $sql = "select a.ID, a.Nom, a.Type_alimentaire, a.Image, a.IdHab, h.NomHab, h.Description_Hab
                    from animaux a
                    left join habitats h ON a.IdHab = h.IdHab";
                    $resultats = $connexion->query($sql);
                    foreach($resultats as $resultat){
                        $id = $resultat['ID'];
                        $image = $resultat['Image'];
                        $nom = $resultat['Nom'];
                        $regime = $resultat['Type_alimentaire'];
                        $idHab = $resultat['IdHab']??0;
                        $nomHab = $resultat['NomHab']??'-';
                        $description = $resultat['Description_Hab']??'Aucune description.';
                        echo "<div name='habitat_$idHab'
                                class='animal bg-white/80 backdrop-blur-sm rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all hover:scale-105 text-center'
                            >
                            <img src=$image alt=$nom class='w-full h-48 object-cover rounded-2xl mb-4 mx-auto'>
                            <h3 class='text-2xl font-bold text-orange-500 mb-2'>$nom</h3>
                            <p class='text-lg text-gray-600 mb-4'>Régime alimentaire: $regime</p>
                            <button onclick=\"showAnimalDetails($id, '$image', '$nom', '$regime', $idHab, '$nomHab', '$description')\" class='bg-blue-400 text-white px-8 py-3 rounded-full text-xl font-bold shadow-lg hover:bg-blue-300 transition-all w-full'>Découvrir</button>
                        </div>";
                    }
                ?>
            </section>
            <!-- Modale Détails Animal -->
            <div id="animalModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                <div class="bg-white/95 rounded-3xl p-2 max-w-md w-full shadow-2xl animate-in fade-in zoom-in duration-200">
                    <button onclick="closeModal()" class="absolute top-4 right-4 text-3xl text-gray-500 hover:text-red-500">&times;</button>
                    <div class="overflow-y-auto max-h-[90vh]">
                        <form action="php/updateAnimal.php" method="post" id="modalContent" class="overflow-hidden">
                            <!-- Contenu dynamique ici -->
                        </form>
                        <div class="flex gap-4 mt-6">
                            <!-- Sound Effect by <a href="https://pixabay.com/users/pwlpl-16464651/?utm_source=link-attribution&utm_medium=referral&utm_campaign=music&utm_content=444190">Paul ( PWLPL)</a> from <a href="https://pixabay.com/sound-effects//?utm_source=link-attribution&utm_medium=referral&utm_campaign=music&utm_content=444190">Pixabay</a> -->
                            <!-- <button onclick="playSound()" class="flex-1 bg-green-400 text-white py-3 px-6 rounded-xl text-xl font-bold shadow-lg hover:bg-green-300 transition-all">🎵 Écouter</button> -->
                            <button onclick="closeModal()" class="flex-1 bg-gray-400 text-white py-3 px-6 rounded-xl text-xl font-bold shadow-lg hover:bg-gray-300 transition-all">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section Habitats -->
            <section id="habitats" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                    $sql = "select * from habitats";
                    $resultats = $connexion->query($sql);
                    foreach($resultats as $resultat){
                        $idHab = $resultat['IdHab'];
                        $nomHab = $resultat['NomHab'];
                        $description = $resultat['Description_Hab'];
                        echo "<article id='habitat$idHab' class='bg-white rounded-2xl shadow p-4 flex flex-col'>
                                <div class='flex justify-between'>
                                    <h2 class='text-lg font-semibold mb-1'>$nomHab</h2>
                                    <div>
                                        <button onclick=\"turnTo('habitat$idHab')\" class='bg-transparent'>✏️</button>
                                        <a href='php/deleteHabitat.php?id=$idHab'>🗑️</a>
                                    </div>
                                </div>
                                <p class='text-sm text-gray-600 flex-1'>$description</p>
                                <form action='php/updateHabitat.php' method='post' class='hidden w-full flex flex-col gap-2'>
                                    <div class='flex justify-between'>
                                        <h2 class='text-lg font-semibold mb-1'>Modification d'habitat: $nomHab</h2>
                                        <div class='flex justify-baseline items-center gap-2'>
                                            <button type='submit' title='Enregistrer'>💾</button>
                                            <button onclick=\"turnTo('habitat$idHab')\" type='button' class='text-red-500 text-3xl' title='Annuler'>&times;</button>
                                        </div>
                                    </div>
                                    <input type='text' name='habitatName' placeholder='Entrez le nouveau nom d'habitat' value='$nomHab' required
                                        class='w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500'
                                    >
                                    <input type='text' name='id' class='hidden' value='$idHab'>
                                    <textarea name='habitatDescription' rows='3'
                                        class='w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500'
                                    >$description</textarea>
                                </form>
                            </article>";
                    }
                ?>
            </section>
            <!-- Section Statistiques -->
            <section id="statistiques" class="hidden ">
                <h1 class="text-2xl font-bold mb-4 text-slate-800">
                    Animaux par habitat
                </h1>
                <p class="text-sm text-slate-500 mb-4">
                    Chaque barre représente le nombre d’animaux dans un habitat du zoo.
                </p>
                <canvas id="habitatChart" class="w-full h-644"></canvas>
            </section>
            <!-- Section Animal -->
            <section id="animal" class="hidden max-w-screen">
                <div class="w-2/3 mx-auto flex gap-6 items-start items-center mt-8">
                    <div class="w-1/3">
                        <img
                        src="images/animal.svg"
                        alt="Prévisualisation"
                        class="w-full h-auto object-cover rounded-lg shadow"
                        id="preview-img"
                        >
                    </div>
                    <form action="php/addAnimal.php" method="post"
                        id="add-animal-form" 
                        class="w-2/3 bg-white/50 rounded-lg p-4 shadow space-y-4"
                    >
                        <h2 class="text-xl font-semibold">Ajouter un animal</h2>

                        <div>
                            <label for="habitat-img" class="block text-sm font-medium mb-1">
                                URL de l'image
                            </label>
                            <input
                                type="url"
                                id="habitat-img"
                                name="habitatImg"
                                placeholder="https://exemple.com/mon-image.jpg"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label for="animal-name" class="block text-sm font-medium mb-1">Nom de l'animal</label>
                            <input type="text" id="animal-name" name="animalName" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label for="animal-species" class="block text-sm font-medium mb-1">Régime alimentaire</label>
                            <select id="animal-species" name="animalSpecies" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            <option value="" selected disabled>-- Choisir un régime --</option>
                            <option value="Carnivore">Carnivore</option>
                            <option value="Herbivore">Herbivore</option>
                            <option value="Omnivore">Omnivore</option>
                            </select>
                        </div>

                        <div>
                            <label for="animal-habitat" class="block text-sm font-medium mb-1">Habitat</label>
                            <select id="animal-habitat" name="animalHabitat" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            <option value="" selected disabled>-- Choisir un habitat --</option>
                            <?php
                                $sql = "select IdHab, NomHab from Habitats";
                                $resultats = $connexion->query($sql);
                                foreach($resultats as $resultat){
                                    $idHab = $resultat['IdHab'];
                                    $nomHab = $resultat['NomHab'];
                                    echo "<option value='$idHab'>$nomHab</option>";
                                }
                            ?>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 text-white text-sm font-medium py-2 rounded hover:bg-green-700 transition"
                        >
                            Ajouter l'animal
                        </button>
                    </form>
                </div>
            </section>
            <!-- Section Habitat -->
            <section id="habitat" class="hidden ">
                <form action="php/addHabitat.php" method="post" 
                    id="add-habitat-form" 
                    class="max-w-md mx-auto p-4 bg-white/50 rounded-lg shadow space-y-4"
                >
                    <h2 class="text-xl font-semibold">Ajouter un habitat</h2>

                    <div>
                        <label for="habitat-name" class="block text-sm font-medium mb-1">Nom de l'habitat</label>
                        <input
                        type="text"
                        id="habitat-name"
                        name="habitatName"
                        required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label for="habitat-desc" class="block text-sm font-medium mb-1">Description</label>
                        <textarea id="habitat-desc" name="habitatDescription" rows="3"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        ></textarea>
                    </div>

                    <button type="submit" 
                        class="w-full bg-blue-600 text-white text-sm font-medium py-2 rounded hover:bg-blue-700 transition"
                    >
                        Ajouter l'habitat
                    </button>
                </form>
            </section>
            <!-- Section Quiz -->
            <!-- <section id="jeux" class="hidden ">

            </section> -->
        </main>
        <script src="js/scripts.js"></script>
    </body>
</html>