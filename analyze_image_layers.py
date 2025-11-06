#!/usr/bin/env python3
"""
Analyze how image layers are structured in Lottie animation
"""
import json
import base64

def analyze_image_layers(filepath):
    """Find and analyze image layers and assets."""
    with open(filepath, 'r', encoding='utf-8') as f:
        data = json.load(f)

    print("=== Image Assets ===")
    assets = data.get('assets', [])
    for idx, asset in enumerate(assets):
        if 'w' in asset and 'h' in asset:  # Image asset
            print(f"\nAsset {idx}:")
            print(f"  ID: {asset.get('id', 'Unknown')}")
            print(f"  Width: {asset.get('w')}px")
            print(f"  Height: {asset.get('h')}px")
            print(f"  Path: {asset.get('p', 'N/A')}")
            print(f"  Directory: {asset.get('u', 'N/A')}")
            if asset.get('p', '').startswith('data:image'):
                print(f"  Type: Embedded (base64)")
            else:
                print(f"  Type: External file")

    print("\n=== Image Layers ===")
    layers = data.get('layers', [])
    for idx, layer in enumerate(layers):
        if layer.get('ty') == 2:  # Image layer
            print(f"\nLayer {idx}:")
            print(f"  Name: {layer.get('nm', 'Unnamed')}")
            print(f"  Index: {layer.get('ind')}")
            print(f"  References Asset ID: {layer.get('refId', 'N/A')}")

            # Get position/transform info
            ks = layer.get('ks', {})
            pos = ks.get('p', {})
            if 'k' in pos:
                print(f"  Position: {pos['k']}")

            scale = ks.get('s', {})
            if 'k' in scale:
                print(f"  Scale: {scale['k']}")

            opacity = ks.get('o', {})
            if 'k' in opacity:
                print(f"  Opacity: {opacity['k']}")

            print(f"  In Point: {layer.get('ip')}")
            print(f"  Out Point: {layer.get('op')}")

            # Check if it has parent
            if 'parent' in layer:
                print(f"  Parent Layer: {layer['parent']}")

    return data

if __name__ == "__main__":
    analyze_image_layers("documents/Illustration-2.json")
