key = "S3cr3tK3yS3cr3tK3y"
ciphered = [0x1b, 0x56, 0x11, 0x1d, 0x70, 0x20, 0x0d, 0x48, 0x38, 0x01, 0x7e, 0x10, 0x06, 0x41, 0x1b, 0x25, 0x54, 0x04]
flag = ""

for i, c in enumerate(ciphered):
        flag += chr(c ^ ord(key[i]))
print(flag)