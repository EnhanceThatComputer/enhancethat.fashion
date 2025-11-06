#!/usr/bin/env python3
"""
Make trasix logo green to match other logos
"""
import json
import base64
import shutil
from datetime import datetime
from PIL import Image
import numpy as np

def make_trasix_green():
    """Make trasix the same green as other logos"""

    # Load the original image
    img = Image.open('trasix.png').convert('RGBA')
    print(f"[OK] Loaded trasix.png: {img.size}")

    # Make it 20% bigger
    new_size = int(img.width * 1.2), int(img.height * 1.2)
    img_resized = img.resize(new_size, Image.Resampling.LANCZOS)
    print(f"[OK] Resized to: {img_resized.size}")

    # Convert to numpy array for processing
    data = np.array(img_resized)

    # Get Alpha channel
    alpha = data[:, :, 3]

    # Create green RGB channels with the exact color from other logos
    # RGB(23, 72, 12) = #17480c
    green_color = np.array([23, 72, 12], dtype=np.uint8)
    green = np.ones_like(data[:, :, :3]) * green_color

    # Combine green RGB with original alpha
    new_data = np.concatenate([green, alpha[:, :, np.newaxis]], axis=2)

    # Create new image
    processed = Image.fromarray(new_data.astype('uint8'), 'RGBA')

    # Add padding to center it better in a circle
    canvas_size = 240  # Larger canvas for bigger logo
    canvas = Image.new('RGBA', (canvas_size, canvas_size), (0, 0, 0, 0))

    # Calculate position to center the logo
    x = (canvas_size - processed.width) // 2
    y = (canvas_size - processed.height) // 2

    # Paste the processed logo onto canvas
    canvas.paste(processed, (x, y), processed)

    # Save processed image
    canvas.save('trasix_processed.png')
    print(f"[OK] Saved processed image: trasix_processed.png ({canvas_size}x{canvas_size})")
    print(f"[OK] Color: RGB(23, 72, 12) = #17480c (dark green)")

    # Now update the animation with the processed image
    animation_file = "documents/Illustration-2.json"

    # Backup
    backup = f'{animation_file}.backup_green_{datetime.now().strftime("%Y%m%d_%H%M%S")}'
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
            print(f"[OK] Updated image_0 asset with green trasix logo")
            break

    # Save animation
    with open(animation_file, 'w', encoding='utf-8') as f:
        json.dump(anim_data, f, separators=(',', ':'))

    print(f"\n[OK] SUCCESS!")
    print(f"  - Made logo 20% bigger")
    print(f"  - Converted to dark green RGB(23, 72, 12)")
    print(f"  - Matches other logos in animation")
    print(f"  - Centered logo in {canvas_size}x{canvas_size} canvas")
    print(f"\nReload the page to see the green trasix logo!")

if __name__ == "__main__":
    make_trasix_green()
