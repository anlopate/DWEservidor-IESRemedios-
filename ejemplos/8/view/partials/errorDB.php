<?php
  echo "ERROR DE DATOS: ";
  echo "<HR>";
  echo "Mensaje:  ".$e->getMenssage().'<br>';
  echo "Código e: ".$e->getCode().'<br>';
  echo "Fichero: ".$e->getFile().'<br>';
  echo "Linea: ".$e->getLine().'<br>';
  echo "Trace".$e->getTraceAsString().'<br>';

?>