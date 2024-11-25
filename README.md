# SSO_EntraID

Proyecto Single Sign On con Entra ID

Este proyecto es una aplicación Laravel que implementa autenticación con Microsoft Entra ID (Azure Active Directory) y utiliza Backpack para Laravel como panel de administración.

## Tabla de Contenidos

- [Requisitos Previos](#requisitos-previos)
- [Instalación](#instalación)
- [Configuración de Azure](#configuración-de-azure)
- [Último paso de Instalación](#Último-paso-de-Instalación)
- [Uso](#uso)
- [Para crear este proyecto desde 0](#Para-crear-este-proyecto-desde-0)
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
	DB_HOST=srv1069.hstgr.io
	DB_PORT=3306
	DB_DATABASE=tu_base_de_datos
	DB_USERNAME=tu_usuario
	DB_PASSWORD=tu_contraseña

## Configuración de Azure

1. **Registra una nueva aplicación en Azure EntraID:**

   - Inicia sesión en el [Portal de Azure](https://portal.azure.com).
   - Navega a **EntraID** > **Registros de aplicaciones**.
   - Haz clic en **"Nuevo registro"** y completa los detalles.

2. **Configura las URI de redirección:**

   - **URI de redirección**: `https://localhost/login/microsoft/callback`
   - **URI de redirección de cierre de sesión(Front-channel logout URL)**: `https://localhost/logged-out`

3. **Genera un secreto de cliente:**

   - Ve a **Certificados y secretos**.
   - Haz clic en **"Nuevo secreto de cliente"** y copia el valor generado( después no se puede volver a ver).

4. **Agrega los permisos necesarios:**

   - Ve a **Permisos de API** y agrega los permisos requeridos para Microsoft Graph.

## Último paso de Instalación

1. **Agrega las credenciales de Azure al final del archivo .env:**

	MICROSOFT_CLIENT_ID=tu_cliente_id
	MICROSOFT_CLIENT_SECRET=tu_secreto_de_cliente
	MICROSOFT_TENANT_ID=tenant_id
	MICROSOFT_REDIRECT_URI=https://localhost/login/microsoft/callback

2. **Ejecuta las migraciones:**

	php artisan migrate

## Uso

1. **Accede a la aplicación:**

   ```bash```
   Abre tu navegador y navega a https://localhost

2. **Inicia sesión:**

	Después de iniciar sesión con Microsoft, serás redirigido a localhost/home
	
3. **Cerrar sesión:**

	Utiliza el botón "Cerrar Sesión" para finalizar tu sesión tanto en la aplicación como en Microsoft Entra ID.

## **Para crear este proyecto desde 0:**

1. En C:\xampp\htdocs crear el proyecto:

	composer create-project laravel/laravel SSO_EntraID

2. En el directorio del proyecto, instalar Backpack para Laravel:

	composer require backpack/crud:"4.1.*"

	php artisan backpack:install

3. Crear la base de datos y configurar .env según instrucciones anteriores.

4. Ejecutar migración

	php artisan migrate

5. Instalar Microsoft Graph:

	composer require microsoft/microsoft-graph
	
6. Instalar Socialite:

	composer require laravel/socialite

7. Socialite Providers para Microsoft Entra ID:

	composer require socialiteproviders/microsoft-azure

8. Configurar el Middleware, las Rutas y configurar las Vistas( mirar archivos del repositorio)

	- routes/web.php
	- app/Http/Controllers
	- resources/views: login.blade.php , home.blade.php , etcétera
	
9.  Crear la Aplicación en Azure( ver pasos anteriores)

10. Para el logout en app/Http/Controllers/Auth/LoginController.php arreglar la función logout:

	public function logout(Request $request)
	{
		Auth::logout();

		// Invalida la sesión y regenera el token CSRF
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		// URL de cierre de sesión de Microsoft
		$logoutUrl = 'https://login.microsoftonline.com/common/oauth2/v2.0/logout';

		return redirect($logoutUrl);
	}

## Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.
