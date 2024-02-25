<nav class="navbar navbar-expand-lg bg-body-tertiary"> 
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>cuenta">Cuentas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>cuenta/new">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>cuenta/order/1">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuenta/order/2">Nº cuenta</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuenta/order/3">Id cliente</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuenta/order/4">Fecha de alta</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuenta/order/5">Fecha último mvto</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuenta/order/6">Nº movimientos</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuenta/order/7">Saldo</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " 
                    href="<?= URL ?>cuenta/exportCSV">Exportar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " 
                    href="<?= URL ?>cuenta/subir">Importar</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="<?= URL ?>cuenta/filter">
                <input class="form-control me-2" type="search"  aria-label="Search" name="expresion">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>