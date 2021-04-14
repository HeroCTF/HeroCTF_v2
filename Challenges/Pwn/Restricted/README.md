# Restricted

### Catégorie

Pwn

### Description

Vous devez trouver le fichier texte dans votre HOME, puis le lire.

```
ssh pwn@challs.heroctf.fr -p 22444
Password: pwn
```

Format: Hero{flag}

### Hint

rbash: https://www.gnu.org/software/bash/manual/html_node/The-Restricted-Shell.html

Vous n'avez pas besoin de sortir du "rbash" pour résoudre ce challenge.

### Auteur

xanhacks

### Solution

Lister tous les fichiers :

```
pwn@pwn:~$ echo *
bin f04af61b3f332afa0ceec786a42cd365.txt
```

Lire un fichier :

```
pwn@pwn:~$ echo `< f04af61b3f332afa0ceec786a42cd365.txt`
Hero{r3strict3d_b4sh_with_3cho}
```

ou (Merci à @Rick)

```
pwn@pwn:~$ source f04af61b3f332afa0ceec786a42cd365.txt
rbash: Hero{r3strict3d_b4sh_with_3cho}: command not found
```

### Flag

Hero{r3strict3d_b4sh_with_3cho}