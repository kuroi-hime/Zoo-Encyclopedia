# Zoo-Encyclopedia
Zoo encyclopédie est une application web éducative pour enrichir les connaissances des enfants en crèche sur les animaux du zoo.

## script MySQL
1. Initialisation de la base:
```SQL
-- création de la base de données:
create database ZOO;

-- selection de la base de données:
use ZOO;

-- création de la table Habitats:
create table Habitats(
    IdHab int primary key auto_increment,
    NomHab varchar(255) not null,
    Description_Hab text not null
);

-- création de la table Animaux:
create table Animaux(
    ID int primary key auto_increment,
    Nom varchar(255) not null,
    Type_alimentaire varchar(255) not null,
    Image varchar(255) not null,
    IdHab int,
    foreign key (IdHab) references Habitats(IdHab)
);
```
2. Insertion de données de test:
```bash
-- Insertion des valeurs dans la table habitats:
insert into Habitats (NomHab, Description_Hab)
values ('Savane', 'est une formation végétale caractéristique des régions tropicales chaudes avec une longue saison sèche, dominée par des herbes hautes de la famille des Poacées et parsemée d’arbres ou d’arbustes. Elle est souvent décrite comme une prairie herbeuse avec des herbes atteignant au moins 80 cm de hauteur à la fin de la saison de végétation');

-- Insertion des valeurs dans la table animaux:
insert into Animaux (Nom, Type_alimentaire, Image, IdHab)
values ('Lion', 'carnivore', 'https://plus.unsplash.com/premium_photo-1666672388644-2d99f3feb9f1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGxpb258ZW58MHx8MHx8fDA%3D', 1);
```
3. Requêtes fréquentes:
```bash
-- Lecture des données:
select *
from Habitats;

select *
from Animaux;

-- Modification d'un enregistrement:
update Animaux
set Nom='Girafe', Type_alimentaire='herbivore', Image='https://plus.unsplash.com/premium_photo-1661813434310-98cca4c9135e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8R2lyYWZlfGVufDB8fDB8fHww'
where ID=1;

-- Suppression d'un enregistrement:
delete from Animaux
where ID=1;

delete from Habitats
where NomHab='Savane';
```
