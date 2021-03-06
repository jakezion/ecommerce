<!--https://codepen.io/arshdkhn1/pen/pymzWz-->
<!--<i class="bi bi-basket2"></i>-->
<!--<i class="bi bi-basket2-fill"></i>-->
<!--https://stackoverflow.com/questions/43439250/bootstrap-4-stop-collapse-from-pushing-content-down-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">


        <div class="col-4">
            <a class="navbar-brand" href="/">Web Technologies</a>
        </div>

        <div class="col-4">

                <nav class="navbar-expand-sm navbar-dark bg-dark">

                    <div class="container-fluid">

                        <div class="d-flex justify-content-center">

                            <div class="navbar-nav">

                                <a class="nav-link" aria-current="page" href="/">Home</a>

                                <a class="nav-link" href="/inv">Product Search</a>

                                <a class="nav-link" href="/inv">All Products</a>

                                <a class="nav-link" href="/inv/laptop">Laptops</a>

                                <a class="nav-link" href="/inv/phone">Mobile Phones</a>

                                <?php if (session()->authenticated): ?>

                                    <a class="nav-link" href="/profile">Profile</a>

                                    <a class="nav-link" href="/basket">Shopping Basket</a>

                                <?php endif; ?>

                                <?php if (session()->admin): ?>

                                    <a class="nav-link" href="/basket">All Purchases</a>

                                <?php endif; ?>
                            </div>


                        </div>
                    </div>

        </div>


        <div class="col-4">
            <div class="navbar-nav d-flex justify-content-end">

                <a class="nav-link " href="/login"> <i class="bi bi-person"></i>

                    <?php if (session()->authenticated) : ?>
                        <?= 'Logout'; ?>
                    <?php else: ?>
                        <?= 'Login'; ?>
                    <?php endif; ?>

                </a>

            </div>
        </div>
</nav>


<style>
    .loginlogout a {
        color: #586e75;
        text-decoration: none;
    }

    .loginlogout a:visited {
        color: #586e75;
        text-decoration: none;
    }

    .loginlogout a:hover {
        color: #586e75;
        text-decoration: none;
    }

    .loginlogout a:active {
        color: #586e75;
        text-decoration: none;
    }

    #searchbarCollapse {
        position: absolute;
        width: 100%;
        z-index: 1;
    }

    .header-nav {
        position: relative;
    }

    .header-nav a:hover, a:active {
        text-decoration: none;
    }

    .header-nav input[type="text"], select {
        outline: none;
    }

    .header-nav .col-xs-1 {
        padding: 0;
    }

    .header-nav h1 {
        font-family: 'Arvo', sans-serif;
        color: #383e40;
    }

    .header-nav header.container-fluid {
        /*margin: 0;*/
        /*background-color: #fff;*/

    }

    .header-nav .container {
        margin: auto;
        /*padding: 0 50px;*/
    }

    /*.header-nav ul {*/
    /*    padding: 0;*/
    /*}*/

    /*.header-nav li {*/
    /*    letter-spacing: 0;*/
    /*    !*padding: 30px;*!*/
    /*    list-style: none;*/
    /*    !*min-height: 200px;*!*/
    /*    background: #383e40;*/
    /*    margin: 50px auto;*/
    /*    text-align: left;*/
    /*    -webkit-transition: box-shadow .2s ease-out .2s;*/
    /*    -moz-transition: box-shadow .2s ease-out .2s;*/
    /*    -o-transition: box-shadow .2s ease-out .2s;*/
    /*    transition: box-shadow .2s ease-out .2s;*/
    /*    word-spacing: 2px;*/
    /*}*/

    /*.header-nav li > h3 {*/
    /*    margin-top: 0;*/
    /*    color: #383e40;*/
    /*    line-height: 2;*/
    /*}*/

    /*.header-nav li > p {*/
    /*    color: #666;*/
    /*    line-height: 2;*/
    /*}*/

    .search .form-control {
        border-radius: 0;
        border: none;
        font-size: 20px;
        color: #383e40;
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
        color: #666;
        background-color: transparent;
        border-color: transparent;
        outline: 0;
        box-shadow: none;
    }


    .search select.form-control:focus::-ms-value {
        color: #666;
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
        padding: 2px 0;
        /*padding-right: 15px;*/
        border: 3px solid #383e40;
        /*width: 75%;*/

    }


    /*.form.col-xs-12{*/
    /*    padding-left: 0;*/
    /*}*/
    .ex .bi {
        color: #383e40;
        font-size: 25px;
        line-height: 25px;
    }

    .header-nav .bi {
        color: #383e40;
        font-size: 25px;
        line-height: 25px;
    }

    .search .bi {
        color: #383e40;
        font-size: 20px;
        line-height: 25px;
    }


    .search .bi-search {
        cursor: pointer;


    }

    .header-nav .bi-person {
        cursor: pointer;

    }

    .header-nav .bi-search {
        cursor: pointer;
    }

    .ex .bi-x {
        cursor: pointer;
    }

    .header-nav .bi-basket2 {
        cursor: pointer;

    }

    .header-nav .bi-person:hover {

    }

    .header-nav .bi-basket2:hover {

    }

    .header-nav .bi-search:hover {

    }

    .header-nav .bar {
        vertical-align: super;
        font-weight: 700;
        font-size: 22px;
        font-family: 'Montserrat', sans-serif;
    }


    .header-nav li:hover {
        box-shadow: 0 0 15px 15px rgba(0, 0, 0, .1);
    }

    .header-nav ::-webkit-input-placeholder {
        color: #383e40;
        opacity: 1;
    }

    .header-nav :-moz-placeholder { /* Firefox 18- */
        color: #383e40;
        opacity: 1;
    }

    .header-nav ::-moz-placeholder { /* Firefox 19+ */
        color: #383e40;
        opacity: 1;
    }

    .header-nav :-ms-input-placeholder {
        color: #383e40;
        opacity: 1;
    }

    .header-nav #mainBody {
        font-family: 'Montserrat', sans-serif;
    }

    /*********media query starts ***********/

    .header-nav

    @media screen and (max-width: 420px) {
        #searchBar, .bi {
            font-size: 16px;
        }

        h1 {
            font-size: 28px;
        }
    }

    .search

    @media screen and (max-width: 420px) {
        #searchBar, .bi {
            font-size: 16px;
        }

        h1 {
            font-size: 28px;
        }
    }

    .ex

    @media screen and (max-width: 420px) {
        #searchBar, .bi {
            font-size: 16px;
        }

        h1 {
            font-size: 28px;
        }
    }

</style>

<script>
    // $(document).ready(function(){
    //     var keyword = "";
    //     var resultArea = $("#results");
    //     var searchBar = $("#searchBar");
    //     var searchButton = $(".glyphicon-search");
    //     var searchUrl = "https://en.wikipedia.org/w/api.php";
    //     var displayResults = function(){
    //         $.ajax({
    //             url: searchUrl,
    //             dataType: 'jsonp',
    //             data: {
    //                 action: 'query',
    //                 format: 'json',
    //                 generator: 'search',
    //                 gsrsearch: keyword,
    //                 gsrnamespace: 0,
    //                 gsrlimit: 10,
    //                 prop:'extracts|pageimages',
    //                 exchars: 200,
    //                 exlimit: 'max',
    //                 explaintext: true,
    //                 exintro: true,
    //                 piprop: 'thumbnail',
    //                 pilimit: 'max',
    //                 pithumbsize: 200
    //             },
    //             success: function(json){
    //                 var results = json.query.pages;
    //                 $.map(results, function(result){
    //                     var link = "http://en.wikipedia.org/?curid="+result.pageid;
    //                     var elem1 = $('<a>');
    //                     elem1.attr("href",link);
    //                     elem1.attr("target","_blank");
    //                     var elem2 = $('<li>');
    //                     elem2.append($('<h3>').text(result.title));
    //                     //if(result.thumbnail) elem.append($('<img>').attr('width',150).attr('src',result.thumbnail.source));
    //                     elem2.append($('<p>').text(result.extract));
    //                     elem1.append(elem2);
    //                     resultArea.append(elem1);
    //                 });
    //                 $("footer").append("<p>----x--------x----</p>");
    //             }
    //         });
    //     };
    //     /*
    //      searchBar.autocomplete({
    //            source: function (request, response) {
    //                $.ajax({
    //                    url: searchUrl,
    //                    dataType: 'jsonp',
    //                    data: {
    //                        'action': "opensearch",
    //                        'format': "json",
    //                        'search': request.term
    //                    },
    //                    success: function (data) {
    //                        response(data[1]);
    //                    }
    //                });
    //            }
    //        });
    //      */
    //     searchButton.click(function(){
    //         keyword = searchBar.val();
    //         resultArea.empty();
    //         $("footer").empty();
    //         displayResults();
    //         $("#searchBox").animate({'padding-top':"0"}, 600);
    //         $(".container-fluid").animate({height:"30vh"}, 600);
    //     });
    //
    //     searchBar.keypress(function(e){
    //         if(e.keyCode==13)
    //             $(searchButton).click();
    //     });
    //
    // });

</script>
