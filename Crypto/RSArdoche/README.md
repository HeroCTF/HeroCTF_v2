# RSArdoche

### Catégorie

Crypto

### Description

RSArdoche le roi du Salt n'aime pas qu'on lui vole ses Stack.

Format: Hero{FLAG}

### Fichiers

[RSArdoche.py](RSArdoche.py)
[output.txt](output.txt)

### Auteur

Yarienkiva

### Solution

La formule pour chiffrer un message en RSA : `ct = pt ^ e % n`

Sauf que pour e=1 on a :
```
        ct = pt ^ e % n
    <=> ct = pt ^ 1 % n
    <=> ct = pt % n
    <=> ct = pt (car n > ct)
```

Le ciphertext étant égal au plaintext on peut donc simplement le décoder avec : 
```python
from Crypto.Util.number import long_to_bytes
print(long_to_bytes(ct))
```
https://stackoverflow.com/questions/17490282/why-is-this-commit-that-sets-the-rsa-public-exponent-to-1-problematic
https://www.cryptofails.com/post/70059600123/saltstack-rsa-e-d-1 (L'inspiration de ce challenge et du jeu de mot qui a donné le titre et la description, jeu de mot que je ne pense plus jamais égaler de toute ma vie)

### Flag

Hero{m41s_c5t4it_5ur_3nf41t_c5t41t_5ur!!!}
