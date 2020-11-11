# ChatTCP

### Catégorie

Networks

### Description

Trouver le flag caché dans cette communication !

Format: HeroCTF{FLAG}

### Hint

https://www.wireshark.org/

Le flag n'a pas été envoyé en clair.

### Fichier

[capture.pcapng](capture.pcapng)

### Auteur

xanhacks

### Solution

On ouvre le fichier avec wireshark. On regarde les messages en clear text échangés.

On peut voir cette chaine "IfspDUG{dibu_xjui_ofudbu}".

ROT25 -> HeroCTF{chat_with_netcat} avec https://rot13.com/

### Flag

HeroCTF{chat_with_netcat}