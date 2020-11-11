# Contact Me !

### Catégorie

Web

### Description

Un petit développeur a mis en place un serveur où vous pouvez le contacter.
Malheureusement, une des pages n'est pas accessible, et j'ai vraiment envie de savoir ce qu'elle cache... Vous pouvez le faire pour moi ?

http://challs.heroctf.fr:3010/

Format : Hero{flag}

### Auteur

Worty

### Solution

On arrive sur une page qui nous propose de laisser un commentaire à l'administrateur pour qu'il le lise plus tard.<br/>
Pourquoi pas tenter d'afficher une alerte javascript pour voir si une XSS est possible ?

Payload : <script>alert(1);</script>