#!/usr/bin/env python3
"""
Add trasix.png logo to Illustration-2.json animation
"""
import json
import base64
import shutil
from datetime import datetime
from pathlib import Path

def encode_image_to_base64(image_path):
    """Encode an image file to base64 string."""
    with open(image_path, 'rb') as f:
        image_data = f.read()
    return base64.b64encode(image_data).decode('utf-8')

def add_trasix_logo(
    animation_file="documents/Illustration-2.json",
    image_file="trasix.png",
    position_x=621,  # Center X (animation width is 1243)
    position_y=300,  # Y position
    scale=60,  # Scale percentage
    start_frame=5,
    scale_end_frame=20,
    fade_out_frame=69,
    fade_out_end=70,
    parent_layer=1  # "Null 2" layer controls overall movement
):
    """
    Add trasix.png logo to the Lottie animation.

    Mimics the structure of existing image logos like unreal.png
    """

    # Create backup
    backup_file = animation_file + f".backup_{datetime.now().strftime('%Y%m%d_%H%M%S')}"
    shutil.copy2(animation_file, backup_file)
    print(f"[OK] Created backup: {backup_file}")

    # Check if image file exists
    if not Path(image_file).exists():
        print(f"[ERROR] Error: Image file '{image_file}' not found!")
        print(f"  Please place your trasix.png file in the current directory")
        return False

    # Load animation
    with open(animation_file, 'r', encoding='utf-8') as f:
        data = json.load(f)

    # Encode image to base64
    print(f"[OK] Encoding {image_file} to base64...")
    base64_data = encode_image_to_base64(image_file)

    # Get image dimensions (you may need to adjust these based on your actual image)
    # For now, using default values
    image_width = 240
    image_height = 240

    # Create new asset ID
    existing_image_assets = [a for a in data.get('assets', []) if 'w' in a and 'h' in a]
    new_asset_id = f"image_{len(existing_image_assets)}"

    # Add new asset
    new_asset = {
        "id": new_asset_id,
        "w": image_width,
        "h": image_height,
        "u": "",
        "p": f"data:image/png;base64,{base64_data}"
    }
    data['assets'].append(new_asset)
    print(f"[OK] Added asset with ID: {new_asset_id}")

    # Get the highest layer index
    max_ind = max([layer.get('ind', 0) for layer in data.get('layers', [])], default=0)

    # Create new image layer (similar to unreal.png at layer 8)
    new_layer = {
        "ddd": 0,
        "ind": max_ind + 1,
        "ty": 2,  # Image layer type
        "nm": "trasix.png",
        "refId": new_asset_id,
        "sr": 1,
        "ks": {
            "o": {  # Opacity animation
                "a": 1,
                "k": [
                    {
                        "i": {"x": [0], "y": [1]},
                        "o": {"x": [0.333], "y": [0]},
                        "t": start_frame,
                        "s": [0]
                    },
                    {
                        "i": {"x": [0.833], "y": [1]},
                        "o": {"x": [0.333], "y": [0]},
                        "t": scale_end_frame,
                        "s": [100]
                    },
                    {
                        "i": {"x": [0.833], "y": [0.833]},
                        "o": {"x": [0.167], "y": [0.167]},
                        "t": fade_out_frame,
                        "s": [100]
                    },
                    {
                        "t": fade_out_end,
                        "s": [0]
                    }
                ],
                "ix": 11
            },
            "r": {"a": 0, "k": 0, "ix": 10},  # Rotation
            "p": {  # Position
                "a": 0,
                "k": [position_x, position_y, 0],
                "ix": 2,
                "l": 2
            },
            "a": {"a": 0, "k": [0, 0, 0], "ix": 1, "l": 2},  # Anchor
            "s": {  # Scale animation
                "a": 1,
                "k": [
                    {
                        "i": {"x": [0, 0, 0.667], "y": [1, 1, 1]},
                        "o": {"x": [0.333, 0.333, 0.333], "y": [0, 0, 0]},
                        "t": start_frame,
                        "s": [0, 0, 100]
                    },
                    {
                        "t": scale_end_frame,
                        "s": [scale, scale, 100]
                    }
                ],
                "ix": 6,
                "l": 2
            }
        },
        "ao": 0,
        "ip": start_frame,
        "op": data.get('op', 117) + 5,  # Out point
        "st": 0,
        "bm": 0,
        "parent": parent_layer  # Parent to "Null 2" layer
    }

    # Add layer to the animation
    # Insert it near other image layers (after layer 8 for example)
    insert_position = 9  # After unreal.png layer
    data['layers'].insert(insert_position, new_layer)

    print(f"[OK] Added image layer 'trasix.png' at position {insert_position}")

    # Save modified animation
    with open(animation_file, 'w', encoding='utf-8') as f:
        json.dump(data, f, separators=(',', ':'))

    print(f"\n[OK] Success! Modified animation saved to: {animation_file}")
    print(f"  Total assets: {len(data['assets'])}")
    print(f"  Total layers: {len(data['layers'])}")
    print(f"\nAnimation settings:")
    print(f"  Position: ({position_x}, {position_y})")
    print(f"  Scale: {scale}%")
    print(f"  Animation: frames {start_frame}-{scale_end_frame} (scale in)")
    print(f"  Fade out: frames {fade_out_frame}-{fade_out_end}")
    print(f"  Parent layer: {parent_layer} (Null 2)")

    return True

if __name__ == "__main__":
    # Add trasix.png logo with default settings
    success = add_trasix_logo()

    if success:
        print("\n[OK] Done! Reload the page to see your trasix.png logo in the animation.")
    else:
        print("\n[ERROR] Failed to add logo. Please check the error messages above.")
