<!DOCTYPE html>

<html lang="en">
    <head>  
        <?php include 'base-head-content.php' ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $domainLink ?>/public/css/views/dashboard.css">
        <script src="<?php echo $domainLink ?>/public/js/utils/debounce.js" type="text/javascript" defer></script>
        <script src="<?php echo $domainLink ?>/public/js/views/dashboard.js" type="text/javascript" defer></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row dashboard__menu">
                <div class="col-md-5 col-sm-6 col-12 p-0">
                    <input placeholder="Search" type="search" />
                </div>

                <div class="col-md-3 col-sm-4 col-6 dashboard__menu-checkboxes">
                    <input id="active" name="active" type="checkbox" checked />
                    <label for="active">Active</label> 

                    <input id="promo" name="promo" type="checkbox" />
                    <label for="promo">Promo</label>
                </div>

                <div class="col-md-offset-2 col-md-2 col-sm-offset-1 col-sm-1 col-6" id="dashboard__dropdown">
                    
                </div>
            </div>
            
            <div class="row dashboard__content">
                <div class="dashboard__content-empty">
                    <img src="public/icons/task-list.svg" alt="List of tasks">

                    <p>Ooops… It’s empty here</p>
                    <p>There are no products on the list</p>
                </div>
            </div>

            <img id="spinner" src="public/icons/spinner.svg" alt="Spinner">
        </div>

        <?php include 'modal.php' ?>
    </body>
</html>
