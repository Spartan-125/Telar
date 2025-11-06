# OmniRetail - Sistema de Gestión Comercial Multi-Sucursal

Sistema de gestión comercial diseñado para empresas con múltiples sucursales, que permite administrar inventarios, ventas, clientes y productos de manera centralizada y eficiente.

## Tabla de Contenidos

- [Características](#características)
- [Tecnologías](#tecnologías)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Estructura de la Base de Datos](#estructura-de-la-base-de-datos)
- [API Endpoints](#api-endpoints)
- [Uso](#uso)
- [Licencia](#licencia)

## Características

- Gestión multi-empresa y multi-sucursal
- Control de inventarios por sucursal
- Sistema de ventas con detalles
- Gestión de clientes
- Catálogo de productos con tipos y tamaños
- Sistema de roles y permisos
- Autenticación JWT
- API RESTful
- Soft deletes en todas las entidades
- Arquitectura modular

## Tecnologías

- **Backend:** Laravel 10
- **Autenticación:** JWT (tymon/jwt-auth) + Laravel Sanctum
- **Base de Datos:** PostgreSQL
- **PHP:** ^8.1
- **Arquitectura:** Modular + Repository Pattern
- **Testing:** PHPUnit
- **Code Quality:** Laravel Pint

## Requisitos

- PHP >= 8.1
- Composer
- PostgreSQL >= 12
- Docker (opcional)
- Node.js >= 18 (para assets)

## Instalación

### Con Docker

```bash
# Clonar el repositorio
git clone <repository-url>
cd omniretail

# Levantar contenedores
docker-compose up -d

# Instalar dependencias
docker-compose exec app composer install

# Generar key
docker-compose exec app php artisan key:generate

# Ejecutar migraciones
docker-compose exec app php artisan migrate

# Ejecutar seeders
docker-compose exec app php artisan db:seed
```

### Sin Docker

```bash
# Clonar el repositorio
git clone <repository-url>
cd omniretail

# Instalar dependencias
composer install

# Copiar archivo de entorno
cp .env.example .env

# Configurar variables de entorno en .env
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=omniretail
# DB_USERNAME=tu_usuario
# DB_PASSWORD=tu_password

# Generar application key
php artisan key:generate

# Generar JWT secret
php artisan jwt:secret

# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders
php artisan db:seed

# Iniciar servidor
php artisan serve
```

## Configuración

### Variables de Entorno

```env
APP_NAME=OmniRetail
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=omniretail
DB_USERNAME=postgres
DB_PASSWORD=

JWT_SECRET=
JWT_TTL=60
```

## Estructura del Proyecto

```
omniretail/
├── app/
│   ├── Console/              # Comandos de consola
│   ├── Exceptions/           # Manejo de excepciones
│   ├── Http/
│   │   ├── Controllers/      # Controladores HTTP
│   │   ├── Middleware/       # Middlewares
│   │   ├── Requests/         # Form Requests (validaciones)
│   │   └── Resources/        # API Resources (transformadores)
│   ├── Models/               # Modelos Eloquent
│   │   ├── User.php
│   │   ├── Rol.php
│   │   ├── Company.php
│   │   ├── Branch.php
│   │   ├── Client.php
│   │   ├── Product.php
│   │   ├── ProductSize.php
│   │   ├── TypeProduct.php
│   │   ├── Inventory.php
│   │   ├── Sale.php
│   │   └── SaleDetail.php
│   ├── Modules/              # Módulos de negocio
│   │   ├── Auth/            # Módulo de autenticación
│   │   └── User/            # Módulo de usuarios
│   ├── Providers/           # Service Providers
│   └── Utils/               # Utilidades y constantes
│       └── ValuesDatabase.php
├── bootstrap/
│   └── cache/
├── config/                  # Archivos de configuración
├── database/
│   ├── factories/          # Model Factories
│   ├── migrations/         # Migraciones de BD
│   └── seeders/           # Seeders
├── public/                # Punto de entrada público
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── api.php           # Rutas API
│   ├── api/v1/          # Rutas API versión 1
│   └── web.php          # Rutas web
├── storage/             # Archivos generados
├── tests/
│   ├── Feature/        # Tests de integración
│   └── Unit/          # Tests unitarios
├── .env.example
├── composer.json
├── docker-compose.yml
├── Dockerfile
└── README.md
```

## Estructura de la Base de Datos

### Diagrama de Relaciones

```
companies (1) ──< (N) branches (1) ──< (N) inventories
                        │
                        └──< (N) sales
rols (1) ──< (N) users (1) ──< (N) sales

type_products (1) ──< (N) products (1) ──< (N) sale_details
                             │               │
product_sizes (1) ──< (N) ──┘               │
                                             │
inventories (N) >── (1) products            │
                                             │
sales (1) ──< (N) sale_details             │
                                             │
clients (1) ──< (N) sales                  │
```

### Tablas y Campos

#### 1. `rols` - Roles de Usuario
Almacena los roles disponibles en el sistema (Admin, Vendedor, Gerente, etc.)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `name` | VARCHAR | Nombre del rol |
| `description` | VARCHAR | Descripción del rol |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`
- UNIQUE: `name`

---

#### 2. `users` - Usuarios del Sistema
Usuarios que operan el sistema

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `rol_id` | BIGINT | ID del rol (FK → rols.id) |
| `name` | VARCHAR | Nombre completo |
| `email` | VARCHAR | Correo electrónico |
| `password` | VARCHAR | Contraseña encriptada |
| `remember_token` | VARCHAR(100) | Token de sesión |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`
- UNIQUE: `email`
- FOREIGN KEY: `rol_id` REFERENCES `rols(id)` ON DELETE CASCADE

---

#### 3. `companies` - Empresas
Empresas del sistema (multi-tenant)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `name` | VARCHAR | Nombre de la empresa |
| `address` | VARCHAR | Dirección física |
| `phone` | VARCHAR | Teléfono de contacto |
| `email` | VARCHAR | Email corporativo |
| `description` | TEXT | Descripción de la empresa |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`

---

#### 4. `branches` - Sucursales
Sucursales de cada empresa

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `company_id` | BIGINT | ID de la empresa (FK → companies.id) |
| `name` | VARCHAR | Nombre de la sucursal |
| `address` | VARCHAR | Dirección física |
| `phone` | VARCHAR | Teléfono de contacto |
| `email` | VARCHAR | Email de la sucursal |
| `description` | TEXT | Descripción |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `company_id` REFERENCES `companies(id)` ON DELETE CASCADE
- INDEX: `company_id`

---

#### 5. `clients` - Clientes
Clientes que realizan compras

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `name` | VARCHAR | Nombre completo |
| `nip` | VARCHAR | NIT/RUC/RFC/Identificación |
| `email` | VARCHAR | Correo electrónico |
| `phone` | VARCHAR | Teléfono |
| `address` | VARCHAR | Dirección |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`
- INDEX: `nip`

---

#### 6. `type_products` - Tipos de Productos
Categorías o tipos de productos (Electrónica, Ropa, Alimentos, etc.)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `name` | VARCHAR | Nombre del tipo |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`

---

#### 7. `product_sizes` - Tamaños de Productos
Tamaños disponibles (XS, S, M, L, XL, Unitario, etc.)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `name` | VARCHAR | Nombre del tamaño |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`

---

#### 8. `products` - Productos
Catálogo de productos

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `type_id` | BIGINT | ID del tipo (FK → type_products.id) |
| `size_id` | BIGINT | ID del tamaño (FK → product_sizes.id) |
| `name` | VARCHAR | Nombre del producto |
| `description` | TEXT | Descripción detallada |
| `price` | DECIMAL(10,2) | Precio unitario |
| `iva` | DECIMAL(5,2) | Porcentaje de IVA/impuesto |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `type_id` REFERENCES `type_products(id)` ON DELETE CASCADE
- FOREIGN KEY: `size_id` REFERENCES `product_sizes(id)` ON DELETE CASCADE
- INDEX: `type_id`, `size_id`

---

#### 9. `inventories` - Inventarios
Control de stock por sucursal

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `product_id` | BIGINT | ID del producto (FK → products.id) |
| `product_size_id` | BIGINT | ID del tamaño (FK → product_sizes.id) |
| `type_id` | BIGINT | ID del tipo (FK → type_products.id) |
| `brand_id` | BIGINT | ID de la sucursal (FK → branches.id) |
| `stock` | INTEGER | Cantidad en stock |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `product_id` REFERENCES `products(id)` ON DELETE CASCADE
- FOREIGN KEY: `product_size_id` REFERENCES `product_sizes(id)` ON DELETE CASCADE
- FOREIGN KEY: `type_id` REFERENCES `type_products(id)` ON DELETE CASCADE
- FOREIGN KEY: `brand_id` REFERENCES `branches(id)` ON DELETE CASCADE
- INDEX: `product_id`, `brand_id`

---

#### 10. `sales` - Ventas
Registro de ventas

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `user_id` | BIGINT | ID del vendedor (FK → users.id) |
| `client_id` | BIGINT | ID del cliente (FK → clients.id) |
| `branch_id` | BIGINT | ID de la sucursal (FK → branches.id) |
| `total_amount` | DECIMAL(10,2) | Monto total de la venta |
| `created_at` | TIMESTAMP | Fecha de la venta |
| `updated_at` | TIMESTAMP | Fecha de actualización |
| `deleted_at` | TIMESTAMP | Fecha de eliminación (soft delete) |

**Índices:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `user_id` REFERENCES `users(id)` ON DELETE CASCADE
- FOREIGN KEY: `client_id` REFERENCES `clients(id)` ON DELETE CASCADE
- FOREIGN KEY: `branch_id` REFERENCES `branches(id)` ON DELETE CASCADE
- INDEX: `user_id`, `client_id`, `branch_id`, `created_at`

---

#### 11. `sale_details` - Detalles de Venta
Productos vendidos en cada venta

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `sale_id` | BIGINT | ID de la venta (FK → sales.id) |
| `product_id` | BIGINT | ID del producto (FK → products.id) |
| `price_total` | DECIMAL(10,2) | Precio total del item |
| `quantity` | INTEGER | Cantidad vendida |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |

**Índices:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `sale_id` REFERENCES `sales(id)` ON DELETE CASCADE
- FOREIGN KEY: `product_id` REFERENCES `products(id)` ON DELETE CASCADE
- INDEX: `sale_id`, `product_id`

---

#### 12. `personal_access_tokens` - Tokens de Acceso
Tokens de autenticación (Laravel Sanctum)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `tokenable_type` | VARCHAR | Tipo de modelo |
| `tokenable_id` | BIGINT | ID del modelo |
| `name` | VARCHAR | Nombre del token |
| `token` | VARCHAR(64) | Hash del token |
| `abilities` | TEXT | Permisos del token |
| `last_used_at` | TIMESTAMP | Último uso |
| `expires_at` | TIMESTAMP | Fecha de expiración |
| `created_at` | TIMESTAMP | Fecha de creación |
| `updated_at` | TIMESTAMP | Fecha de actualización |

**Índices:**
- PRIMARY KEY: `id`
- UNIQUE: `token`
- INDEX: `tokenable_type`, `tokenable_id`

---

#### 13. `password_reset_tokens` - Reseteo de Contraseñas
Tokens para recuperación de contraseña

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `email` | VARCHAR | Email del usuario (PK) |
| `token` | VARCHAR | Token de reseteo |
| `created_at` | TIMESTAMP | Fecha de creación |

**Índices:**
- PRIMARY KEY: `email`

---

#### 14. `failed_jobs` - Trabajos Fallidos
Registro de trabajos en cola que fallaron

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT | ID autoincremental (PK) |
| `uuid` | VARCHAR | UUID único |
| `connection` | TEXT | Conexión utilizada |
| `queue` | TEXT | Nombre de la cola |
| `payload` | LONGTEXT | Payload del trabajo |
| `exception` | LONGTEXT | Excepción ocurrida |
| `failed_at` | TIMESTAMP | Fecha del fallo |

**Índices:**
- PRIMARY KEY: `id`
- UNIQUE: `uuid`

---

## API Endpoints

### Autenticación
```
POST   /api/v1/auth/register     - Registrar usuario
POST   /api/v1/auth/login        - Iniciar sesión
POST   /api/v1/auth/logout       - Cerrar sesión
POST   /api/v1/auth/refresh      - Refrescar token
GET    /api/v1/auth/me           - Obtener usuario actual
```

### Usuarios
```
GET    /api/v1/users             - Listar usuarios
POST   /api/v1/users             - Crear usuario
GET    /api/v1/users/{id}        - Obtener usuario
PUT    /api/v1/users/{id}        - Actualizar usuario
DELETE /api/v1/users/{id}        - Eliminar usuario
```

### Empresas
```
GET    /api/v1/companies         - Listar empresas
POST   /api/v1/companies         - Crear empresa
GET    /api/v1/companies/{id}    - Obtener empresa
PUT    /api/v1/companies/{id}    - Actualizar empresa
DELETE /api/v1/companies/{id}    - Eliminar empresa
```

### Sucursales
```
GET    /api/v1/branches          - Listar sucursales
POST   /api/v1/branches          - Crear sucursal
GET    /api/v1/branches/{id}     - Obtener sucursal
PUT    /api/v1/branches/{id}     - Actualizar sucursal
DELETE /api/v1/branches/{id}     - Eliminar sucursal
```

### Clientes
```
GET    /api/v1/clients           - Listar clientes
POST   /api/v1/clients           - Crear cliente
GET    /api/v1/clients/{id}      - Obtener cliente
PUT    /api/v1/clients/{id}      - Actualizar cliente
DELETE /api/v1/clients/{id}      - Eliminar cliente
```

### Productos
```
GET    /api/v1/products          - Listar productos
POST   /api/v1/products          - Crear producto
GET    /api/v1/products/{id}     - Obtener producto
PUT    /api/v1/products/{id}     - Actualizar producto
DELETE /api/v1/products/{id}     - Eliminar producto
```

### Inventarios
```
GET    /api/v1/inventories       - Listar inventarios
POST   /api/v1/inventories       - Crear registro de inventario
GET    /api/v1/inventories/{id}  - Obtener inventario
PUT    /api/v1/inventories/{id}  - Actualizar inventario
DELETE /api/v1/inventories/{id}  - Eliminar inventario
GET    /api/v1/inventories/branch/{id} - Inventario por sucursal
```

### Ventas
```
GET    /api/v1/sales             - Listar ventas
POST   /api/v1/sales             - Crear venta
GET    /api/v1/sales/{id}        - Obtener venta
PUT    /api/v1/sales/{id}        - Actualizar venta
DELETE /api/v1/sales/{id}        - Eliminar venta
GET    /api/v1/sales/branch/{id} - Ventas por sucursal
GET    /api/v1/sales/reports     - Reportes de ventas
```

## Uso

### Autenticación

```bash
# Login
curl -X POST http://localhost:8000/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password"
  }'

# Respuesta
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "token_type": "bearer",
  "expires_in": 3600
}
```

### Crear Venta

```bash
curl -X POST http://localhost:8000/api/v1/sales \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "client_id": 1,
    "branch_id": 1,
    "products": [
      {
        "product_id": 1,
        "quantity": 2,
        "price": 100.00
      },
      {
        "product_id": 2,
        "quantity": 1,
        "price": 50.00
      }
    ]
  }'
```

## Testing

```bash
# Ejecutar todos los tests
php artisan test

# Ejecutar tests con coverage
php artisan test --coverage

# Ejecutar tests específicos
php artisan test --filter=UserTest
```

## Code Quality

```bash
# Ejecutar Laravel Pint (formatter)
./vendor/bin/pint

# Generar helpers de IDE
php artisan ide-helper:generate
php artisan ide-helper:models
php artisan ide-helper:meta
```

## Docker

El proyecto incluye configuración Docker con:
- PHP 8.1
- PostgreSQL 15
- Nginx
- Redis (para caché y colas)

```bash
# Levantar servicios
docker-compose up -d

# Ver logs
docker-compose logs -f

# Detener servicios
docker-compose down
```

## Contribuir

1. Fork el proyecto
2. Crear rama de feature (`git checkout -b feature/AmazingFeature`)
3. Commit cambios (`git commit -m 'Add: Amazing Feature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir Pull Request

### Convenciones de Código

- PSR-12 para estilo de código
- Usar Laravel Pint para formateo
- Tests obligatorios para nuevas features
- Documentar métodos públicos
- Commits en español descriptivos

## Licencia

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

## Contacto

Proyecto desarrollado como sistema de gestión comercial multi-sucursal.

---

**OmniRetail** - Sistema de Gestión Comercial v1.0.0
