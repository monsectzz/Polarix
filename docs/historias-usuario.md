# Historias de usuario de Polarix

Cada historia usa lenguaje funcional, sin describir base de datos, arquitectura ni implementación.

## HU-01 — Iniciar sesión y acceder según el rol

**Como** usuario registrado, **quiero** iniciar sesión con mis credenciales, **para** utilizar únicamente las funciones que corresponden a mi rol.

**Prioridad:** Alta  
**Dependencias:** Usuarios registrados y roles definidos.

**Criterios de aceptación:**

- Se solicitan correo y contraseña.
- Las credenciales válidas permiten el acceso.
- Las credenciales inválidas muestran un mensaje y no permiten entrar.
- La sesión permanece activa solo durante el tiempo establecido por el equipo.
- Al cerrar sesión, las funciones privadas dejan de estar disponibles.

**Reglas de negocio:** Solo usuarios registrados pueden entrar; las opciones disponibles dependen del rol; una sesión inactiva debe cerrarse después del tiempo definido.

## HU-02 — Administrar productos

**Como** gerente, **quiero** registrar, modificar, consultar y desactivar productos, **para** mantener actualizado el catálogo de la tienda.

**Prioridad:** Alta  
**Dependencias:** HU-01 y categorías de productos disponibles.

**Criterios de aceptación:**

- El gerente puede crear, editar y desactivar productos.
- Cada producto tiene nombre, precio, categoría, existencia y nivel mínimo.
- No se aceptan precios ni existencias negativas.
- Los productos desactivados no pueden seleccionarse en una venta.

**Reglas de negocio:** Solo el gerente puede administrar productos; el precio debe ser mayor que cero; un producto con ventas registradas no se elimina, se desactiva.

## HU-03 — Registrar una venta

**Como** empleado, **quiero** registrar los productos y cantidades vendidos, **para** cobrar al cliente y mantener actualizadas las existencias.

**Prioridad:** Alta  
**Dependencias:** HU-01 y HU-02.

**Criterios de aceptación:**

- Se pueden seleccionar productos activos y cantidades disponibles.
- Se calculan subtotal, total, pago recibido y cambio.
- No se permite confirmar una venta sin productos o con cantidades insuficientes.
- La venta registra al empleado responsable.
- La existencia se actualiza al confirmar la venta.

**Reglas de negocio:** El empleado debe tener una sesión activa; el pago recibido debe cubrir el total; una venta confirmada no puede modificarse sin autorización del gerente.

## HU-04 — Consultar inventario

**Como** gerente, **quiero** consultar las existencias y los niveles mínimos, **para** identificar oportunamente los productos que necesitan reposición.

**Prioridad:** Alta  
**Dependencias:** HU-02 y HU-03.

**Criterios de aceptación:**

- Se muestra la existencia actual de cada producto.
- Se identifican los productos que están en el nivel mínimo o por debajo.
- Las ventas reducen existencias y las entradas las incrementan.

**Reglas de negocio:** Solo el gerente puede consultar el inventario completo; no se puede registrar una salida superior a la existencia disponible.

## HU-05 — Solicitar reabastecimiento

**Como** gerente, **quiero** solicitar productos a un proveedor y consultar el estado de la solicitud, **para** mantener abastecida la tienda.

**Prioridad:** Media  
**Dependencias:** HU-01, HU-02 y proveedores registrados.

**Criterios de aceptación:**

- La solicitud incluye proveedor, producto, cantidad y fecha.
- La cantidad solicitada es mayor que cero.
- La solicitud inicia como pendiente y permite consultar su estado.
- Al recibir el pedido, la existencia aumenta.

**Reglas de negocio:** Solo el gerente puede crear o cambiar solicitudes; una solicitud cancelada no puede marcarse como recibida; la recepción debe corresponder a un producto solicitado.

## HU-06 — Realizar cierre de caja

**Como** gerente, **quiero** cerrar la caja y comparar el efectivo esperado con el efectivo contado, **para** verificar las ventas del periodo.

**Prioridad:** Alta  
**Dependencias:** HU-03 y ventas del periodo registradas.

**Criterios de aceptación:**

- Se calcula el total vendido en el periodo seleccionado.
- Se puede capturar el efectivo contado.
- Se muestra la diferencia entre el efectivo esperado y el contado.
- El cierre registra fecha, responsable y resultado.
- Un cierre confirmado no puede modificarse sin autorización.

**Reglas de negocio:** Solo el gerente puede confirmar el cierre; cada periodo solo puede tener un cierre confirmado; el cierre requiere una sesión activa.
