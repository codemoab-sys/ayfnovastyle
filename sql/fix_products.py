# -*- coding: utf-8 -*-
"""Fix accented characters in product SQL data and append to complete.sql"""
import os

# Read the old data file that has products
old_path = 'C:/laragon/www/catalogopdaweb/sql/data_fixed.sql'
if not os.path.exists(old_path):
    old_path = 'C:/laragon/www/catalogopdaweb/sql/data.sql'

with open(old_path, 'rb') as f:
    raw = f.read()

# Decode with utf-8, replacing errors
text = raw.decode('utf-8', errors='replace')

# Find product INSERTs
lines = text.split('\n')
product_lines = []
in_products = False
for line in lines:
    stripped = line.strip()
    if stripped.startswith('INSERT INTO productos') or stripped.startswith('INSERT INTO produtos'):
        in_products = True
    if in_products:
        product_lines.append(line)

# Fix corrupted UTF-8 (common Windows cp1252 -> utf-8 issues)
fixes = {
    'Ã¡': '\u00e1',  # á
    'Ã©': '\u00e9',  # é
    'Ã\xad': '\u00ed',  # í
    'Ã³': '\u00f3',  # ó
    'Ãº': '\u00fa',  # ú
    'Ã±': '\u00f1',  # ñ
    'Ã¼': '\u00fc',  # ü
    'Ã\x81': '\u00c1',  # Á
    'Ã‰': '\u00c9',  # É
    'Ã\x8d': '\u00cd',  # Í
    'Ã“': '\u00d3',  # Ó
    'Ãš': '\u00da',  # Ú
    'Ã‘': '\u00d1',  # Ñ
    'Ãœ': '\u00dc',  # Ü
    'Â¡': '\u00a1',  # ¡
    'Â¿': '\u00bf',  # ¿
    'Â°': '\u00b0',  # °
}

fixed_text = '\n'.join(product_lines)
for wrong, correct in fixes.items():
    fixed_text = fixed_text.replace(wrong, correct)

# Fix table name
fixed_text = fixed_text.replace('INSERT INTO produtos', 'INSERT INTO productos')

count = fixed_text.count('INSERT INTO productos')
print(f'Product INSERT statements found: {count}')

# Remove lines that should not be in products section
cleaned_lines = []
skip_starts = ('TRUNCATE', 'USE ', 'SET NAMES', 'SET CHARACTER', 'SET FOREIGN',
               'SET @ant', 'SET @bio', 'SET @dre', 'SET @ent', 'SET @equ',
               'SET @inf', 'SET @iny', 'SET @lim', 'SET @mat', 'SET @vid',
               'SET @meda', 'SET @medb', 'SET @nut', 'SET @qui', 'SET @reh',
               'SET @res', 'SET @rop', 'SET @sol', 'SET @solv', 'SET @son',
               'SET @m3m', 'SET @alf', 'SET @alkf', 'SET @alkh', 'SET @bb',
               'SET @bp', 'SET @bio_s', 'SET @colo', 'SET @copp', 'SET @fav',
               'SET @fres', 'SET @gas', 'SET @gen', 'SET @hulk', 'SET @medx',
               'SET @medi', 'SET @nip', 'SET @onej', 'SET @pharm', 'SET @qro',
               'SET @qmp', 'SET @rg', 'SET @ries', 'SET @roker', 'SET @salv',
               'SET @sand', 'SET @sigma', 'SET @sony', 'SET @sup', 'SET @tc',
               'SET @tag', 'SET @veno', 'SET @west',
               'INSERT IGNORE', 'INSERT INTO marcas', 'INSERT INTO familias',
               '-- ============')

for line in cleaned_lines:
    stripped = line.strip()
    skip = False
    for s in skip_starts:
        if stripped.startswith(s):
            skip = True
            break
    if not skip:
        cleaned_lines.append(line)

# Actually let me just take a simpler approach: keep only lines that are part of INSERT statements
# or are empty, or are comments
final_lines = []
for line in fixed_text.split('\n'):
    stripped = line.strip()
    # Skip variable assignments, other INSERTs, truncates, etc.
    if stripped.startswith('SET @') or stripped.startswith('-- ') or stripped == '':
        continue
    if stripped.startswith('INSERT INTO productos') or stripped.startswith('(') or stripped.startswith('VALUES'):
        final_lines.append(line)

fixed_text = '\n'.join(final_lines)

# Append to complete.sql
complete_path = 'C:/laragon/www/catalogopdaweb/sql/complete.sql'
with open(complete_path, 'r+', encoding='utf-8') as f:
    content = f.read()
    if 'INSERT INTO productos' not in content:
        f.write('\n')
        f.write(fixed_text)
        print('Products appended successfully')
    else:
        print('Products already in file')

# Verify total line count
with open(complete_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()
print(f'Total lines in complete.sql: {len(lines)}')
print(f'Total INSERT INTO productos: {sum(1 for l in lines if "INSERT INTO productos" in l)}')
