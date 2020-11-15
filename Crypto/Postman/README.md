# Postman

### Catégorie

Crypto

### Description

Le facteur passe parfois à l'eur. Reconstruisez une clé privée à partir de ces clés publiques et connectez vous avec :

`ssh -i KEYFILE postman@challs.heroctf.fr -p 22555`

Format: Hero{FLAG}

### Fichiers

[postman.tar.gz](postman.tar.gz)

### Auteur

Yarienkiva

### Solution
[solve.py](solve.py)

Le zip fournis contient 1000 clés publiques SSH, le but est d'en retrouver au moins une pour se connecter à la machine distante.
Pour celà on va faire une common factor attack sur chaque paire de clé, c'est à dire que pour chaque paire de clé (a,b) on va calculer PGCD(N de a, N de b), s'il est différent de 1 cela veut dire qu'on a trouvé un des facteurs des N.
Il ne reste ensuite plus qu'à en factoriser un :

```python
p = PGCD(Na, Nb)
q = Na // p

phi = (p - 1) * (q - 1)
d   = inverse(0x10001, phi)

key = RSA.construct((Na, 0x10001, d))
print(key.export_key('PEM').decode())
```

https://eprint.iacr.org/2012/064.pdf (Le papier dont est inspiré ce challenge)

https://ctftime.org/writeup/14021 (J'ai découvert il y a environ 15min qu'un challenge assez similaire existait déjà, ce WU utilise [RsaCtfTool](https://github.com/Ganapati/RsaCtfTool) pour solve le challenge)


### Flag

Hero{3ul3r_b3_pr0ud}
