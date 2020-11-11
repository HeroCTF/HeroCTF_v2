# FreePassXC

### Catégorie

Forensics

### Description

Nous avons retrouvé le gestionnaire de mot de passe d'un pirate, à vous de retrouver le mot de passe associé.

Format: Hero{password}

### Hint

https://www.openwall.com/john/

Le mot de passe se trouve dans cette liste : https://www.scrapmaker.com/data/wordlists/dictionaries/rockyou.txt

### Fichier

[s3cr3t.kdb](s3cr3t.kdb)

### Auteur

xanhacks

### Solution

Pour résoudre ce challenge nous pouvons utiliser l'outil JtR (John The Ripper) avec la wordlist rockyou.txt

```
$ keepass2john s3cr3t.kdb > s3cr3t.kdb.hash
$ john s3cr3t.kdb.hash --wordlist=/usr/share/wordlists/rockyou.txt
...
jesuscristo      (s3cr3t.kdb)
...
Session completed
```

### Flag

Hero{jesuscristo}