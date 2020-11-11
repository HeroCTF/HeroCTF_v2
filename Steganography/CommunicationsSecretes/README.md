# Communications secrètes

### Catégorie

Steganography

### Description

Le BDE a découvert que certains professeurs de l'IUT communiquaient à travers des PDF de cours. Nous avons réussi à intercepter le PDF en question ainsi qu'une archive. Nous pensons que le PDF peut aider à ouvrir cette archive.

Nous comptons sur vous.

Format: HERO{flag}

### Hint

Deux mots de passe sont cachés dans le PDF.

### Fichier

[PDF.zip](PDF.zip)

### Auteur

Thib

### Solution

C'est un challenge en 2 étapes : 

La première est de faire un CTRL+A dans le PDF pour trouver le mot de passe écrit blanc sur blanc.
```
f1rs7_p4$$word
```

La deuxième étape est de regarder les metadata du PDF pour trouver le deuxième mot de passe.
```
> exiftool how_to_sftp_pjwebb.pdf 
...
Creator                         : 5EC0ND_P4SSW0RD
...
```

On unzip l'archive avec les 2 mots de passe trouvés et on obtient le flag.

### Flag

HERO{F1N4LLY}