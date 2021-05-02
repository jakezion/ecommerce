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
    <div class="container text-center" id="searchBox">
        <h1>Product Search</h1>

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

    </div>
</header>
<div class="container text-center">
    <div name="results" id="results">

    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>

    //todo on doc ready on page create do an ajax call for data gathered in categories
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
        //$.post("<?//= base_url('inv/get')?>//", {'category': 'all'}, function (data) {
        //    console.log('Successful Request Send');
        //})
        //    .done(function (data) {
        //        getProducts();
        //        let html = '<option selected disabled>Select Category</option>';
        //        html += '<option value="">All Products</option>';
        //        data.forEach(category => {
        //            html += `<option value="${category}">${category}</option>`;
        //        });
        //        $('#category').html(html);
        //    })
        //    .fail(function (data) {
        //        console.log('No Categories Exist');
        //       // $("#category").html('');
        //    });

        $.ajax({
            type: "post",
            url: "<?= base_url('inv/get')?>",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: {'categories': 'all'},
            dataType: "json", //todo fix by parsing json data and then encoding it on return
            success: function (data) {
                getProducts();
                let html = '<option selected disabled>Select Category</option>';
                html += '<option value="">All Products</option>'; //todo change to allow products to be getted for ajax
                data.forEach(category => {
                    html += `<option value="${category}">${category.charAt(0).toUpperCase() + category.slice(1)}</option>`;
                });
                $('#category').html(html);
            },
            error: function (e) {

                //getProducts();
                console.error("error", e); //todo change to something appropriate
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

        /* TODO FIX ${description.forEach(line => {
                                   console.log(line);
                               })}*/

        $.post(url, {"product_category": category, "product_brand": brand}, function (data) {
            console.log('Successful Request Send');
        })
            .done(function (data) {
                console.log(data);
                let html = `<div class="row row-cols-1 row-cols-md-3 g-4">`;
                data.forEach(product => {
                    let description = product.description.split("-");


                    html += `<div class="col">
            <div class="card h-100">
            <a style="text-decoration: none; color: black" href="/inv/${product.productID}">
            <img src="${product.image}" class="card-img-top" alt="${product.name}"">
            </a>
            <div class="card-body">
            <hr/>
                <h5 class="card-title">${product.name} |
                <a style="text-decoration: none; color: black" href="/inv/${product.category}"><kbd>${product.category}</kbd></a> |
                <a style="text-decoration: none; color: black" href="/inv/${product.category}/${product.brand}"><kbd>${product.brand}</kbd></a>
            </h5>
                 <hr/>


                <p class="card-text" id="description">${product.description} </p>
                <div class="row">
                     <div class="col">
                           <div class="form-control">&pound;${product.price}</div>
                                </div>
                                    <div class="col">
                                        <div class="btn-group">
                                        <a class="btn btn btn-outline-secondary" href="/inv/${product.productID}">
                                        <i class="fas fa-eye"></i> View</a>
                                        <?php if (session()->get('authenticated')):?>
                                            <button class="btn btn-dark" type="submit" onclick="addToBasket(${product.productID});">Add To Cart</button>
                                         <?php endif; ?>
                                        </div>
                                   </div>
                               </div>
                          </div>
                     </div>
                </div>`;

                });
                html += `</div>`;
                $('#results').html(html);
            })
            .fail(function (data) {
                console.log('Products Do Not Exist');
                $("#results").html('');
            });

    }


    function addToBasket(productID) {
        let quantity = 1;
        console.log(productID);
        $.post(`/basket/add/${productID}/${quantity}`, function (data) {
            console.log('Cart Successfully Reached');
        })
            .done(function (data) {
                console.log(data);
            })
            .fail(function () {
                console.log('Product Couldn\'t be added to the basket.');

            });

        // switch (data.status) {
        //     case 200:
        //         $("#addButton-" + productID).html("Added").prop("disabled", true);
        //         setTimeout(function () {
        //             $("#addButton-" + productID).html("<i class=\"fas fa-cart-plus\"></i> Add").prop("disabled", false);
        //         }, 1000);
        //         break;
        //     case 404:
        //         alert("Product not found!");
        //         break;
        //     default:
        //         break;
        //
        // }
    }


    //todo on change of brand value update

</script>
<?= $this->endSection(); ?>





