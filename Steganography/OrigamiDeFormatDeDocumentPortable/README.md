# Origami de format de document portable

### Catégorie

Steganography

### Description

En nous baladant dans l'IUT nous avons trouvé une clé USB contenant un document étrange. après quelques recherches, nous pensons qu'elle peut contenir des données sensibles. Nous comptons sur vous les extraires.

### Fichier

[steg.pdf](steg.pdf)

### Auteur

Thib

### Solution

C'est un challenge en plusieurs étapes : 

1- Avec un outils comme pdf-parser, on analyse les objects du PDF et on extrait les données contenues dans l'objet 8 avec la commande 
```
> pdf-parser -o 8 -f -d decode.jpg steg.pdf
```
On obtient une image jpg.

2- En examinant l'hexa de l'image, on découvre un mot de passe 
```
deadbeef1234
```
3- Avec ce mot de passe, on utilise steghide avec la commande 
```
> steghide extract -sf decode.jpg -p deadbeef1234
```
On extrait donc une autre image avec le flag

### Flag

HERO{B3_C4R3FUL}