# Matchees !

### Catégorie

Web

### Description

Trouver le moyen de détourner la vérification !

http://challs.heroctf.fr:8080/

Format: Hero{FLAG}

### Auteur

xanhacks

### Solution

Après beaucoup de recherche nous apprenons que c'est deux URL valident le isset($_GET['give_flag']) :

- http://challs.heroctf.fr:8080/?give_flag
- http://challs.heroctf.fr:8080/?give.flag

Or, le caractère "." n'est pas interdit dans le preg_match, nous obtenons donc le flag.

### Flag

Hero{h0w_70_pr36_m47ch_10381}