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


<?= $this->section('content'); ?>
<header class="container-fluid">
    <div class="container text-center mb-4 mt-4" id="searchBox">
        <h1>Product Search</h1>
        <hr>
        <div class="input-group mb-4">
            <div class="col-1"></div>
            <div class="col">
                <select class="form-select form-control" name="category" id="category" aria-label="Select Category">
                </select>
            </div>
            <div class="col-1"></div>
            <div class="col">
                <select class="form-select form-control" name="brand" id="brand" aria-label="Select Brand">
                </select>
            </div>
            <div class="col-1"></div>
        </div>
        <hr>
    </div>
</header>
<div class="container text-center mt-4">
    <div name="results" id="results">

    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>

    $(document).ready(function () {

        getCategory();

        $("#category").on("change", function (e) {
            getBrand(e);
        });

        $("#brand").on("change", function (e) {
            e.preventDefault();

            let brand = $('#brand').val();
            let category = $('#category').val();
            let url = `<?= base_url('inv');?>/${category}/${brand}`;

            history.pushState({'category': category, 'brand': brand}, '', url);

            getProducts();

        });

    });

    function getCategory() {
        $.ajax({
            type: "post",
            url: "<?= base_url('inv/get')?>",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: {'categories': 'all'},
            dataType: "json",
            success: function (data) {
                getProducts();
                let html = '<option selected disabled>Select Category</option>';
                html += '<option value="">All Products</option>';
                data.forEach(category => {
                    html += `<option value="${category}">${category.charAt(0).toUpperCase() + category.slice(1)}</option>`;
                });
                $('#category').html(html);
            },
            error: function (e) {
                console.error("error: categories couldn\'t be found");
            },
        });
    }

    function getBrand(e) {
        e.preventDefault();

        //post data to correct url with category data to display related brands
        let category = $("#category").val();

        let url = `<?= base_url('inv');?>/${category}`;

        history.pushState(category, '', url);

        if (category !== '') {
            $.post("<?= base_url('inv/get')?>", {'category': category}, function (data) {
                console.log('Successful Request Send');
            })
                .done(function (data) {
                    getProducts();
                    let html = '<option selected disabled>Select Brand</option>';
                    data.forEach(brand => {
                        html += `<option value="${brand}">${brand.charAt(0).toUpperCase() + brand.slice(1)}</option>`;
                    });
                    $('#brand').html(html);
                })
                .fail(function (data) {
                    console.log('No Brands Exist');
                });

        } else {
            getProducts();
            $('#brand').html('<option selected disabled>Select Brand</option>');

        }
    }

    function getProducts() {
        let path = location.pathname.split("/");
        let segments = [];

        path.forEach(segment => {
            if (segment !== '') {
                segments.push(segment);
            }
        });

        let category = typeof segments[1] !== 'undefined' ? segments[1] : segments[1] = 'all';
        let brand = typeof segments[2] !== 'undefined' ? segments[2] : segments[2] = 'all';
        let url = '<?= base_url()?>' + location.pathname;


        $.post(url, {"product_category": category, "product_brand": brand}, function (data) {
            console.log('Successful Request Send');
        })
            .done(function (data) {

                let html = ``;

                data.forEach(product => {

                    let bullets = product.description.split("-");

                    let description = `<ul class="text-start">`;

                    bullets.forEach(i => {
                        description += `<li>${i} </li>`;
                    });
                    description += `</ul>`;

                    html += `
                    <div class="card mb-3 h-15 p-2">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <a style="text-decoration: none; color: black" href="/inv/${product.productID}">
                                <img src="${product.image}" class="card-img-top" alt="${product.name}">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>${product.name}</strong></h5>
                                    <hr/>
                                    <p class="card-text text-start" name="description2" id="description2">${description}</p>
                                    <hr/>
                                    <p class="card-text">
                                    <div class="row">
                                        <div class="col">
                                                <div class="form-control">&pound;${product.price}</div>
                                        </div>
                                        <div class="col">
                                                     <?php if (session()->get('authenticated')):?>
                                                     <div class="input-group">
                                            <a class="btn btn-outline-secondary" href="/inv/${product.productID}">
                                            <i class="bi bi-arrow-down-short"></i>&nbsp; &nbsp; &nbsp; View  &nbsp; &nbsp; &nbsp;&nbsp;</a>
                                            <button class="btn btn-dark form-control" type="submit" name="basketButton${product.productID}" id="basketButton${product.productID}" onclick="addToBasket(${product.productID});">
                                            <i class="bi bi-basket3"></i>  Add To Basket</button>
                                            </div>
                                                 <?php else : ?>
                                                 <a class="btn form-control btn-outline-secondary" href="/inv/${product.productID}">
                                                 <i class="bi bi-arrow-down-short"></i>View
                                                 </a>
                                                 <?php endif; ?>
                                        </div>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                });

                $('#results').html(html);


            })
            .fail(function (data) {
                console.log('Products Do Not Exist');
                $("#results").html('');
            });

    }


    function addToBasket(productID) {
        let quantity = 1;

        $.getJSON('/basket/add/' + productID + '/' + quantity, function (data) {

            console.log('Cart Successfully Reached');
        })
            .done(function (data) {

                $("#basketButton" + productID).removeClass('btn-dark').addClass('btn-secondary').html("<i class=\"bi bi-basket3-fill\"> Added");
                setTimeout(function () {
                    $("#basketButton" + productID).removeClass('btn-secondary').addClass('btn-dark').html("<i class=\"bi bi-basket3\"> Add to Basket");
                }, 1000);
            })
            .fail(function () {
                console.log('Product Couldn\'t be added to the basket.');
            });

    }


    //todo on change of brand value update

</script>
<?= $this->endSection(); ?>





