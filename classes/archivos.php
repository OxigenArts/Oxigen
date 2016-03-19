<?php
/*
* Modulo: Archivos
* Version: 0.1A
* Dependencias:
*
* Manejador de archivos y carpetas.
*/
class Archivos {
		public static function eliminarDir($carpeta){
			foreach(glob($carpeta . "/*") as $archivos_carpeta)
			{
				if (is_dir($archivos_carpeta))
				{
					Archivos::eliminarDir($archivos_carpeta);
				}
				else
				{
					unlink($archivos_carpeta);
				}
		}
			rmdir($carpeta);
			return true;
		}
		public static function descomprimir($file,$final){
			$zip = new ZipArchive;
			if ($zip->open($file) == true) {
				$zip->extractTo($final);
				$zip->close();
				return true;
			} else {
				return false;
			}
		}
		public static function csvArray($file){
			$content = file_get_contents($file);
			$datos = preg_split("/[\r\n;]+/",$content);
			for ($i=0; $i <= sizeof($datos)-2; $i++) {
				$datos_final[$datos[$i]] = $datos[$i+1];
				$i++;
			}
			return $datos_final;
		}
		function copiarDir( $source, $target ) {
    	if ( is_dir( $source ) ) {
        	@mkdir( $target );
        	$d = dir( $source );
        	while ( FALSE !== ( $entry = $d->read() ) ) {
            	if ( $entry == '.' || $entry == '..' ) {
                	continue;
            	}
            	$Entry = $source . '/' . $entry;
            	if ( is_dir( $Entry ) ) {
                	Archivos::copiarDir( $Entry, $target . '/' . $entry );
                	continue;
            	}
            	if(copy( $Entry, $target . '/' . $entry ) == false){
								return false;
							}
        	}
        	$d->close();
    	}else {
        	if(copy( $source, $target) == false){
						return false;
					}
    	}
			return true;
		}
		function moverDir( $source, $target ) {
			if(file_exists($source)){
				if(Archivos::copiarDir($source,$target) == true){
						Archivos::eliminarDir($source);
				}
			}

		}
}
?>
