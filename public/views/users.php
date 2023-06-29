<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include 'base-head-content.php' ?>
        <script src="<?= $domainLink ?>/public/js/views/users.js" type="text/javascript" defer></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12">
                    <header>
                        <img alt="Left arrow" id="left-arrow" src="<?= $domainLink ?>/public/icons/left-arrow.svg" />
                        <h1>Users</h1>
                    </header>
                </div>
                   
                <div class="col-md-12 col-sm-12 col-12">
                    <table id="users__table">
                        <tr>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Role</th>
                            <th>Created date</th>
                            <th>Modified date</th>
                            <th>Actions</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>