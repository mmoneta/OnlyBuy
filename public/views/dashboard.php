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
                <div class="dashboard__content-empty">
                    <img src="public/icons/task-list.svg" alt="List of tasks">

                    <p>Ooops… It’s empty here</p>
                    <p>There are no products on the list</p>
                </div>
            </div>
        </div>
    </body>
</html>
