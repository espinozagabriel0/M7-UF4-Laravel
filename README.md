# API REST - Documentación

## Descripción

Esta API REST permite la gestión de usuarios y mascotas. Los usuarios pueden tener rol de admin o user. Ambos roles pueden crear, modificar y eliminar registros de mascotas. Para garantizar la seguridad y el control de acceso, se han implementado dos middlewares: `IsAuthenticated`, que verifica que el usuario esté autenticado, e `IsUserAdmin`, que comprueba si el usuario tiene privilegios de administrador. Todas las rutas protegidas utilizan autenticación basada en JWT (JSON Web Token)

---

## Listado de Rutas y Métodos

| Método | Ruta                 | Descripción                          | Autenticación | Rol requerido |
|--------|----------------------|--------------------------------------|---------------|--------------|
| POST   | `/register`             | Registro JWT     | No            | -            |
| POST   | `/login`             | Autenticación y obtención de Token     | No            | -            |
| POST    | `/logout`          | Cerrar sesión            | Sí            | admin/user        |
| GET   | `/pets`          | Obtener mascotas propias               | Sí            | admin/user        |
| POST    | `/pets`      | Crear mascota propia           | Sí            | admin/user   |
| PUT    | `/pets/:id`      | Actualizar mascota                   | Sí            | admin/user        |
| PATCH | `/pets/:id`      | Actualizar parcialmente mascota                     | Sí            | admin/user        |
| DELETE | `/pets/:id`      | Eliminar mascota propia                     | Sí            | admin/user        |
| GET    | `/users`         | Obtener usuarios                     | Sí            | admin            |
| GET   | `/users/:id`         | Obtener un usuario                       | Sí            | admin        |
| PUT   | `/users/:id`         | Actualizar usuario                       | Sí            | admin        |
| DELETE   | `/users/:id`         | Eliminar usuario                       | Sí            | admin        |
| GET   | `/users/:id/pets`         | Obtener mascotas de un usuario                       | Sí            | admin        |

---

## Autenticación JWT

La API utiliza JWT (JSON Web Token) para autenticar y autorizar a los usuarios en las rutas protegidas.

**¿Cómo funciona JWT?**
- El usuario envía sus credenciales (usuario y contraseña) al endpoint `/login`.
- Si las credenciales son correctas, el servidor genera un token JWT y lo devuelve al cliente.
- El cliente debe incluir este token en el header `Authorization` de cada petición protegida.
- El servidor valida el token en cada petición. Si es válido y el usuario tiene el rol adecuado, se permite el acceso.

---

## Credenciales de Prueba

Puedes usar el siguiente usuario para probar la API con permisos de admin:

{
"email": "gabriel@email.com",
"password": "password123"
}

