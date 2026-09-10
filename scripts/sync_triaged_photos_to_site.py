from pathlib import Path
import shutil

project_root = Path(r"C:\Users\erwan\OneDrive\Bureau\REFONTESITE")
source_dir = Path(r"C:\Users\erwan\Downloads\PHOTOS TRIéS")

# Map each existing public site image path to a selected photo from PHOTOS TRIéS.
# These are photo examples chosen to match the site’s current visual themes.
site_image_map = {
    # Carousel images
    Path("public/images/carousel/gyathursan-mine-5523376_1920.jpg"): "hse_dji_0001.jpg",
    Path("public/images/carousel/pexels-gunshe-5125104.jpg"): "hse_dji_0004.jpg",
    Path("public/images/carousel/shibang-mechanical-2653706_1920.jpg"): "usine_0001.jpg",
    Path("public/images/carousel/tyna_janoch-excavator-2781676_1920.jpg"): "usine_0002.jpg",
    Path("public/images/carousel/tyna_janoch-mine-2781686_1920.jpg"): "hse_dji_0011.jpg",

    # Header / masthead images
    Path("public/images/headers/camion-benne-mine-fosse-exploitation.jpeg"): "usine_0003.jpg",
    Path("public/images/headers/ceremonie-communaute-locale-terrain-rural.jpeg"): "kao_01.jpg",
    Path("public/images/headers/coulee-or-fusion-creuset-metallurgie.jpeg"): "usine_0007.jpg",
    Path("public/images/headers/equipe-inspection-site-mine-drapeau-securite.jpeg"): "hse_dji_0050.jpg",
    Path("public/images/headers/installation-broyage-minerai-crepuscule.jpeg"): "kao_02.jpg",
    Path("public/images/headers/route-bitumee-panneau-signalisation-projet-ebm.jpeg"): "hse_dji_0008.jpg",
    Path("public/images/headers/soudeurs-reparation-equipement-minier-atelier.jpeg"): "usine_0012.jpg",
    Path("public/images/headers/techniciens-installation-pipeline-eau-mine.jpeg"): "usine_0001.jpg",
    Path("public/images/headers/usine-traitement-or-illuminee-nuit.jpeg"): "usine_0015.jpg",

    # Mining / page imagery used by the app layout and pages
    Path("public/images/mining/gold-processing-01.jpg"): "usine_0004.jpg",
    Path("public/images/mining/karma-01.jpg"): "usine_0016.jpg",
    Path("public/images/mining/karma-02.jpg"): "hse_dji_0038.jpg",
    Path("public/images/mining/karma-03.jpg"): "hse_dji_0050.jpg",
    Path("public/images/mining/karma-04.jpg"): "kao_02.jpg",
    Path("public/images/mining/karma-05.jpg"): "hse_dji_0035.jpg",
    Path("public/images/mining/mining-environment-01.jpg"): "kao_03.jpg",
    Path("public/images/mining/mining-equipment-01.jpg"): "usine_0008.jpg",
    Path("public/images/mining/mining-site-aerial-01.jpg"): "hse_dji_0028.jpg",
    Path("public/images/mining/mining-workers-01.jpg"): "hse_dji_0033.jpg",

    # Resources and photo media folk used in site pages
    Path("public/images/resources/resources-reserves-2025.jpg"): "kao_03.jpg",
}

if not source_dir.exists():
    raise SystemExit(f"Source folder not found: {source_dir}")

for target, source_name in site_image_map.items():
    source_path = source_dir / source_name
    dest_path = project_root / target
    if not source_path.exists():
        print(f"Missing source photo: {source_path}")
        continue

    dest_path.parent.mkdir(parents=True, exist_ok=True)
    shutil.copy2(source_path, dest_path)
    print(f"Copied {source_name} -> {target}")

print("\nDone. Site image files now sourced from the triaged PHOTOS TRIéS folder.")
