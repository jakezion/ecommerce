<!--https://codepen.io/arshdkhn1/pen/pymzWz-->
<!--https://stackoverflow.com/questions/43439250/bootstrap-4-stop-collapse-from-pushing-content-down-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">AWTechnology</a>

        <div class="collapse navbar-collapse justify-content-end">

            <ul class="navbar-nav">
                <?php if (session()->authenticated) : ?>
                    <li><a class="nav-link" href="/logout"> <i class="bi bi-person-fill"></i>
                            <?= 'Logout'; ?>
                        </a></li>
                <?php else: ?>
                    <li><a class="nav-link" href="/register">
                            <i class="bi bi-person"></i> <?= 'Register'; ?>
                        </a>
                    </li>
                    <li><a class="nav-link" href="/login">
                            <i class="bi bi-person-fill"></i> <?= 'Login'; ?>
                        </a></li>


                <?php endif; ?>


                <?php if (session()->authenticated): ?>
                    <li>
                        <a class="nav-link " aria-current="page" href="/basket"><i class="bi bi-basket2"></i>
                            Basket</a>
                    </li>
                <?php endif; ?>

            </ul>
            <div class="search navbar-form col-4 mx-lg-auto order-lg-first mb-0" id="searchBox">
                <div class="input-group">
                    <label for="searchBar"></label>
                    <input class="form-control" id="searchBar" type="text" placeholder="search"
                           aria-describedby="searchButton">

                    <button id="searchButton" onclick="getProducts();" class="bi bi-search input-group-text"
                            data-toggle="tooltip"
                            title="Search"></button>

                </div>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar-expand-sm navbar-deep bg-deep">
    <div class="container-fluid">

        <div class="collapse navbar-collapse justify-content-center">

            <ul class="navbar-nav lower">
                <li><a class="nav-link" aria-current="page" href="/">Home</a></li>

                <li><a class="nav-link" href="/inv">Product Search</a></li>


                <li><a class="nav-link" href="/inv">All Products</a></li>


                <li><a class="nav-link" href="/inv/laptop">Laptops</a></li>


                <li><a class="nav-link" href="/inv/phone">Mobile Phones</a></li>


                <?php if (session()->authenticated): ?>

                    <li><a class="nav-link" href="/basket">Shopping Basket</a></li>


                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<style>


    .bg-deep {
        background: #383d41;
        /*color: #6c757d;*/
    }

    .bg-deep a {
        color: #95999c;
        text-decoration: none;
    }

    .bg-deep a:visited {
        color: #95999c;
        text-decoration: none;
    }

    .bg-deep a:hover {
        color: #95999c;
        text-decoration: none;
    }

    .bg-deep a:active {
        color: #95999c;
        text-decoration: none;
    }

    .lower a:hover{
        color: #FFFFFF;
    }

    .search .form-control {
        border-radius: 0;
        border: none;
        font-size: 20px;
        color: #95999c;
        background: none;
        letter-spacing: 1px;
        word-spacing: 10px;
        font-family: 'Arvo', sans-serif;
        line-height: 25px;
        padding: 0 0 0 10px;
    }

    .search .form-control:hover {
        background: none;
        border: none;
    }

    .search .form-control:focus {
        color: #95999c;
        background-color: transparent;
        border-color: transparent;
        outline: 0;
        box-shadow: none;
    }


    .search select.form-control:focus::-ms-value {
        color: #95999c;
        background-color: transparent;
    }

    .search #searchButton {
        /*padding-top: 40vh;*/
        background: none;
        border: none;
    }

    .search .header-nav button {
        background: none;
        border: none;
    }

    .search {
        /*padding: 2px 0;*/
        /*padding-right: 15px;*/
        border: 3px solid #95999c;
        /*width: 100%;*/

    }

    .search .bi {
        color: #95999c;
        font-size: 20px;
        line-height: 25px;
    }


    .search .bi-search {
        cursor: pointer;


    }

</style>
