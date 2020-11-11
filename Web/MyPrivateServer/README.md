# My private server

### Catégorie

Web

### Description

Un développeur peu scrupuleux et n'ayant aucune connaissance de la cybersécurité à mis en place un serveur. Pour accéder à celui-ci, vous devez absolument vous identifiez sur la page de login.

Seriez-vous capable d'accéder au serveur en contournant l'authentification ?

Format : Hero{flag}

### Auteur 

Worty

### Solution

On arrive sur une page d'authentification classique, avec un username et un password qui sont demandés.<br/>
Un des premiers réflexes est de regarder si un fichier robots.txt est présent ou non, et dans ce cas, oui ! Il y en a un.<br/>
Dedans on n'y apprend pas grand chose, mais on remarque qu'un fichier est censé rester caché : "username.txt". Dedans, on apprend que le username est "Admin", c'est déjà une bonne information!

On essaye donc de passer une ' dans le username, pour voir si cela déclenche une erreur, et oui!, le script nous affiche "Query error".<br/>
Nous avons donc à faire à une injection SQL!<br/>
Pareil que pour le challenge "Sessions Workout", on va visiter : https://github.com/swisskyrepo/PayloadsAllTheThings, pour voir ce que l'on peut faire.

Dedans, on remarque des injections très classique tel que "OR 1=1", permettant de bypasser la vérification sur le mot de passe dans la base de données.<br/>
Nous avons donc notre payload : <br/>
- Username : ' OR 1=1 AND Username="Admin"; --<br/>
- Password : cequevousvoulez

Dans le mot de passe, on peut mettre n'importe quoi car "--" permet de commenter le reste de la requête et donc de bypasser la vérification du mot de passe.<br/>

### Flag

Hero{b4s1c_sql_1nj3ct1on}
