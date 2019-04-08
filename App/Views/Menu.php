<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= ($_SERVER['REQUEST_URI'] === '/' || strstr($_SERVER['REQUEST_URI'], '/?'))
                ? 'active' : '' ?>">
                <a class="nav-link" href="/">Homepage</a>
            </li>
            <li class="nav-item <?= strstr($_SERVER['REQUEST_URI'], 'addProduct') ? 'active' : '' ?>">
                <a class="nav-link" href="/addProduct">Add Product</a>
            </li>
            <li class="nav-item <?= strstr($_SERVER['REQUEST_URI'], 'editProducts') ? 'active' : '' ?>">
                <a class="nav-link" href="/editProducts">Edit Products</a>
            </li>
            <li class="nav-item <?= strstr($_SERVER['REQUEST_URI'], 'attributes') ? 'active' : '' ?>">
                <a class="nav-link" href="/attributes">Attributes List</a>
            </li>
        </ul>
    </div>
</nav>