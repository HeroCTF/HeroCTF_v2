# Sir accuse

### Catégorie

Sequence

### Description

Votre pote mathématicien se croit plus malin que vous. Prouvez-lui qu'il a tort en trouvant les 3 éléments complétant la suite suivante !

Suite : 17, 52, 26, 13, 40, 20, 10, 5, ..., ..., ...

Format : HeroCTF{x, y, z} avec x, y et z les 3 valeurs complétant la suite

### Auteur

SoEasy

### Solution

La suite correspond à la suite de Syracuse:
https://fr.wikipedia.org/wiki/Conjecture_de_Syracuse

Python:

```python
#!/usr/bin/env python3

num = 17

for i in range(10):
    if num % 2 == 0:
        num /= 2
    else:
        num = 3*num + 1

    print(f"{int(num)}, ", end="")
```

```shell
$ python3 solve.py 
52, 26, 13, 40, 20, 10, 5, 16, 8, 4,
```

### Flag

HeroCTF{16, 8, 4}