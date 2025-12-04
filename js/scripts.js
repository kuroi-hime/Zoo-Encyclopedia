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

imgHabitat.addEventListener('input', ()=>{setImage(imgHabitat.value)})