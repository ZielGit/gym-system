# Sistema de Control de Gimnasio

## Genera una key para JWT

### Generar con OpenSSL (en terminal Linux/Mac):

```bash
openssl rand -base64 32
```

### Generar con PHP
Puedes usar el siguiente script PHP para generar una clave secreta:

```PHP
<?php

echo base64_encode(random_bytes(32));
```

## Ejecutar las migraciones

```bash
php migrations/migrate.php
```

## Iniciar el servidor PHP

```bash
php -S localhost:8080 -t .
```

## Credenciales

```
usuario: admin
password: admin12345
```