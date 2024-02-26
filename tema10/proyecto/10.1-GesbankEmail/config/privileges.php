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
 $GLOBALS['cliente']['main'] =   [1,2,3];
 $GLOBALS['cliente']['new'] =    [1,2];
 $GLOBALS['cliente']['edit'] =   [1,2];
 $GLOBALS['cliente']['delete'] = [1];
 $GLOBALS['cliente']['show'] =   [1,2,3];
 $GLOBALS['cliente']['filter'] = [1,2,3];
 $GLOBALS['cliente']['order'] =  [1,2,3];
 $GLOBALS['cliente']['exportCSV'] = [1,2];
 $GLOBALS['cliente']['subir'] = [1,2];
 $GLOBALS['cliente']['enviarCSVCarpeta'] = [1,2];
 $GLOBALS['cliente']['clientesPDF'] = [1,2];

 $GLOBALS['cuenta']['main'] = [1, 2, 3];
 $GLOBALS['cuenta']['new'] = [1, 2];
 $GLOBALS['cuenta']['edit'] = [1, 2];
 $GLOBALS['cuenta']['delete'] = [1];
 $GLOBALS['cuenta']['show'] = [1,2,3];
 $GLOBALS['cuenta']['buscar'] = [1,2,3];
 $GLOBALS['cuenta']['order'] = [1,2,3];
 $GLOBALS['cuenta']['exportCSV'] = [1,2];
 $GLOBALS['cuenta']['subir'] = [1,2];
 $GLOBALS['cuenta']['enviarCSVCarpeta'] = [1,2];

 $GLOBALS['contactar']['main'] = [1,2];

 
 
?>