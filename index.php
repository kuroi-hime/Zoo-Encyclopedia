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
    <body class="bg-gradient-to-br from-yellow-200 to-pink-200 max-h-screen p-4 font-sans">
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
                <button id="toGame" class="bg-orange-400 text-white px-6 py-3 rounded-full text-xl shadow-lg hover:scale-110 transition-all">Jeux</button>
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
                <?php
                ?>
            </section>
            <!-- Section Habitats -->
            <section id="habitats" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                ?>
            </section>
            <!-- Section Statistiques -->
            <section id="statistiques" class="hidden ">
                <?php
                ?>
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
            <section id="jeux" class="hidden ">

            </section>
        </main>
        <script src="js/scripts.js"></script>
    </body>
</html>