<?php

class Clientes extends Controller
{

    # Método principal. Muestra todos los clientes
    public function render($param = [])
    {
        $this->view->title = "Tabla Clientes";
        $this->view->clientes = $this->model->get();
        $this->view->render("clientes/main/index");
    }

    # Método nuevo. Muestra formulario añadir cliente
    public function nuevo($param = [])
    { 
        $this->view->title = "Formulario cliente nuevo";
        $this->view->render("clientes/nuevo/index");
    }

    # Método create. 
    # Permite añadir nuevo cliente a partir de los detalles del formuario
    public function create($param = [])
    {
        $cliente = new classCliente(
            null,
            $_POST["apellidos"],
            $_POST["nombre"],
            $_POST["telefono"],
            $_POST["ciudad"],
            $_POST["dni"],
            $_POST["email"],
            null,
            null
        );

        $this->model->create($cliente);
        header("Location:" . URL . "clientes");
    }

    # Método delete. 
    # Permite la eliminación de un cliente
    public function delete($param = [])
    {
        $id=$param[0];
        $this->model->delete($id);
        header("Location:" . URL . "clientes");
    }

    # Método editar. 
    # Muestra un formulario que permita editar los detalles de un cliente
    public function editar($param = [])
    {
        $this->view->id = $param[0];
        $this->view->title = "Formulario  editar cliente";
        $this->view->cliente = $this->model->getCliente($this->view->id);
        $this->view->render("clientes/editar/index");
    }

    # Método update.
    # Actualiza los detalles de un cliente a partir de los datos del formulario de edición
    public function update($param = [])
    {
        $id = $param[0];

        $cliente = new classCliente(
            null,
            $_POST["apellidos"],
            $_POST["nombre"],
            $_POST["telefono"],
            $_POST["ciudad"],
            $_POST["dni"],
            $_POST["email"],
            null,
            null
        );

        $this->model->update($cliente, $id);
        header("Location:" . URL . "clientes");
    }

    
    # Método mostrar
    # Muestra en un formulario de solo lectura los detalles de un cliente
    public function mostrar($param = [])
    {
        $id = $param[0];
        $this->view->title = "Formulario Cliente Mostar";
        $this->view->cliente=$this->model->getCliente($id);
        $this->view->render("clientes/mostrar/index");
    }

    # Método ordenar
    # Permite ordenar la tabla de clientes por cualquiera de las columnas de la tabla
    public function ordenar($param=[])
    {
        $criterio=$param[0];
        $this->view->title = "Tabla Clientes";
        $this->view->clientes=$this->model->order($criterio);
        $this->view->render("clientes/main/index");

    }

    # Método buscar
    # Permite buscar los registros de clientes que cumplan con el patrón especificado en la expresión
    # de búsqueda
    public function buscar($param=[])
    {
        $expresion=$_GET["expresion"];
        $this->view->title = "Tabla Clientes";
        $this->view->clientes= $this->model->filter($expresion);
        $this->view->render("clientes/main/index");
    }
}
