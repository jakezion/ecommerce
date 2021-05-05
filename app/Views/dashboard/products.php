<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<header class="container-fluid">
    <div class="container text-center mb-4 mt-4" id="searchBox">
        <h1>Product Search</h1>
        <hr>
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
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

        //get inital categories available
        getCategory();


        //on category change, get brands for that category
        $("#category").on("change", function (e) {
            getBrand();
        });


        //on brand change, get products for that category and brand
        $("#brand").on("change", function (e) {
            e.preventDefault();

            let brand = $('#brand').val();
            let category = $('#category').val();
            let url = `<?= base_url('inv');?>/${category}/${brand}`;

            history.pushState({'category': category, 'brand': brand}, '', url);

            getProducts();

        });

    });

    //get the current url value and return its category and brand
    function categoryBrand() {
        let path = location.pathname.split("/");
        let segments = [];

        path.forEach(segment => {
            if (segment !== '') {
                segments.push(segment);
            }
        });

        let category = typeof segments[1] !== 'undefined' ? segments[1] : segments[1] = 'all';
        let brand = typeof segments[2] !== 'undefined' ? segments[2] : segments[2] = 'all';
        return {'category': category, 'brand': brand};

    }

    //get the categories available, populate the dropdown box and get the products for category
    function getCategory() {

        let data = categoryBrand();

        $.getJSON('/dashboard/categories/' + data.category + '/' + data.brand, function (data) {
            //console.log('category Successfully Reached');
        })
            .done(function (data) {
                getProducts();
                let html = '<option selected disabled>Select Category</option>';
                html += '<option value="">All Products</option>';
                data.forEach(category => {
                    html += `<option value="${category}">${category.charAt(0).toUpperCase() + category.slice(1)}</option>`;
                });
                $('#category').html(html);
            })
            .fail(function (e) {
                //console.error("error: categories couldn\'t be found");
            });
    }


    //get the brands available for that category, populate the brands dropdown box and get the products for category and brand
    function getBrand() {


        //get data to correct url with category data to display related brands
        let category = $("#category").val();

        let url = `<?= base_url('inv');?>/${category}`;

        history.pushState(category, '', url);

        let data = categoryBrand();

        //if cateogry isnt 'all' then get category brands, otherwise display disabled brand option
        if (data.category !== 'all') {
            $.getJSON('/dashboard/brand/' + data.category + '/' + data.brand, function (data) {
                //console.log('Successful Request Send');
            })
                .done(function (data) {
                    //console.log(data);
                    getProducts();
                    let html = '<option selected disabled>Select Brand</option>';
                    data.forEach(brand => {
                        html += `<option value="${brand}">${brand.charAt(0).toUpperCase() + brand.slice(1)}</option>`;
                    });
                    $('#brand').html(html);
                })
                .fail(function (data) {
                    //console.log('No Brands Exist');
                });
        } else {
            getProducts();
            $('#brand').html('<option selected disabled>Select Brand</option>');
        }
    }

    //get products with provided category and brand
    function getProducts() {

        let data = categoryBrand();
//jquery simplification for an ajax call
        $.getJSON("/dashboard/inventory/" + data.category + "/" + data.brand, function (data) {
            //console.log('Successful Request Send products');
        })
            .done(function (data) {
                // console.log(data)
                let html = ``;

                data.forEach(product => {

                    let bullets = product.description.split("-");

                    let description = `<ul class="text-start">`;

                    bullets.forEach(i => {
                        description += `<li>${i}</li>`;
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
                //e.log('Products Do Not Exist');
                $("#results").html('');
            });

    }

    //adds products to the basket if the user is authenticated
    function addToBasket(productID) {
        let quantity = 1;

        $.getJSON('/basket/add/' + productID + '/' + quantity, function (data) {

            //console.log('Cart Successfully Reached');
        })
            .done(function (data) {

                $("#basketButton" + productID).removeClass('btn-dark').addClass('btn-secondary').html("<i class=\"bi bi-basket3-fill\"> Added");
                setTimeout(function () {
                    $("#basketButton" + productID).removeClass('btn-secondary').addClass('btn-dark').html("<i class=\"bi bi-basket3\"> Add to Basket");
                }, 1000);
            })
            .fail(function () {
                //e.log('Product Couldn\'t be added to the basket.');
            });

    }


    //todo on change of brand value update

</script>
<?= $this->endSection(); ?>





