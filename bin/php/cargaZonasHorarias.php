<?php

descargarArchivoRemoto("http://download.geonames.org/export/dump/admin1CodesASCII.txt", $CONFIG['PATH']  . "fuentes/ciudades/timeZones.txt");  //Esto debe ir dentro de un foreach y solo se descarga si aun no se ha descargado