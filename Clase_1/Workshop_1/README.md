Workshop 1 - Mostrar fecha y hora

Archivos:
- `time.php` : muestra la fecha y hora actuales usando PHP.
- `time.html`: un archivo HTML estático (sin JavaScript). Contiene un marcador donde iría la hora.

Instrucciones de prueba

1) Usando el servidor integrado de PHP (recomendado para probar rápido):

```bash
cd "Workshop 1"
php -S localhost:8080
```

Luego abre en el navegador:
- `http://localhost:8080/time.php`  (se genera la hora en el servidor)
- `http://localhost:8080/time.html` (archivo estático; no muestra hora por sí mismo)

2) Usando Apache o XAMPP:
- Copia la carpeta `Workshop 1` a la raíz de tu servidor (por ejemplo en XAMPP `htdocs/Workshop 1`).
- Accede a `http://localhost/Workshop%201/time.php` y `http://localhost/Workshop%201/time.html`.

Qué observar
- `time.php` es generado por el servidor; cada recarga solicita al servidor una nueva hora.
- `time.html` es un archivo estático: el contenido no cambia cuando recargas (sin JavaScript ni procesamiento del servidor).

Sugerencia para actividad extra
- Si quieres ver la hora actual en el HTML sin JavaScript, crea un archivo `.shtml` con SSI o usa un `.php` renombrado.

Subir al repositorio
1) Añade, confirma y sube la carpeta `Workshop 1` al repositorio:

```bash
git add "Workshop 1"
git commit -m "Workshop 1: time.php y time.html para mostrar fecha y hora"
git push origin main
```

2) Comparte la URL de tu repositorio (por ejemplo `https://github.com/<tu_usuario>/php-course`).
