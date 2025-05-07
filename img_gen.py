from io import BytesIO

import requests
from PIL import Image

bg_image = Image.open("vinyl-blank.png").convert("RGBA")

urls = [
    "https://images.unsplash.com/photo-1547157233-48f320d15108?w=600",
    "https://images.unsplash.com/photo-1723203331194-47d46a577c7d?w=600",
    "https://images.unsplash.com/photo-1734779205618-30ee0220f56f?w=600",
    "https://images.unsplash.com/photo-1743191771058-d06e793dda2d?w=600",
    "https://images.unsplash.com/photo-1744058588832-5a0cf779b215?w=600",
    "https://images.unsplash.com/photo-1743014379226-a3189c8f4a84?w=600",
    "https://images.unsplash.com/photo-1744132116976-0a68511b70f6?w=600",
    "https://images.unsplash.com/photo-1732692699579-592f37bf4cdf?w=600",
    "https://images.unsplash.com/photo-1744023018283-b1bbb84dd0df?w=600",
    "https://images.unsplash.com/photo-1743710426934-89887ca897d8?w=600",
    "https://images.unsplash.com/photo-1742599968125-a790a680a605?w=600",
    "https://images.unsplash.com/photo-1744726666136-7b923572a561?w=600",
    "https://images.unsplash.com/photo-1744035522988-08bf64003759?w=600",
    "https://images.unsplash.com/photo-1744219792921-a74da6141822?w=600",
    "https://images.unsplash.com/photo-1741888181508-851b1283ed8e?w=600",
    "https://images.unsplash.com/photo-1736561609156-8e503d619ba9?w=600",
    "https://images.unsplash.com/photo-1678811116814-26372fcfef1b?w=600",
    "https://images.unsplash.com/photo-1719293846622-4101792a255d?w=600",
    "https://images.unsplash.com/photo-1633668803757-40926829820b?w=600",
    "https://images.unsplash.com/photo-1743449661678-c22cd73b338a?w=600",
    "https://images.unsplash.com/photo-1500964757637-c85e8a162699?w=600",
    "https://images.unsplash.com/photo-1511367461989-f85a21fda167?w=600",
    "https://images.unsplash.com/photo-1509114397022-ed747cca3f65?w=600",
    "https://images.unsplash.com/photo-1438762398043-ac196c2fa1e7?w=600",
    "https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=600",
    "https://images.unsplash.com/photo-1487088678257-3a541e6e3922?w=600",
    "https://images.unsplash.com/photo-1558376939-7d6cb3025d5c?w=600",
    "https://images.unsplash.com/photo-1509978778156-518eea30166b?w=600",
    "https://images.unsplash.com/photo-1454817481404-7e84c1b73b4a?w=600",
    "https://images.unsplash.com/photo-1563089145-599997674d42?w=600",
    "https://images.unsplash.com/photo-1470790376778-a9fbc86d70e2?w=600",
    "https://images.unsplash.com/photo-1523867574998-1a336b6ded04?w=600",
    "https://images.unsplash.com/photo-1520262494112-9fe481d36ec3?w=600",
    "https://images.unsplash.com/photo-1505274664176-44ccaa7969a8?w=600",
    "https://images.unsplash.com/photo-1590310051055-1079d8f48c89?w=600",
    "https://images.unsplash.com/photo-1489549132488-d00b7eee80f1?w=600",
    "https://images.unsplash.com/photo-1516900448138-898720b936c7?w=600",
    "https://images.unsplash.com/photo-1494830723470-a8f5b3918a99?w=600",
    "https://images.unsplash.com/photo-1538113300105-e51e4560b4aa?w=600",
    "https://images.unsplash.com/photo-1615578731118-37d932b83555?w=600",
    "https://images.unsplash.com/photo-1525226456211-24affe06d7dc?w=600",
    "https://images.unsplash.com/photo-1610189808557-9051febb2cb8?w=600",
    "https://images.unsplash.com/photo-1535157412991-2ef801c1748b?w=600",
    "https://images.unsplash.com/photo-1663042092427-fde6ca201ed0?w=600",
    "https://images.unsplash.com/photo-1589689342466-81889bcd7e67?w=600",
    "https://images.unsplash.com/photo-1654647382270-83a08c49e75b?w=600",
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
        bg_image.save(f"./product-images/{new_name}.png")
        overlay_img_cropped.resize((400, 400)).save(
            f"./product-images/{new_name}-cover.png"
        )

        print(f"- {new_name}.png, {new_name}-cover.png {url}")

    except Exception as e:
        print(f"Failed to process image from {url}: {e}")


for i, url in enumerate(urls):
    overlayImages(url, i)
