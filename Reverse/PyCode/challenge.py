#!/usr/bin/env python3


def obfuscate(arg):
    ret = ""
    for i, c in enumerate(arg):
        ret += chr(ord(c) ^ (1 + i % 3))
    return ret


def main():
    password = "M4j2l3GpQhUC"
    input_pass = input("Enter your password: ")

    if input_pass and obfuscate(input_pass) == password:
        print("You can validate the challenge with this password !")
    else:
        print("Failed !")


if __name__ == "__main__":
    main()
