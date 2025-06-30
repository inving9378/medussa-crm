# Medussa-CRM

Sistema de gestión para ISP Medussa.

## Estructura del proyecto

- `.github/workflows/deploy.yml` - Workflow de GitHub Actions.
- `install.sh` - Script de instalación modular.
- `scripts/` - Scripts de instalación de servicios.
- `database/migrations/` - Migraciones de Base de Datos.
- `app/Models/` - Modelos Eloquent de Laravel.
- `app/Http/Controllers/API/` - Controladores API.
- `routes/api.php` - Rutas REST.
- `public/` - Assets públicos.
- `ai_local/` - Asistente IA local (Flask).
- `.env.example` - Variables de entorno de ejemplo.
- `composer.json` - Dependencias PHP.
- `package.json` - Dependencias JS.
- `.gitignore` - Archivos ignorados.

## Instalación

1. Clona el repo.
2. Copia `.env.example` a `.env`.
3. Ejecuta `install.sh`.
4. Sube `main` a GitHub.

