<?= $this->extend('layout'); ?>

<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<style>
    body {
        background: #eee;
        letter-spacing: 2px;
        min-height: 101vh;
    }

    a:hover, a:active {
        text-decoration: none;
    }

    input[type="text"], select {
        outline: none;
    }

    .col-xs-1 {
        padding: 0;
    }

    h1 {
        font-family: 'Arvo', sans-serif;
        color: #E35865;
    }

    header.container-fluid {
        margin: 0;
        background-color: #39404A;
        box-shadow: 0 0px 3px 3px rgba(0, 0, 0, .4);
        height: 100vh;
        min-height: 150px;
    }

    .container {
        max-width: 720px;
        margin: auto;
        padding: 0 50px;
    }

    ul {
        padding: 0;
    }

    li {
        letter-spacing: 0;
        padding: 30px;
        list-style: none;
        min-height: 200px;
        background: #fff;
        margin: 50px auto;
        text-align: left;
        -webkit-transition: box-shadow .2s ease-out .2s;
        -moz-transition: box-shadow .2s ease-out .2s;
        -o-transition: box-shadow .2s ease-out .2s;
        transition: box-shadow .2s ease-out .2s;
        word-spacing: 2px;
    }

    li > h3 {
        margin-top: 0;
        color: #E35865;
        line-height: 2;
    }

    li > p {
        color: #666;
        line-height: 2;
    }

    input {
        padding: 0;
        border-radius: 0;
        border: none;
        font-size: 20px;
        color: #bbb;
        background: none;
        letter-spacing: 1px;
        word-spacing: 10px;
        font-family: 'Arvo', sans-serif;
        padding: 0;
        line-height: 25px;
    }

    #searchBox {
        padding-top: 40vh;
    }

    button {
        background: none;
        border: none;
    }

    .form {
        padding: 10px 0;
        padding-right: 15px;
        border: 3px solid #E35865;

    }

    .form.col-xs-12 {
        padding-left: 0;
    }

    .glyphicon {
        color: #E35865;
        font-size: 20px;
        line-height: 25px;
    }

    .glyphicon-search {
        cursor: pointer;

    }

    .glyphicon-search:hover {

    }

    .bar {
        vertical-align: super;
        font-weight: 700;
        font-size: 22px;
        font-family: 'Montserrat', sans-serif;
    }


    li:hover {
        box-shadow: 0 0 15px 15px rgba(0, 0, 0, .1);
    }

    ::-webkit-input-placeholder {
        color: #bbb;
        opacity: 1;
    }

    :-moz-placeholder { /* Firefox 18- */
        color: #bbb;
        opacity: 1;
    }

    ::-moz-placeholder { /* Firefox 19+ */
        color: #bbb;
        opacity: 1;
    }

    :-ms-input-placeholder {
        color: #bbb;
        opacity: 1;
    }

    #mainBody {
        font-family: 'Montserrat', sans-serif;
    }

    /*********media query starts ***********/

    @media screen and (max-width: 420px) {
        #searchBar, .glyphicon {
            font-size: 16px;
        }

        h1 {
            font-size: 28px;
        }
    }
</style>
<?= $this->section('sidebar'); ?>
<div class="p-3 bg-white justify-content-end" style="width: 280px;">
    <a href="" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold">Products</span>
    </a>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center active">
                <a href="?all">
                    All Products
                </a>

            </button>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#dashboard-collapse" aria-expanded="false">
                Laptops
            </button>
            <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="?lenovo" class="link-dark rounded">Lenovo</a></li>
                    <li><a href="?hp" class="link-dark rounded">HP</a></li>
                    <li><a href="?dell" class="link-dark rounded">Dell</a></li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#orders-collapse" aria-expanded="false">
                Phones
            </button>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="?samsung" class="link-dark rounded">Samsung</a>
                        <span class="badge rounded-pill">88
                                <span class="visually-hidden">shopping items</span>
                        </span>
                    </li>
                    <li><a href="?iphone" class="link-dark rounded">iPhone</a></li>
                    <li><a href="?huawei" class="link-dark rounded">Huawei</a></li>
                </ul>
            </div>
        </li>
        <li class="border-top my-3"></li>
    </ul>
</div>
<?= $this->endSection(); ?>

<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

<?= $this->section('content'); ?>
<header class="container-fluid">
    <div class="container text-center" id="searchBox">
        <h1>Product Search</h1>
        <div class="form col-xs-12">
            <input class="col-xs-9" id="searchBar" type="text" placeholder="search"/>
            <span class="bi bi-search col-xs-1" data-toggle="tooltip" title="Search"></span>
            <span class="bi bar col-xs-1" id="submit"><b>|</b></span>
            <a href="https://en.wikipedia.org/wiki/Special:Random" target="_blank"><span
                        class="bi bi-random col-xs-1" data-toggle="tooltip"
                        title="Random topic"></span></a>
        </div>
    </div>
</header>
<div id="mainBody" class="container text-center">
    <ul id="results">
    </ul>
</div>
<footer class="text-center">

</footer>
<?= $this->endSection(); ?>


