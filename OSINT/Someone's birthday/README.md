# Someone's birthday

### Catégorie
OSINT

### Description
Il semblerait que ce soit l'anniversaire d'un des admins...

Format : Hero{flag}

### Auteur
????? (Worty)

### Solution
Pour ce challenge on se transforme en espion et on va chercher de quel admin ce pourrait etre l'anniversaire en cette belle journée du 13 Novembre 2020...
Après quelques recherches ont peut par exemple tomber sur le [twitter de Worty](https://twitter.com/WortySTO) où l'on voit la mention `Naissance le 13 novembre`.

On peut alors avoir l'idée d'explorer son [site internet](https://wortysto.github.io/) où un message nous est clairement destiné : 
``
Hero{1ts_w0rty_birthd4y_!!}`bash
Welcome to my website!
I have one question, Are you comfortable with a linux terminal?
Enter yes or no, please.
Oh and by the way my birthdate is 13/11/2000, enter yes to have your reward!
Your answer :
```
On entre donc `yes` et on avance.
```bash
Welcome to my terminal website !
Browse into it to discover ctf write up's, cheatsheets, ..
Use basic linux commands like ls, cat, cd, ..
If you wan't to see all commands available, enter help.
If you want to skip the animation of the commands, double click.
A flag is hidden in the site, find it !

guest@wortyClient:~$ 
```
On se retrouve ici avec ce qui ressemble à un terminal ! on peut donc récupérer le flag de la manière suivante :
```bash
guest@wortyClient:~$ ls
-rw-r--r-- About.txt
-rw-r--r-- Root_Me.txt
-rw-r--r-- Twitter.txt
-rw-r--r-- Flag.txt
drwxr-xr-x writeups
guest@wortyClient:~$ cat Flag.txt
Hero{1ts_w0rty_birthd4y_!!}
```

### Flag
Hero{1ts_w0rty_birthd4y_!!}
