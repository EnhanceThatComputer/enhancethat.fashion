#!/usr/bin/env python3
"""
Fix trasix logo: remove red color and center it properly
"""
import json
import base64
import shutil
from datetime import datetime
from PIL import Image, ImageOps
import numpy as np

def process_trasix_logo():
    """Process trasix logo to match other logos style"""

    # Load the original image
    img = Image.open('trasix.png').convert('RGBA')
    print(f"[OK] Loaded trasix.png: {img.size}")

    # Convert to numpy array for processing
    data = np.array(img)

    # Get RGB and Alpha channels
    alpha = data[:, :, 3]

    # Convert all colored pixels to white, preserve transparency
    # Create white RGB channels
    white = np.ones_like(data[:, :, :3]) * 255

    # Combine white RGB with original alpha
    new_data = np.concatenate([white, alpha[:, :, np.newaxis]], axis=2)

    # Create new image
    processed = Image.fromarray(new_data.astype('uint8'), 'RGBA')

    # Optional: Add padding to center it better in a circle
    # Create a slightly larger canvas with the logo centered
    canvas_size = 200  # Larger canvas
    canvas = Image.new('RGBA', (canvas_size, canvas_size), (0, 0, 0, 0))

    # Calculate position to center the logo
    x = (canvas_size - img.width) // 2
    y = (canvas_size - img.height) // 2

    # Paste the processed logo onto canvas
    canvas.paste(processed, (x, y), processed)

    # Save processed image
    canvas.save('trasix_processed.png')
    print(f"[OK] Saved processed image: trasix_processed.png ({canvas_size}x{canvas_size})")

    # Now update the animation with the processed image
    animation_file = "documents/Illustration-2.json"

    # Backup
    backup = f'{animation_file}.backup_fix_{datetime.now().strftime("%Y%m%d_%H%M%S")}'
    shutil.copy2(animation_file, backup)
    print(f"[OK] Backup created: {backup}")

    # Encode processed image
    with open('trasix_processed.png', 'rb') as f:
        image_data = f.read()
    base64_data = base64.b64encode(image_data).decode('utf-8')

    # Load animation
    with open(animation_file, 'r', encoding='utf-8') as f:
        anim_data = json.load(f)

    # Update image_0 asset with processed image
    for asset in anim_data['assets']:
        if asset.get('id') == 'image_0':
            asset['w'] = canvas_size
            asset['h'] = canvas_size
            asset['p'] = f"data:image/png;base64,{base64_data}"
            print(f"[OK] Updated image_0 asset with processed trasix logo")
            break

    # Save animation
    with open(animation_file, 'w', encoding='utf-8') as f:
        json.dump(anim_data, f, separators=(',', ':'))

    print(f"\n[OK] SUCCESS!")
    print(f"  - Converted red to white")
    print(f"  - Centered logo in {canvas_size}x{canvas_size} canvas")
    print(f"  - Updated animation")
    print(f"\nReload the page to see the fixed trasix logo!")

if __name__ == "__main__":
    process_trasix_logo()
