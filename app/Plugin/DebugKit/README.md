Para crear el enlace de archivos:
	Primero crear la carpeta /var/www/identidad_archivos
	Luego crear un enlace para los archivos adjunto de legajos
		ln -s /var/www/identidad_archivos/legajos/ /var/www/identidad/app/webroot/legajos
	Luego crear un enlace para las imageges de las personas
		ln -s /var/www/identidad_archivos/personas/ /var/www/identidad/app/webroot/img/personas
