# PyCode

### Catégorie

Reverse

### Description

Nous avons retrouvé ce fichier sur un ordinateur d'une organisation dangereuse.
À vous de retrouver le flag qui s'y cache !

Format: Hero{FLAG}

### Fichier

[challenge.pyc](challenge.pyc)

### Auteur

xanhacks

### Solution

On récupère le code source depuis le ficher PYC.

```
$ python3 -m pip install uncompyle6
$ uncompyle6 challenge.pyc
```

On créer un script pour annuler le XOR.

```python
#!/usr/bin/env python3


def deobfuscate(cipher):
    ret = ""
    for i, c in enumerate(cipher):
        ret += chr(ord(c) ^ (1 + i % 3))
    return ret


print(deobfuscate("M4j2l3GpQhUC"))
```

On peut faire l'équivalent en une ligne
```python
print("".join([chr(ord(c) ^ (1 + i % 3)) for i, c in enumerate("M4j2l3GpQhUC")]))
```

Réponse :

```shell
$ python3 solve.py
L6i3n0FrRiW@
```

### Flag

Hero{L6i3n0FrRiW@}