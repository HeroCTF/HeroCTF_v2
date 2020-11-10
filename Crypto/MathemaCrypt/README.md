# MathemaCrypt

### Catégorie

Crypto

### Description

Un professeur de maths au collège a chiffré un message envoyé à ses élèves. Apparemment, il se serait servis d'une function classique.

Ry Tazvtxli rlbaalxy qyzc ul rvgkp vx dzaaltl

Format: Hero{PHRASE DECHIFFREE}

### Auteur

Matisse

### Solution

1) Le site dcode permet de retrouver directement la bonne fonction affine.
https://www.dcode.fr/chiffre-affine

2) Sinon, nous pouvons utiliser un script python qui va bruteforce les solutions.

```python
#!/usr/bin/env python3

cipher = "Ry Tazvtxli rlbaalxy qyzc ul rvgkp vx dzaaltl"

def char_position(letter):
    return ord(letter) - 97

def pos_to_char(pos):
    return chr(pos + 97)

for a in range(25):
    for b in range(25):
        for c in cipher:
            if c == " ":
                print(c, end="")
            else:
                letter_index = char_position(c.lower())
                affine_index = (letter_index * a + b) % 26

                print(pos_to_char(affine_index), end="")
        print()

```

```
$ python3 solve.py
...
mr gloaguen meilleur prof de maths au college
...
```

### Flag

Hero{Mr Gloaguen meilleur prof de maths au college}