# -*- coding: utf-8 -*-
with open('C:/laragon/www/catalogopdaweb/sql/complete.sql', 'a', encoding='utf-8') as f:
    f.write('\n\nINSERT IGNORE INTO usuarios (nombre, email, password, rol, estado) VALUES\n')
    f.write("('Administrador', 'admin@drofar.com', MD5('admin123'), 'admin', 1);\n")
print('Admin user added')
