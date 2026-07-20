# -*- coding: utf-8 -*-
"""Fix the user INSERT in complete.sql"""
with open('C:/laragon/www/catalogopdaweb/sql/complete.sql', 'rb') as f:
    content = f.read()

# Find the problematic line and fix it
old = b"INSERT IGNORE INTO usuarios (nombre, email, password, rol, estado) VALUES\n('Administrador', 'admin@drofar.com', MD5('admin123'), 'admin', 1);"
new = b"INSERT IGNORE INTO usuarios (nombre, email, password, rol, estado) VALUES\n('Administrador', 'admin@drofar.com', MD5('admin123'), 'admin', 1);"

if old in content:
    print("User INSERT already correct")
else:
    # Find and fix the broken line
    idx = content.find(b"INSERT IGNORE INTO usuarios")
    if idx >= 0:
        end_idx = content.find(b";", idx)
        chunk = content[idx:end_idx+1]
        print(f"Found at {idx}: {chunk[:80]}")
        # The issue is probably single quotes in MD5 argument
        # Let's just replace the whole section
        new_content = content[:idx] + b"INSERT IGNORE INTO usuarios (nombre, email, password, rol, estado) VALUES\n('Administrador', 'admin@drofar.com', MD5('admin123'), 'admin', 1);\n" + content[end_idx+1:]
        with open('C:/laragon/www/catalogopdaweb/sql/complete.sql', 'wb') as f:
            f.write(new_content)
        print("Fixed!")
    else:
        print("Not found, maybe already fixed or missing")
