"""
from PIL import Image

img = Image.open("image.png")
pixels = img.getdata()

somme = 0

for pixel in pixels:
	if pixel != (0, 0, 0):
		somme += 1

print(somme)
"""

from PIL import Image

pixels = Image.open("image.png").getdata()
print(sum(1 for x in pixels if x != (0, 0, 0)))