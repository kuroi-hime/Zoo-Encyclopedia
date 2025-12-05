// const homeButton = document.getElementById('toHome');
const animalsButton = document.getElementById('toAnimals');
const habitatsButton = document.getElementById('toHabitats');
const statisticsButton = document.getElementById('toStatistics');
const gameButton = document.getElementById('toGame');
const addAnimal = document.getElementById('addAnimal');
const addHabitat = document.getElementById('addHabitat');
const imgHabitat = document.getElementById('habitat-img');
const filtreRegime = document.getElementById('filtreRegime');
const filtreHabitat = document.getElementById('filtreHabitat');

function showCurrentSection(sectionName){
    document.querySelectorAll('section').forEach(section => section.classList.add('hidden'));
    document.getElementById(sectionName).classList.remove('hidden');
}

animalsButton.addEventListener('click', ()=>{showCurrentSection('animaux')});
habitatsButton.addEventListener('click', ()=>{showCurrentSection('habitats')});
statisticsButton.addEventListener('click', ()=>{showCurrentSection('statistiques')});
addAnimal.addEventListener('click', ()=>{showCurrentSection('animal')});
addHabitat.addEventListener('click', ()=>{showCurrentSection('habitat')});

function setImage(url){
    if(url=='')
        document.getElementById('preview-img').src = 'images/animal.svg';
    else
        document.getElementById('preview-img').src = url;
}

imgHabitat.addEventListener('input', ()=>{setImage(imgHabitat.value)});

function turnTo_animal(){
    const divs = document.getElementById('modalContent').querySelectorAll('div');
    const buttons = divs[0].querySelectorAll('button');
    buttons.forEach(button=>{
        button.classList.toggle('hidden');  
    });
    divs[1].classList.toggle('hidden');
    divs[2].classList.toggle('hidden');
    divs[3].classList.toggle('hidden'); 
}

function showAnimalDetails(id, image, nom, regime, idHab, nomHab, description){
    const content = `
                    <div class="flex gap-4 p-4 justify-end">
                        <button name="modifier" onclick="turnTo_animal()">✏️</button>
                        <button name="supprimer"><a href="php/deleteAnimal.php?id=${id}">🗑️</a></button>
                        <button class='hidden' type='submit' title='Enregistrer'>💾</button>
                    </div>
                    <div class="text-center">
                        <img src="${image}" alt="${nom}" class="w-90 h-64 mx-auto rounded-3xl shadow-2xl mb-6">
                        <h2 class="text-3xl font-bold mb-4">${nom}</h2>
                        <div class="space-y-3 mb-6">
                            <p class="text-xl text-gray-700 bg-yellow-100 p-3 rounded-2xl">${regime}</p>
                            <p class="text-xl text-gray-700 bg-yellow-100 p-3 rounded-2xl">Un animal qui habite à: ${nomHab}</p>
                            <p class="text-xl text-gray-700 bg-yellow-100 p-3 rounded-2xl">(${nomHab}) ${description}</p>
                        </div>
                    </div>
                    <div class="hidden bg-white/50 rounded-lg p-4 shadow space-y-4">
                        <h2 class="text-xl font-semibold">Modifier un animal</h2>

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
                                value="${image}"
                            >
                        </div>

                        <div>
                            <label for="animal-name" class="block text-sm font-medium mb-1">Nom de l'animal</label>
                            <input type="text" id="animal-name" name="animalName" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="${nom}"
                            >
                        </div>

                        <div>
                            <label for="animal-species" class="block text-sm font-medium mb-1">Régime alimentaire</label>
                            <select id="animal-species" name="animalSpecies" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="${regime}"
                            >
                            <option value="" disabled>-- Choisir un régime --</option>
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
                    </div>
                `;
    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('animalModal').classList.remove('hidden');
}

function closeModal(){
    document.getElementById('animalModal').classList.add('hidden');
}

function turnTo(id){
    document.getElementById(id).querySelector('div').classList.toggle('hidden');
    document.getElementById(id).querySelector('p').classList.toggle('hidden');
    document.getElementById(id).querySelector('form').classList.toggle('hidden');
}

function filtrer(value1, value2){
    animaux = document.getElementsByClassName('animal');
    Array.from(animaux).forEach(animal=>{
        animal.classList.remove('hidden');
        
        if(!(animal.querySelector('p').innerText.includes(value1) && animal.getAttribute('name').includes(value2)))
            animal.classList.add('hidden');
    });
    
}

filtreRegime.addEventListener('change', ()=>{filtrer(filtreRegime.value, filtreHabitat.value)});

filtreHabitat.addEventListener('change', ()=>{filtrer(filtreRegime.value, filtreHabitat.value)});