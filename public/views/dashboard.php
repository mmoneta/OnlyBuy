<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/views/dashboard.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="public/js/main.js" defer></script>
        <script src="public/js/products.js" defer></script>
        <title>Only Buy</title>
    </head>

    <body>
        <div class="container">
            <div class="row dashboard__menu">
                <div class="col-md-6 col-sm-6 col-12">
                    <input placeholder="Search" type="search" />
                </div>

                <div class="col-md-3 col-sm-3 col-6 dashboard__menu-checkboxes">
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

            </div>
        </div>
    </body>
</html>
