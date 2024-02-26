<nav class="navbar navbar-expand-lg bg-body-tertiary"> 
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>cliente">Clientes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['id_rol'], $GLOBALS['cliente']['new'])? 'active': 'disabled' ?>" 
                    href="<?= URL ?>cliente/new">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link 
                    <?= in_array($_SESSION['id_rol'], $GLOBALS['cliente']['order'])? 'active': 'disabled' ?> dropdown-toggle"
                    href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/1">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/2">Cliente</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/3">Email</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/4">Teléfono</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/5">Ciudad</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/6">DNI</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " 
                    href="<?= URL ?>cliente/exportCSV">Exportar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " 
                    href="<?= URL ?>cliente/subir">Importar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " 
                    href="<?= URL ?>cliente/PDF/">Crear PDF</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="<?= URL ?>cliente/filter">
                <input class="form-control me-2" type="search"  aria-label="Search" name="expresion">
                <button class="btn btn-outline-secondary
                <?= in_array($_SESSION['id_rol'], $GLOBALS['cliente']['filter'])? null: 'disabled' ?>"
                type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>