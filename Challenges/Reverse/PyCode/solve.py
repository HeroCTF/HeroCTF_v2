#!/usr/bin/env python3


def deobfuscate(arg):
    ret = ""
    for i, c in enumerate(arg):
        ret += chr(ord(c) ^ (1 + i % 3))
    return ret


print(deobfuscate("M4j2l3GpQhUC"))