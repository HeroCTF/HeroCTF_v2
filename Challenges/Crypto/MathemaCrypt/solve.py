#!/usr/bin/env python3

cipher = "Ry Tazvtxli rlbaalxy qyzc ul rvgkp vx dzaaltl"

def char_position(letter):
    return ord(letter) - 97

def pos_to_char(pos):
    return chr(pos + 97)

for a in range(25):
    for b in range(25):
        for c in cipher:
            if c == " ":
                print(c, end="")
            else:
                letter_index = char_position(c.lower())
                affine_index = (letter_index * a + b) % 26

                print(pos_to_char(affine_index), end="")
        print()
