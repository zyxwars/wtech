from io import BytesIO

import requests
from PIL import Image

bg_image = Image.open("vinyl-blank.png").convert("RGBA")

urls = [
    "https://images.unsplash.com/photo-1547157233-48f320d15108?q=80&w=3924&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1723203331194-47d46a577c7d?q=80&w=3024&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1734779205618-30ee0220f56f?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDJ8Ym84alFLVGFFMFl8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1743191771058-d06e793dda2d?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDN8Ym84alFLVGFFMFl8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1744058588832-5a0cf779b215?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDh8Ym84alFLVGFFMFl8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1743014379226-a3189c8f4a84?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDZ8Ym84alFLVGFFMFl8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1744132116976-0a68511b70f6?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDIyfGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1732692699579-592f37bf4cdf?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDIzfGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1744023018283-b1bbb84dd0df?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDI3fGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1743710426934-89887ca897d8?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDMzfGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1742599968125-a790a680a605?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDQ4fGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1744726666136-7b923572a561?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDJ8cVBZc0R6dkpPWWN8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1744035522988-08bf64003759?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDd8cVBZc0R6dkpPWWN8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1744219792921-a74da6141822?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDV8cVBZc0R6dkpPWWN8fGVufDB8fHx8fA%3D%3D",
    "https://images.unsplash.com/photo-1741888181508-851b1283ed8e?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDE2fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1736561609156-8e503d619ba9?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDE4fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1678811116814-26372fcfef1b?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDIyfHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1719293846622-4101792a255d?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDI2fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1633668803757-40926829820b?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDM5fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D",
    "https://images.unsplash.com/photo-1743449661678-c22cd73b338a?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDM3fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D",
]


def overlayImages(url, new_name):
    try:
        response = requests.get(url)
        overlay_img = Image.open(BytesIO(response.content)).convert("RGBA")

        width, height = overlay_img.size
        min_side = min(width, height)
        left = (width - min_side) // 2
        top = (height - min_side) // 2
        right = left + min_side
        bottom = top + min_side
        overlay_img_cropped = overlay_img.crop((left, top, right, bottom))

        overlay_img_resized = overlay_img_cropped.resize((300, 300))

        bg_image.paste(overlay_img_resized, (20, 50), overlay_img_resized)
        bg_image.save(f"./storage/app/public/product-images/{new_name}.png")
        overlay_img_cropped.resize((400, 400)).save(
            f"./storage/app/public/product-images/{new_name}-cover.png"
        )

        print(f"- {new_name}.png, {new_name}-cover.png {url}")

    except Exception as e:
        print(f"Failed to process image from {url}: {e}")


for i, url in enumerate(urls):
    overlayImages(url, i)
