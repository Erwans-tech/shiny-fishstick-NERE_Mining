from PIL import Image, ImageOps, ImageEnhance, ImageFilter
from pathlib import Path

source_dir = Path(r"C:\Users\erwan\Downloads\to_upscale")
output_dir = source_dir / "upscaled_enhanced"
output_dir.mkdir(parents=True, exist_ok=True)

allowed = {".jpg", ".jpeg", ".png", ".webp", ".bmp"}

for image_path in sorted(source_dir.iterdir()):
    if not image_path.is_file() or image_path.suffix.lower() not in allowed:
        continue

    try:
        with Image.open(image_path) as img:
            img = ImageOps.exif_transpose(img)
            img = img.convert("RGB")

            # Keep output focused on natural quality and avoid creating absurdly huge images.
            width, height = img.size
            scale = 2.0
            max_dim = 3600
            if max(width, height) > 1800:
                scale = 1.5
            if max(width, height) > 2600:
                scale = 1.25

            target_size = (int(width * scale), int(height * scale))
            # Safeguard against huge files
            if target_size[0] > max_dim or target_size[1] > max_dim:
                factor = max(target_size[0] / max_dim, target_size[1] / max_dim)
                target_size = (int(target_size[0] / factor), int(target_size[1] / factor))

            upscaled = img.resize(target_size, Image.Resampling.LANCZOS)

            # Optional denoise before enhancing detail.
            denoised = upscaled.filter(ImageFilter.MedianFilter(size=3))

            # Color/contrast/lighting correction.
            denoised = ImageOps.autocontrast(denoised)
            denoised = ImageEnhance.Color(denoised).enhance(1.04)
            denoised = ImageEnhance.Contrast(denoised).enhance(1.12)
            denoised = ImageEnhance.Sharpness(denoised).enhance(1.40)

            # Produce a polished detail pass.
            denoised = denoised.filter(ImageFilter.UnsharpMask(radius=1, percent=130, threshold=2))

            # Preserve image type semantics.
            out_name = image_path.stem + "_enhanced" + (".jpg" if image_path.suffix.lower() in {".jpg", ".jpeg"} else ".jpg")
            output_path = output_dir / out_name
            denoised.save(output_path, "JPEG", quality=95, optimize=True)
            print(f"Processed: {image_path.name} -> {output_path.name}")
    except Exception as exc:
        print(f"FAILED: {image_path.name}: {exc}")

print(f"Done. Enhanced images saved in: {output_dir}")
