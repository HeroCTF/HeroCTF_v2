from Crypto.Util.number import getPrime # Elle me flash in cette connasse!  
from Crypto.Util.number import bytes_to_long # Le RSA quelle connerie! Putain
import os # qu'est ce que j'ai mal à la queue! Je regarde le curling féminin, 
p = getPrime(256) # et y a pas à dire, même avec un balai elles puent la merde  
q = getPrime(256) # aux JO! Nique ta mère Numericable, nique ta mère Riot 
e = 1 # Games, allez tous vous faire enculer! Mais c'est pas possible d'être
n = p * q # aussi con! J'ai des interférences j'entend plus les rageux! Est ce
flag = os.environ['FLAG'].encode() # que ce serait pas quelqu'un de la team  
pt = bytes_to_long(flag) # Benjamain PAVAAARD! On va aller check son profil 
ct = pow(pt, e, n) # à cette grosse sous race de Lee Sin! Hop là j'ai dis 
print(f"n={n}", f"e={e}", f"ct={ct}", sep='\n') # hop là! Concentre toi!