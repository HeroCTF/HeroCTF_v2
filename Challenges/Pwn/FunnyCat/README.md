# FunnyCat

### Catégorie

Pwn

### Description

Vous devez lire le fichier nommé "-".

```
ssh funnycat@challs.heroctf.fr -p 22222
Password: funnycat
```

Format: Hero{flag}

### Auteur

xanhacks

### Solution

Il y a plusieurs façons de résoudre ce challenge, voici quelques exemples :

```
funnycat:~$ cat < -
Hero{v3ry_s1mpl3_sh3ll_trick}

funnycat:~$ cat ./-
Hero{v3ry_s1mpl3_sh3ll_trick}

funnycat:~$ more -
Hero{v3ry_s1mpl3_sh3ll_trick}

funnycat:~$ vi -
** open vi **
Hero{v3ry_s1mpl3_sh3ll_trick}
```

### Flag

Hero{v3ry_s1mpl3_sh3ll_trick}