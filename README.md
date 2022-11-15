## Los endpoint de la API son: 

# OBTENER PRODUCTOS Y AGREGAR PRODUCTO
## http://localhost/TPEWEB-E2/api/product:
        El mismo endpoint, cambiando la acción, funciona para obtener el listado de todos los productos(GET), como para poder insertar un producto nuevo(POST).
        Para insertar un producto, hay que insertar los datos desde la opción 'Body' en postman, lee esos datos y luego los inserta a la base de datos.
        Por ejemplo:
        GET: http://localhost/TPEWEB-E2/api/product 
        POST: http://localhost/TPEWEB-E2/api/product 


# OBTENER UN PRODUCTO Y ELIMINAR UN PRODUCTO
## http://localhost/TPEWEB-E2/api/product/id:
    El mismo endpoint, cambiando la acción, funciona para obtener un producto a partir de su ID, como para poder eliminar un producto específico.
### Por ejemplo:
    **para obtener un producto con id '50':**
        GET: http://localhost/TPEWEB-E2/api/product/50
    **para eliminar un roducto con id '50':**     
    DELETE: http://localhost/TPEWEB-E2/api/product/50


# ORDENAMIENTO POR COLUMNA
## http://localhost/TPEWEB-E2/api/product?column=column&order=asc
    Este endpoint da el servicio de ordenado por columna, debemos pasarle los parámetros correspondientes para que se efectue el filtrado. Seguido de 'column=' debemos ingresar el nombre de la columna. Y seguido de 'order=' debemos ingresar 'asc' o 'desc' para ordenar de manera ascendente o descendente, respectivamente. En caso de no dejarlo vacio, por defecto se ordenará ascendentemente.
### Por ejemplo, para ordenar por la columna 'price', de manera descendente:
        GET: http://localhost/TPEWEB-E2/api/product?column=price&order=desc


# FILTRADO POR COLUMNA
## http://localhost/TPEWEB-E2/api/product?filterby=columna&mark=signo&value=valorafiltrar
    Este endpoint da el servicio de filtrado por columna, debemos pasarle los parámetros correspondientes para que se efectue el filtrado. Seguido de 'filterby=' debemos ingresar el nombre de la columna. Seguido de 'mark=' debemos ingresar el signo con el cual queremos filtrar. Seguido de 'value=' el valor por el cual deseamos filtrar la columna.
### Por ejemplo, para filtrar por la columna 'price', cuando el valor sea mayor o igual (>=) a '1500'.
        GET: http://localhost/TPEWEB-E2/api/product?filterby=price&mark=>=&value=1500


# PAGINACIÓN
## http://localhost/TPEWEB-E2/api/product?page=pagina&limit=limite
    Este endpoint da el servicio de paginado, y nos pemite indicarle que página quiero obtener y cuandos registros quiero que me muestre. Con el parámetro 'page=' indico la página a obtener y con el parámetro 'limit=' la cantidad de registros en esa página.
### Por ejemplo, le pido que me traiga la página 2, y me muestre 5 productos o registros:
    http://localhost/TPEWEB-E2/api/product?page=2&limit=5
