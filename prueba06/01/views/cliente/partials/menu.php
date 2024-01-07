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
                    <a class="nav-link" href="<?= URL ?>cliente/new">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/1">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/2">Cliente</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/3">Teléfono</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/4">Ciudad</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/5">DNI</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/6">email</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/7">Create_at</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cliente/order/8">Update_at</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="<?= URL ?>cliente/filter">
                <input class="form-control me-2" type="search"  aria-label="Search" name="expresion">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>