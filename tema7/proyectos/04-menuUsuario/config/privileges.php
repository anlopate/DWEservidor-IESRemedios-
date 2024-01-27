<?php

/*P # Perfiles
 1-Adimintrador
 2-Editor
 3-Registrado
 
 Perfiles	 	Nuevo	Editar	Eliminar	 Mostrar	Buscar 	Ordenar 
ADMINISTRADOR	 SI	      SI	  SI	      SI	      SI	 SI
EDITOR	 	     SI	       SI	  NO	      SI	      SI	 SI 
REGISTRADO	     NO	      NO	  NO	      SI	      SI 	 SI*/

 # Definir privilegios con variables globales
 # Array asociativo, el primer parámetro indica el recurso a utilizar y el segundo la acción sobre ese recurso.
 $GLOBALS['alumno']['main'] =   [1,2,3];
 $GLOBALS['alumno']['new'] =    [1,2];
 $GLOBALS['alumno']['edit'] =   [1,2];
 $GLOBALS['alumno']['delete'] = [1];
 $GLOBALS['alumno']['show'] =   [1,2,3];
 $GLOBALS['alumno']['filter'] = [1,2,3];
 $GLOBALS['alumno']['order'] =  [1,2,3];
 
?>