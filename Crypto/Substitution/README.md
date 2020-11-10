# Substitution

### Catégorie

Crypto

### Description

Nous avons intercepté un message d'un alien, à vous de le déchiffrer.

```
SA EKBHMAFASBLT TLM SA MTEIFOJWT JWO EGFLOLMT A RTRWOKT WF MTVMT TF ESAOK R'WF MTVMT EIOYYKT LAFL HGLLTRTK SA EST RT EIOYYKTDTFM. ST HKGETLLWL HAK STJWTS GF MTFMT RT EGDHKTFRKT WF DTLLAUT TF HAKMOEWSOTK TLM AHHTST WFT AMMAJWT. WFT AMMAJWT TLM LGWXTFM EAKAEMTKOLTT HAK STL RGFFTTL JW'TSST FTETLLOMT.
AMMAJWT LWK MTVMT EIOYYKT LTWS (EOHITKMTVM-GFSB TF AFUSAOL) : ST EKBHMAFASBLMT HGLLTRT RTL TVTDHSAOKTL EIOYYKTL RTL DTLLAUTL, OS HTWM YAOKT RTL IBHGMITLTL LWK STL DTLLAUTL GKOUOFAWV JW'OS FT HGLLTRT HAL. SA EKBHMAFASBLT TLM HSWL AKRWT RT HAK ST DAFJWT R'OFYGKDAMOGFL A ROLHGLOMOGF.
AMMAJWT A MTVMT ESAOK EGFFW (QFGCF-HSAOFMTVM AMMAEQ TF AFUSAOL) : ST EKBHMAFASBLMT HGLLTRT RTL DTLLAUTL GW RTL HAKMOTL RT DTLLAUTL TF ESAOK AOFLO JWT STL XTKLOGFL EIOYYKTTL. SA EKBHMAFASBLT SOFTAOKT YAOM HAKMOT RT ETMMT EAMTUGKOT.
AMMAJWT A MTVMT ESAOK EIGOLO (EIGLTF-HSAOFMTVM AMMAEQ TF AFUSAOL) : ST EKBHMAFASBLMT HGLLTRT RTL DTLLAUTL TF ESAOK, OS HTWM EKTTK STL XTKLOGFL EIOYYKTTL RT ETL DTLLAUTL AXTE S'ASUGKOMIDT JWT S'GF HTWM RTL SGKL EGFLORTKTK EGDDT WFT ZGOMT FGOKT. SA EKBHMAFASBLT ROYYTKTFMOTSST TLM WF TVTDHST R'AMMAJWT A MTVMT ESAOK EIGOLO.
AMMAJWT A MTVMT EIOYYKT EIGOLO (EIGLTF-EOHITKMTVM AMMAEQ TF AFUSAOL) : ST EKBHMAFASBLMT HGLLTRT RTL DTLLAUTL EIOYYKTL TM RTDAFRT SA XTKLOGF TF ESAOK RT ETKMAOFL RT ETL DTLLAUTL HGWK DTFTK S'AMMAJWT.
ITKG{SA_EKBHMG_E_YWF}
```

Format: Hero{flag}

### Hint

https://www.youtube.com/watch?v=rUlqxHGKJ68

### Auteur

xanhacks

### Solution

https://www.dcode.fr/substitution-monoalphabetique

La cryptanalyse est la technique qui consiste à déduire un texte en clair d’un texte chiffré sans posséder la clé de chiffrement. Le processus par lequel on tente de comprendre un message en particulier est appelé une attaque. Une attaque est souvent caractérisée par les données qu'elle nécessite.
Attaque sur texte chiffré seul (ciphertext-only en anglais) : le cryptanalyste possède des exemplaires chiffrés des messages, il peut faire des hypothèses sur les messages originaux qu'il ne possède pas. La cryptanalyse est plus ardue de par le manque d'informations à disposition.
Attaque à texte clair connu (known-plaintext attack en anglais) : le cryptanalyste possède des messages ou des parties de messages en clair ainsi que les versions chiffrées. La cryptanalyse linéaire fait partie de cette catégorie.
Attaque à texte clair choisi (chosen-plaintext attack en anglais) : le cryptanalyste possède des messages en clair, il peut créer les versions chiffrées de ces messages avec l'algorithme que l'on peut dès lors considérer comme une boîte noire. La cryptanalyse différentielle est un exemple d'attaque à texte clair choisi.
Attaque à texte chiffré choisi (chosen-ciphertext attack en anglais) : le cryptanalyste possède des messages chiffrés et demande la version en clair de certains de ces messages pour mener l'attaque.
Hero{la_crypto_c_fun}

### Flag

Hero{la_crypto_c_fun}