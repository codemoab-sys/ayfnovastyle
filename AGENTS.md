# AGENTS.md

## Quick start

- **Entry point**: `index.php` — custom autoloader (lowercases first dir segment: `App\Controllers\Foo` → `app/controllers/Foo.php`), all routes defined inline with `{slug}`/`{id}` patterns.
- **Server**: Apache with rewrite (`.htaccess` → all non-file requests to `index.php`). Run via Laragon or any PHP/Apache stack.
- **DB**: MySQL/MariaDB via PDO singleton (`app/core/Database.php`). Constants in `config/database.php`.
- **No Composer, no npm, no tests, no linter, no CI**.

## Two systems in one project

| System | Route prefix | DB tables | Admin panel | Purpose |
|--------|-------------|-----------|-------------|---------|
| Original (Drofar) | `/` `/admin/` | `familias`, `marcas`, `productos`, etc. | `/admin` | Medical supply catalog |
| AYF Novastyle | `/ayf` `/ayf-admin/` | `ayf_*` (in `catalogobd` DB) | `/ayf-admin` | Shoes/clothing store |

## AYF System (zapatillas/ropa)

- **DB**: `catalogobd` — tables: `ayf_categorias`, `ayf_marcas`, `ayf_productos`, `ayf_producto_imagenes`, `ayf_banners`, `ayf_usuarios`, `ayf_configuracion`.
- **Migration**: `sql/ayf_migracion.sql` (creates DB, all tables, seed data).
- **"familia" → "categoria"**: renamed throughout the AYF system.
- **Admin config**: `/ayf-admin/configuracion` — edit logo, site name, WhatsApp, social links, contact info (stored in `ayf_configuracion` table).
- **Product fields for shoes/clothing**: `nombre`, `codigo`, `descripcion`, `material`, `genero`, `tallas`, `colores`, `precio`, `stock`, `imagen_principal`, `video`, `destacado`, `nuevo`.
- **Controllers**: `AyfCatalogController` (frontend), `AyfAdminController` (admin CRUD + config).
- **Models**: `AyfCategoria`, `AyfMarca`, `AyfProducto`, `AyfProductoImagen`, `AyfBanner`, `AyfUsuario`, `AyfConfiguracion`.
- **Views**: `views/catalogo/ayf_*.php` (frontend), `views/admin/ayf_*.php` (admin).

## Directory layout

```
config/database.php         # DB creds, BASE_URL, site info
app/
  core/                     # Router, Controller, Model, Database (custom MVC)
  controllers/              # + AyfCatalogController, AyfAdminController
  models/                   # + Ayf* models (ayf_ tables)
  views/
    catalogo/               # ayf_layout, ayf_index, ayf_categoria, ayf_detalle, ayf_search, ayf_search_results
    admin/                  # ayf_layout, ayf_login, ayf_dashboard, ayf_categorias, ayf_marcas, ayf_productos, ayf_producto_form, ayf_banners, ayf_banner_form, ayf_usuarios, ayf_usuario_form, ayf_configuracion
public/
  uploads/                  # File uploads destination
  css/, js/                 # catalog.css / admin.css, catalog.js / admin.js
sql/                        # ayf_migracion.sql (new system), migracion.sql + complete.sql (old)
```

## Framework quirks

- **Views** use `extract($data)` in `Controller::render()` — data keys become local variables.
- **Model** base class (`app/core/Model.php`) auto-derives table from `$this->table`. Has `all`, `find`, `where`, `create`, `update`, `delete`, `query`, `queryFirst`.
- **Router** only supports `GET`/`POST`, exact URL matching via regex conversion of `{param}`.
- **Base URL** computed dynamically from server vars; `redirect()` uses `BASE_URL + path`.
- **Upload helper** (`Controller::uploadFile`) saves to `public/uploads/{folder}/` and returns relative path `public/uploads/{folder}/filename`.
- **JS search**: `catalog.js` uses `AYF_MODE` var (set in `ayf_layout.php`) to switch API endpoints between `/api/buscar` and `/ayf/api/buscar`.

## Admin access

- Original: `/admin/login` — `usuarios` table.
- AYF: `/ayf-admin/login` — `ayf_usuarios` table.
- Default user: `admin@ayfnovastyle.com` / password hash from migration SQL.

## Credentials & env

- Database credentials are **hardcoded** in `config/database.php` — uses `database.local.php` if exists, falls back to `database.example.php`.
- `config/database.local.php` is gitignored. **Do not commit** production creds.
- WhatsApp, social links, contact info for AYF are editable via admin panel (`ayf_configuracion` table), not hardcoded.
