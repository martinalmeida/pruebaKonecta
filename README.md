# Prueba para Konecta Colombia

Prueba hecha para Konecta en laravel 9, php 8.1 y mysql.

## Instalar

1. Instalar el proyecto: <br />
   Usando composer.

```bash
composer install
```

2. Correr migraciones:

```bash
php artisan migrate:fresh
```

3. Insertar Seeders:

```bash
php artisan db:seed
```

4. Crear vista en SQL para visualizar la tabala del modulo de Stock

```bash
create view view_stocks as
select
s.id,
p.nombreProducto,
c.categoria,
u.name,
s.cantidad,
(SELECT COUNT(v2.cantidad) FROM ventas v2 WHERE v2.stockId = s.id)vendida,
((s.cantidad) - (SELECT COUNT(v2.cantidad) FROM ventas v2 WHERE v2.stockId = s.id))disponible
from
stock s
left join ventas v on v.stockId = s.id
join productos p on s.productoId = p.id
join categorias c on p.categoriaId = c.id
join users u on s.userId = u.id
join status s2 on s.status = s2.id
where p.status = 1
and s.status in(1,2)
group by s.id
order by p.nombreProducto asc;
```

## Usuario

Usuario: admin@admin.com Contraseña: admin

```
## Licencia

[MIT](https://choosealicense.com/licenses/mit/)
```
