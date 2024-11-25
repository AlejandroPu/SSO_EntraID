# SSO_EntraID

Proyecto Single Sign On con Entra ID

Este proyecto es una aplicación Laravel que implementa autenticación con Microsoft Entra ID (Azure Active Directory) y utiliza Backpack para Laravel como panel de administración.

## Tabla de Contenidos

- [Requisitos Previos](#requisitos-previos)
- [Instalación](#instalación)
- [Configuración de Azure](#configuración-de-azure)
- [Uso](#uso)
- [Contribuir](#contribuir)
- [Licencia](#licencia)

## Requisitos Previos

- PHP >= 7.3
- Composer
- XAMPP (Apache y MySQL)
- Cuenta en Azure
- Git

## Instalación

1. **Clona el repositorio:**

   ```bash```
   git clone https://github.com/AlejandroPu/SSO_EntraID.git

2. **Navega al directorio del proyecto:**

   cd SSO_EntraID

3. **Instala las dependencias de Composer:**

   composer install

4. **Copia el archivo de entorno y genera la clave de aplicación y genera la clave:**

   cp .env.example .env

   php artisan key:generate

5. **Configura las variables de entorno en el archivo .env:**

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=tu_base_de_datos
	DB_USERNAME=tu_usuario
	DB_PASSWORD=tu_contraseña

**Agrega las credenciales de Azure al final:**

	MICROSOFT_CLIENT_ID=tu_cliente_id
	MICROSOFT_CLIENT_SECRET=tu_secreto_de_cliente
	MICROSOFT_TENANT_ID=tenant_id
	MICROSOFT_REDIRECT_URI=https://localhost/login/microsoft/callback

6. **Ejecuta las migraciones:**

	php artisan migrate

## Configuración de Azure

1. **Registra una nueva aplicación en Azure Active Directory:**

   - Inicia sesión en el [Portal de Azure](https://portal.azure.com).
   - Navega a **Azure Active Directory** > **Registros de aplicaciones**.
   - Haz clic en **"Nuevo registro"** y completa los detalles.

2. **Configura las URI de redirección:**

   - **URI de redirección**: `https://localhost/login/microsoft/callback`
   - **URI de redirección de cierre de sesión**: `https://localhost/logged-out`

3. **Genera un secreto de cliente:**

   - Ve a **Certificados y secretos**.
   - Haz clic en **"Nuevo secreto de cliente"** y copia el valor generado.

4. **Agrega los permisos necesarios:**

   - Ve a **Permisos de API** y agrega los permisos requeridos para Microsoft Graph.

5. **Actualiza el archivo `.env` con las credenciales:**

   - Asegúrate de que las variables `MICROSOFT_CLIENT_ID` y `MICROSOFT_CLIENT_SECRET` están actualizadas.

## Uso

1. **Accede a la aplicación:**

   ```bash```
   Abre tu navegador y navega a https://localhost

2. **Inicia sesión:**

	Después de iniciar sesión con Microsoft, serás redirigido a localhost/home
	
3. **Cerrar sesión:**

	Utiliza el botón "Cerrar Sesión" para finalizar tu sesión tanto en la aplicación como en Microsoft Entra ID.
	
## Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.
