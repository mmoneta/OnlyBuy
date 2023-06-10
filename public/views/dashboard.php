<!DOCTYPE html>

<html lang="en">
    <head>  
        <title>Only Buy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/views/dashboard.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
        <script src="public/js/main.js" defer></script>
        <script src="public/js/views/products.js" defer></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row dashboard__menu">
                <div class="col-md-5 col-sm-6 col-12 p-0">
                    <input placeholder="Search" type="search" />
                </div>

                <div class="col-md-2 col-sm-4 col-6 dashboard__menu-checkboxes">
                    <label for="active">
                        <input id="active" type="checkbox" />
                        <span>Active</span>
                    </label> 

                    <label for="promo">
                        <input id="promo" type="checkbox" />
                        <span>Promo</span>
                    </label> 
                </div>
            </div>
            
            <div class="row dashboard__content">
                <div class="col-md-4">
                    <div class="col-md-12 dashboard__product">
                        <p>Test Mateusz</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="col-md-12 dashboard__product">
                        <p>Test Mateusz</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="col-md-12 dashboard__product">
                        <img
                            src="public/uploads/10_06_23_07_55_19_Tapeta-3000x2000 (ekran 16_10).png"
                            alt="Image of product"
                            class="w-100"
                        />

                        <h4>Test Mateusz</h4>

                        <p>Test Mateusz</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
