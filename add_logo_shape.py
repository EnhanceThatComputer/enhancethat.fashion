#!/usr/bin/env python3
"""
Script to add a new logo shape to Illustration-2.json
"""
import json
import os
import shutil
from datetime import datetime

def add_logo_to_animation(
    input_file,
    output_file,
    logo_name="New Logo",
    position_x=621,  # Center of 1243px width
    position_y=720,  # Center of 1440px height
    size=120,
    color_r=0.337,  # Green color matching your brand
    color_g=0.729,
    color_b=0.380,
    shape_type="circle",  # circle, rectangle, or custom
    animate_in=True,
    start_frame=0,
    end_frame=20
):
    """
    Add a new logo shape to the Lottie animation.

    Args:
        input_file: Path to input JSON
        output_file: Path to output JSON
        logo_name: Name for the layer
        position_x, position_y: Position coordinates
        size: Size of the shape
        color_r, color_g, color_b: RGB color (0-1 range)
        shape_type: 'circle' or 'rectangle'
        animate_in: Whether to animate the appearance
        start_frame: Frame to start animation
        end_frame: Frame to end animation
    """

    # Backup original file
    backup_file = input_file + f".backup_{datetime.now().strftime('%Y%m%d_%H%M%S')}"
    shutil.copy2(input_file, backup_file)
    print(f"Created backup: {backup_file}")

    # Load the animation
    with open(input_file, 'r', encoding='utf-8') as f:
        data = json.load(f)

    # Get the highest layer index
    max_ind = max([layer.get('ind', 0) for layer in data.get('layers', [])], default=0)

    # Create shape based on type
    if shape_type == "circle":
        shape_data = {
            "ind": 0,
            "ty": "el",  # Ellipse
            "nm": f"{logo_name} Path",
            "d": 1,
            "s": {"a": 0, "k": [size, size], "ix": 2},
            "p": {"a": 0, "k": [0, 0], "ix": 3}
        }
    elif shape_type == "rectangle":
        shape_data = {
            "ty": "rc",  # Rectangle
            "d": 1,
            "s": {"a": 0, "k": [size, size], "ix": 2},
            "p": {"a": 0, "k": [0, 0], "ix": 3},
            "r": {"a": 0, "k": 0, "ix": 4},
            "nm": f"{logo_name} Path"
        }
    else:
        raise ValueError("shape_type must be 'circle' or 'rectangle'")

    # Create the new layer
    new_layer = {
        "ddd": 0,
        "ind": max_ind + 1,
        "ty": 4,  # Shape layer
        "nm": logo_name,
        "sr": 1,
        "ks": {
            "o": {
                "a": 1 if animate_in else 0,
                "k": [
                    {"i": {"x": [0.833], "y": [0.833]}, "o": {"x": [0.167], "y": [0.167]}, "t": start_frame, "s": [0]},
                    {"t": end_frame, "s": [100]}
                ] if animate_in else 100,
                "ix": 11
            },
            "r": {"a": 0, "k": 0, "ix": 10},
            "p": {"a": 0, "k": [position_x, position_y, 0], "ix": 2, "l": 2},
            "a": {"a": 0, "k": [0, 0, 0], "ix": 1, "l": 2},
            "s": {
                "a": 1 if animate_in else 0,
                "k": [
                    {"i": {"x": [0.667, 0.667, 0.667], "y": [1, 1, 1]},
                     "o": {"x": [0.333, 0.333, 0.333], "y": [0, 0, 0]},
                     "t": start_frame, "s": [0, 0, 100]},
                    {"t": end_frame, "s": [100, 100, 100]}
                ] if animate_in else [100, 100, 100],
                "ix": 6,
                "l": 2
            }
        },
        "ao": 0,
        "shapes": [
            {
                "ty": "gr",
                "it": [
                    shape_data,
                    {
                        "ty": "fl",  # Fill
                        "c": {"a": 0, "k": [color_r, color_g, color_b, 1], "ix": 4},
                        "o": {"a": 0, "k": 100, "ix": 5},
                        "r": 1,
                        "bm": 0,
                        "nm": "Fill 1",
                        "mn": "ADBE Vector Graphic - Fill"
                    },
                    {
                        "ty": "tr",
                        "p": {"a": 0, "k": [0, 0], "ix": 2},
                        "a": {"a": 0, "k": [0, 0], "ix": 1},
                        "s": {"a": 0, "k": [100, 100], "ix": 3},
                        "r": {"a": 0, "k": 0, "ix": 6},
                        "o": {"a": 0, "k": 100, "ix": 7},
                        "sk": {"a": 0, "k": 0, "ix": 4},
                        "sa": {"a": 0, "k": 0, "ix": 5},
                        "nm": "Transform"
                    }
                ],
                "nm": logo_name,
                "np": 2,
                "cix": 2,
                "bm": 0,
                "ix": 1,
                "mn": "ADBE Vector Group"
            }
        ],
        "ip": start_frame,
        "op": data.get('op', 117),
        "st": 0,
        "bm": 0
    }

    # Add the layer at the top (renders first/on top)
    data['layers'].insert(0, new_layer)

    # Save the modified animation
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(data, f, separators=(',', ':'))

    print(f"\nSuccess! Added '{logo_name}' layer")
    print(f"Saved to: {output_file}")
    print(f"Total layers: {len(data['layers'])}")
    print(f"\nSettings:")
    print(f"  Position: ({position_x}, {position_y})")
    print(f"  Size: {size}px")
    print(f"  Color: RGB({color_r}, {color_g}, {color_b})")
    print(f"  Shape: {shape_type}")
    print(f"  Animated: {animate_in}")
    if animate_in:
        print(f"  Animation: frames {start_frame}-{end_frame}")

if __name__ == "__main__":
    # Example usage - add a green circle logo
    add_logo_to_animation(
        input_file="documents/Illustration-2.json",
        output_file="documents/Illustration-2.json",
        logo_name="Custom Logo Shape",
        position_x=621,  # Center
        position_y=720,  # Center
        size=150,
        color_r=0.337,  # Brand green
        color_g=0.729,
        color_b=0.380,
        shape_type="circle",
        animate_in=True,
        start_frame=10,
        end_frame=30
    )
