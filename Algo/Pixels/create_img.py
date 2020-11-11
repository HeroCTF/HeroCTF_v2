from PIL import Image
import numpy as np
import random

width = 500
height = 500

pixels = np.zeros([height, width, 3], dtype=np.uint8)
somme = 0

for x in pixels:
    for y in x:
        if random.randint(0, 5) == 0:
            somme += 1
            y[0] = random.randint(0, 255)
            y[1] = random.randint(0, 255)
            y[2] = random.randint(0, 255)

img = Image.fromarray(pixels)

print(f"Somme: {somme}")

img.save('image.png')