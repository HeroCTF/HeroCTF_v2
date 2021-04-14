# CoronaData

### Catégorie

Algo

### Description

Vous êtes engagé sur un nouveau poste dans le big data. Vous devez analyser le fichier CSV ci-dessous. La réponse attendue est le nombre MAXIMUM de "cas_confirmes".

```
Exemple:
date, ville, dep, cas_confirmes
15/04/20, Rennes, 35, 50
15/04/20, Paris, 75, 100
15/04/20, Vannes, 56, 30

Réponse: 100 
Flag: Hero{100}
```

Format: Hero{nombre}

### Fichier

[corona.csv](corona.csv)

### Auteur

xanhacks

### Solution

Une des possibilités pour résoudre ce challenge est de réaliser un script python avec le module "pandas".

```
$ python3 -m pip install pandas
```

Script :

```python
#!/usr/bin/env python3
import pandas as pd

df = pd.read_csv("corona.csv", delimiter=",")
print(df["cas_confirmes"].max())
```

Solution :

```
$ python3 solve.py
591971.0
```

### Flag

Hero{591971} ou Hero{591971.0}