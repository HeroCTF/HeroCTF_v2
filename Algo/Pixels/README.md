# Pixels

### Catégorie

Algo

### Description

Vous devez compter le nombre pixels NON noir.

Format: Hero{nombre}

### Fichier

[image.png](image.png)

### Auteur

xanhacks

### Solution

Voici deux scripts python qui permettent de compter les pixels non noir (R!=0, G!=0, B!=0).

```
from PIL import Image

img = Image.open("image.png")
pixels = img.getdata()

somme = 0

for pixel in pixels:
	if pixel != (0, 0, 0):
		somme += 1

print(somme)
```

Ou, la version plus compacte :

```
from PIL import Image

pixels = Image.open("image.png").getdata()
print(sum(1 for x in pixels if x != (0, 0, 0)))
```

Solution :

```
$ python3 solve.py
41229
```

### Flag

Hero{41229}