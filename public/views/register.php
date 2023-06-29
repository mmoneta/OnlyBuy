<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include 'base-head-content.php' ?>
        <script src="<?= $domainLink ?>/public/js/utils/debounce.js" type="text/javascript" defer></script>
        <script src="<?= $domainLink ?>/public/js/views/register.js" type="text/javascript" defer></script>
    </head>

    <body>
        <div class="container">
            <div class="row content">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <header>
                        <img alt="Left arrow" id="left-arrow" src="<?= $domainLink ?>/public/icons/left-arrow.svg" />
                        <h1>Register</h1>
                    </header>
                </div>    
                    
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <form>
                        <?php include 'base-user-creator.php' ?>

                        <div>
                            <button class="btn btn-primary" id="register__action-button" type="button" disabled>Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'alert.php' ?>
    </body>
</html>