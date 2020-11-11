# Matchees !

### Catégorie

Web

### Description

Il faut devenir administrateur pour valider ce challenge.

http://challs.heroctf.fr:5433/

Format: Hero{flag}

### Auteur

xanhacks

### Solution

Dans ce challenge, tout se passe au niveau des cookies.

Nous pouvons voir que nous avons un cookie :

```
admin=0
```

Si nous changeons cette valeur à :

```
admin=1
```

Nous obtenons le flag !

### Flag

Hero{1_l0v3_c00k1ies_123}