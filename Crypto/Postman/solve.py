#!/usr/bin/env python3
# https://eprint.iacr.org/2012/064.pdf

from Crypto.PublicKey import RSA
from Crypto.Util.number import inverse
import math

from itertools import combinations
import os
from tqdm import tqdm

ns = {}
path = 'keys'

for k in os.listdir(path):
	with open(path + '/' + k, 'r') as file:
		pub = RSA.import_key(file.read())
	ns[k] = pub.n

for x, y in tqdm(combinations(ns, 2)):
	p = math.gcd(ns[x], ns[y])
	if p != 1:
		print(f'{x}:{ns[x]}', f'{y}:{ns[y]}', f'p:{p}', sep='\n\n')
		break
		
e  = 0x10001

q   = ns[x] // p
phi = (p - 1) * (q - 1)
d   = inverse(e, phi)

key = RSA.construct((ns[x], e, d))
print(key.export_key('PEM').decode())
