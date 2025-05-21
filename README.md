# Prueba Técnica - Laravel

Este proyecto es una prueba técnica construida con el framework **Laravel** que incluye generación masiva de usuarios, perfiles, historial de inicio de sesión, envío de correos a través de un `Job` personalizado y ejecución de pruebas unitarias.

---

##  Requisitos del Sistema

- **PHP** >= 8.4.7  
- **Laravel** = 11.45.0  
- **Composer**  = 2.8.9
- **MySQL** 


---

##  Instalación del Proyecto

```bash
# 1. Clona el repositorio
git clone https://github.com/Devmetrio/PruebaTecnica_GermanAmes.git
cd PruebaTecnica_GermanAmes

# 2. Instala las dependencias PHP
composer install


```

Luego edita el archivo `.env` para establecer tus credenciales de base de datos y correo (que se mantiene como log).

---

##  Ejecutar Migraciones y Seeders

Este comando ejecutará todas las migraciones y poblará la base de datos con usuarios, perfiles y registros de historial:

```bash
php artisan migrate --seed
```

---

##  Enviar Correos de Bienvenida

El proyecto incluye un comando Artisan que lanza Jobs para el envío de correos de bienvenida a 500 usuarios:

```bash
php artisan emails:send-welcome 
```

- `{count=500}`: se puede agregar tambien esto al final del comando para enviar otro numero especifico de usuarios a lo que se deseas enviar (opcional, por defecto es 500).

---

##  Ejecutar el Worker de Cola

Para procesar los correos (o cualquier Job encolado), debes iniciar el worker con:

```bash
php artisan queue:work
```

Puedes abrir otra terminal y dejar este comando corriendo para procesar los Jobs.

---

## ✅ Ejecutar Pruebas Unitarias

El proyecto incluye pruebas unitarias. Para ejecutarlas:

```bash
php artisan test
```


---

## 📄 Notas

- Asegúrate de configurar correctamente en `.env` si deseas cargar los migrations y seeders.
---

##  Autor

**German Ames Medina**  
Repositorio para evaluación técnica en Laravel.