<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include 'base-head-content.php' ?>
        <script src="<?php echo $domainLink ?>/public/js/utils/debounce.js" type="text/javascript" defer></script>
        <script src="<?php echo $domainLink ?>/public/js/views/user-creator.js" type="text/javascript" defer></script>
    </head>

    <body>
        <div class="container">
            <div class="row content">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <header>
                        <img
                            alt="Left arrow"
                            id="left-arrow"
                            src="<?php echo $domainLink ?>/public/icons/left-arrow.svg"
                        />
                        <h1>Creator of user</h1>
                    </header>
                </div>    
                    
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <form>
                        <?php include 'base-user-creator.php' ?>

                        <label for="role">
                            Role
                            <select name="role" id="role"></select>
                        </label>
                        
                        <div>
                            <button class="btn btn-primary" id="user-creator__action-button" type="button" disabled>Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>