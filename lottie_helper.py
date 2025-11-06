#!/usr/bin/env python3
"""
Helper script to analyze and modify Lottie JSON animation files.
"""
import json
import sys

def analyze_lottie(filepath):
    """Analyze the structure of a Lottie JSON file."""
    with open(filepath, 'r', encoding='utf-8') as f:
        data = json.load(f)

    print(f"=== Lottie Animation Analysis ===")
    print(f"File: {filepath}")
    print(f"Version: {data.get('v', 'Unknown')}")
    print(f"Frame Rate: {data.get('fr', 'Unknown')} fps")
    print(f"In Point: {data.get('ip', 'Unknown')}")
    print(f"Out Point: {data.get('op', 'Unknown')}")
    print(f"Width: {data.get('w', 'Unknown')}px")
    print(f"Height: {data.get('h', 'Unknown')}px")
    print(f"Name: {data.get('nm', 'Unknown')}")
    print(f"\n=== Layers ({len(data.get('layers', []))}) ===")

    for idx, layer in enumerate(data.get('layers', [])):
        layer_type_map = {
            0: 'Precomp',
            1: 'Solid',
            2: 'Image',
            3: 'Null',
            4: 'Shape',
            5: 'Text'
        }
        layer_type = layer_type_map.get(layer.get('ty', -1), 'Unknown')
        print(f"  Layer {idx}: '{layer.get('nm', 'Unnamed')}' - Type: {layer_type} (ty={layer.get('ty')})")
        if 'parent' in layer:
            print(f"    -> Parent: Layer {layer['parent']}")

    print(f"\n=== Assets ({len(data.get('assets', []))}) ===")
    for idx, asset in enumerate(data.get('assets', [])):
        print(f"  Asset {idx}: ID={asset.get('id', 'Unknown')}")

    return data

def add_simple_shape_layer(data, shape_name, color, position, size=100, animate=False):
    """
    Add a simple shape layer to the Lottie animation.

    Args:
        data: Lottie JSON data dict
        shape_name: Name for the new layer
        color: RGB color as list [r, g, b] (0-1 range)
        position: [x, y] position
        size: Size of the shape
        animate: Whether to add simple scale animation
    """
    # Get the highest index to add new layer at the end
    max_ind = max([layer.get('ind', 0) for layer in data.get('layers', [])], default=0)

    # Create a simple circle shape layer
    new_layer = {
        "ddd": 0,
        "ind": max_ind + 1,
        "ty": 4,  # Shape layer
        "nm": shape_name,
        "sr": 1,
        "ks": {
            "o": {"a": 0, "k": 100, "ix": 11},
            "r": {"a": 0, "k": 0, "ix": 10},
            "p": {"a": 0, "k": position + [0], "ix": 2, "l": 2},
            "a": {"a": 0, "k": [0, 0, 0], "ix": 1, "l": 2},
            "s": {
                "a": 1 if animate else 0,
                "k": [
                    {
                        "i": {"x": [0.667, 0.667, 0.667], "y": [1, 1, 1]},
                        "o": {"x": [0.333, 0.333, 0.333], "y": [0, 0, 0]},
                        "t": 0,
                        "s": [0, 0, 100]
                    },
                    {"t": 20, "s": [100, 100, 100]}
                ] if animate else [100, 100, 100],
                "ix": 6,
                "l": 2
            }
        },
        "ao": 0,
        "shapes": [
            {
                "ty": "gr",
                "it": [
                    {
                        "ind": 0,
                        "ty": "el",  # Ellipse
                        "nm": f"{shape_name} Path",
                        "d": 1,
                        "s": {"a": 0, "k": [size, size], "ix": 2},
                        "p": {"a": 0, "k": [0, 0], "ix": 3}
                    },
                    {
                        "ty": "fl",  # Fill
                        "c": {"a": 0, "k": color + [1], "ix": 4},
                        "o": {"a": 0, "k": 100, "ix": 5},
                        "r": 1,
                        "bm": 0,
                        "nm": "Fill 1"
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
                "nm": shape_name,
                "np": 2,
                "cix": 2,
                "bm": 0,
                "ix": 1
            }
        ],
        "ip": 0,
        "op": data.get('op', 117),
        "st": 0,
        "bm": 0
    }

    # Add the layer to the beginning of the layers array (renders on top)
    data['layers'].insert(0, new_layer)
    return data

def save_lottie(data, output_filepath):
    """Save the modified Lottie JSON."""
    with open(output_filepath, 'w', encoding='utf-8') as f:
        json.dump(data, f, separators=(',', ':'))
    print(f"\nSaved to: {output_filepath}")

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Usage: python lottie_helper.py <lottie_file.json>")
        sys.exit(1)

    filepath = sys.argv[1]
    analyze_lottie(filepath)
