#!/usr/bin/env python3

num = 17

for i in range(10):
    if num % 2 == 0:
        num /= 2
    else:
        num = 3*num + 1

    print(f"{int(num)}, ", end="")
