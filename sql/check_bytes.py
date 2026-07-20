# -*- coding: utf-8 -*-
"""Check actual bytes in the SQL file for accented characters"""
with open('C:/laragon/www/catalogopdaweb/sql/complete.sql', 'rb') as f:
    content = f.read()

# Find 'Antis' in the raw bytes
idx = content.find(b'Antis')
if idx >= 0:
    chunk = content[idx:idx+30]
    print(f'Raw bytes around Antis: {chunk.hex()}')
    print(f'Expected C3A9 for é, byte at idx+5: {content[idx+5]:02x}')
    print(f'Expected C3A9 for é, byte at idx+6: {content[idx+6]:02x}')

# Also check the families INSERT from the Python-generated part
idx2 = content.find(b'INSERT INTO familias')
if idx2 >= 0:
    chunk2 = content[idx2:idx2+200]
    print(f'\nFamilias INSERT bytes (first 200): {chunk2.decode("utf-8", errors="replace")}')

# Find the first Product INSERT
idx3 = content.find(b'INSERT INTO productos')
if idx3 >= 0:
    chunk3 = content[idx3:idx3+300]
    print(f'\nFirst Product INSERT bytes (first 300): {chunk3.decode("utf-8", errors="replace")}')
