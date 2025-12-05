// const homeButton = document.getElementById('toHome');
const animalsButton = document.getElementById('toAnimals');
const habitatsButton = document.getElementById('toHabitats');
const statisticsButton = document.getElementById('toStatistics');
const gameButton = document.getElementById('toGame');
const addAnimal = document.getElementById('addAnimal');
const addHabitat = document.getElementById('addHabitat');
const imgHabitat = document.getElementById('habitat-img');

function showCurrentSection(sectionName){
    document.querySelectorAll('section').forEach(section => section.classList.add('hidden'));
    document.getElementById(sectionName).classList.remove('hidden');
}

animalsButton.addEventListener('click', ()=>{showCurrentSection('animaux')});
habitatsButton.addEventListener('click', ()=>{showCurrentSection('habitats')});
statisticsButton.addEventListener('click', ()=>{showCurrentSection('statistiques')});
gameButton.addEventListener('click', ()=>{showCurrentSection('jeux')});
addAnimal.addEventListener('click', ()=>{showCurrentSection('animal')});
addHabitat.addEventListener('click', ()=>{showCurrentSection('habitat')});

function setImage(url){
    if(url=='')
        document.getElementById('preview-img').src = 'images/animal.svg';
    else
        document.getElementById('preview-img').src = url;
}

imgHabitat.addEventListener('input', ()=>{setImage(imgHabitat.value)});

function showAnimalDetails(id, image, nom, regime, nomHab, description){
    const content = `
                    <div class="flex gap-4 p-4 justify-end">
                        <button name="modifier">✏️</button>
                        <button name="supprimer"><a href="php/deleteAnimal.php?id=${id}">🗑️</a></button>
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
                `;
    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('animalModal').classList.remove('hidden');
}

function closeModal(){
    document.getElementById('animalModal').classList.add('hidden');
}