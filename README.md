Para resolver el problema clasifique la información obtenida desde "https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/CodigoPostal_Exportar.aspx" en 5 modelos (FederalEntity, Locality, Municipality, Settlemen, SettlementType).

Cree un endpoint POST {{url}}/api/saveFilePostalCodes que recibe un único parámetro file de tipo FILE. En el puede enviarse el archivo obtenido desde la fuente en formato xls y el mismo se encarga de ingresar los datos en la DB.

También se creo el endpoint GET {{url}}/api/zip_codes/01210.

El proyecto se desplegó en un entorno serverless utilizando el paquete brefphp/bref y se utilizo una DB RDS todo en AWS.

Para ejecutar localmente hay que conectar a una DB, correr las migraciones y utilizar el endpoint para cargar los archivos xls (incrementar upload_max_filesize y post_max_size en .ini dado que los archivos son superiores a 4mb).
Postman Collection

https://www.getpostman.com/collections/ffd38019211867496663
