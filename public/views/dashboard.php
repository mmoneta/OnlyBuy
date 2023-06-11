<!DOCTYPE html>

<html lang="en">
    <head>  
        <?php include 'base-head-content.php' ?>
        <link rel="stylesheet" type="text/css" href="public/css/views/dashboard.css">
        <script src="public/js/views/products.js" type="text/javascript" defer></script>
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
                        <img
                            src="public\uploads\product\41\11_06_23_09_21_27_Screenshot_2023-04-28_132318.png"
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
