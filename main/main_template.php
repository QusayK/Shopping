<div class="container-fluid row m-0 p-0">
    <div class="col-md-2" style="max-height: 400px">
        <nav class="navbar bg-secondary navbar-dark rounded-bottom navbar-expand-lg shadow mh-100">
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarToggler" aria-controls="navbarToggler" 
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav d-flex flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Products</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="add_products.php">Add products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorite.php">Favorites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="basket.php">Basket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="purchases.php">Purchases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Log out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="col-md-10">
        <div class="row d-flex justify-content-between col-m-12 bg-white border rounded-bottom shadow p-4 mb-4">
            <select class="browser-default custom-select col-7 col-sm-5 col-md-3"  name="type_filter" id="type_filter">
                <option value="none" selected>- Filter products</option>
                <option value="clothes">Clothes</option>
                <option value="electronics">Electronics</option>
            </select>
            <h2 class="text-secondary">ONLINE <small><sup><strong class="text-info">MARKET</strong></sup></small></h2>
        </div>
        <div class="col-md-12 d-flex flex-wrap justify-content-center mb-5 p-0" id="root"></div>
    </div>
</div>