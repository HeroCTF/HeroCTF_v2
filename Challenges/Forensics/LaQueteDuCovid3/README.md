# La quête du COVID 3/4

### Catégorie

Forensics

### Description

Parfait ! Nous avons maintenant identifié l'IP de l'attaquant.
Il semblerait qu'un programme bizarre se soit lancé aussi, Boris ne peut plus ouvrir un de ses fichiers...

Retrouvez le nom du programme, son PID ainsi que le fichier que Boris ne peut plus ouvrir!

Rappel : Le dump mémoire à analyser est celui du premier challenge.
Format du flag : Hero{nom:PID.nomfichier}

### Auteur 

Worty

### Solution

Avec l'épreuve précédente, on sait que le Hacker c'est connecté sur la machine de boris à 20h42 et 27 secondes, on va donc se baser là dessus pour chercher le processus responsable du chiffrement de son fichier d'analayse covid.<br/>
On va donc relister la les processus pour voir ceux qui ont été crées après 20h42.<br/>
![alt](first_grep.png)
Ici, on ne voit aucun processus intéressant, juste le fichier de backdoor et le bash lancé depuis celle-ci, on va donc grep à partir de 20h43.

![alt](second_grep.png)
Un processus retiens mon attention, le processus "covid", qui n'est pas du tout un processus habituel.<br/>
Partant du principe que ce programme est bien celui que l'on cherche, on va aller liste les fichiers qu'il a potentiellement pu ouvrir, pour y faire une quelconque action.

![alt](third_grep.png)
Le processus a ouvert le fichier "resultat_analyse.txt" de Boris surement pour le chiffrer, c'est donc notre fichier!
### Flag

Hero{covid:2461:resultat_analyse.txt}
