#!/usr/bin/env python3
"""
Replace unreal.png with trasix.png in Illustration-2.json
"""
import json
import base64
import shutil
from datetime import datetime
from PIL import Image

def replace_unreal_with_trasix():
    """Replace the unreal.png logo with trasix.png"""

    animation_file = "documents/Illustration-2.json"
    trasix_file = "trasix.png"

    # Backup
    backup = f'{animation_file}.backup_replace_{datetime.now().strftime("%Y%m%d_%H%M%S")}'
    shutil.copy2(animation_file, backup)
    print(f"[OK] Backup created: {backup}")

    # Get actual image dimensions
    img = Image.open(trasix_file)
    width, height = img.size
    print(f"[OK] Trasix image size: {width}x{height}")

    # Encode image
    with open(trasix_file, 'rb') as f:
        image_data = f.read()
    base64_data = base64.b64encode(image_data).decode('utf-8')
    print(f"[OK] Encoded trasix.png to base64")

    # Load animation
    with open(animation_file, 'r', encoding='utf-8') as f:
        data = json.load(f)

    # Find and replace image_0 asset (unreal.png)
    for asset in data['assets']:
        if asset.get('id') == 'image_0':
            asset['w'] = width
            asset['h'] = height
            asset['p'] = f"data:image/png;base64,{base64_data}"
            print(f"[OK] Replaced image_0 asset with trasix.png")
            break

    # Rename the layer from unreal.png to trasix.png
    for layer in data['layers']:
        if layer.get('nm') == 'unreal.png':
            layer['nm'] = 'trasix.png'
            print(f"[OK] Renamed layer to 'trasix.png'")
            break

    # Remove the broken trasix layer we added earlier
    data['layers'] = [l for l in data['layers'] if l.get('refId') != 'image_3']
    print(f"[OK] Removed duplicate trasix layer")

    # Remove image_3 asset
    data['assets'] = [a for a in data['assets'] if a.get('id') != 'image_3']
    print(f"[OK] Removed image_3 asset")

    # Save
    with open(animation_file, 'w', encoding='utf-8') as f:
        json.dump(data, f, separators=(',', ':'))

    print(f"\n[OK] SUCCESS!")
    print(f"  - Replaced unreal.png with trasix.png")
    print(f"  - Position: (1075.5, 514)")
    print(f"  - Animation frames: 5-122")
    print(f"  - Total assets: {len(data['assets'])}")
    print(f"  - Total layers: {len(data['layers'])}")
    print(f"\nReload the page to see your trasix logo!")

if __name__ == "__main__":
    replace_unreal_with_trasix()
