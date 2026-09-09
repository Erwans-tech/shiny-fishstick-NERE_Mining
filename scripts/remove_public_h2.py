from pathlib import Path
import re

files = [p for p in Path('resources/views').rglob('*.blade.php') if 'admin' not in str(p)]
pattern = re.compile(r'<h2[^>]*>.*?</h2>', re.S)
changed = 0

for p in files:
    txt = p.read_text(encoding='utf-8')
    new = pattern.sub('', txt)
    if new != txt:
        p.write_text(new, encoding='utf-8')
        changed += 1

print(f'Removed h2 blocks from {changed} public Blade files.')
