<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include 'base-head-content.php' ?>
        <script src="<?= $domainLink ?>/public/js/utils/debounce.js" type="text/javascript" defer></script>
        <script src="<?= $domainLink ?>/public/js/views/user-editor.js" type="text/javascript" defer></script>
    </head>

    <body>
        <div class="container">
            <div class="row content" style="display: none">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <header>
                        <img alt="Left arrow" id="left-arrow" src="<?= $domainLink ?>/public/icons/left-arrow.svg" />
                        <h1 id="user-editor__title"></h1>
                    </header>
                </div>    
                    
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <form>
                        <div>
                            <label for="username">
                                Username
                                <input id="username" minlength="5" name="username" type="text" placeholder="Enter username" required />
                            </label>
                        </div>

                        <div>
                            <label for="email">
                                E-mail
                                <input id="email" name="email" type="email" placeholder="Enter e-mail" required />
                            </label>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#change-password">Change password</a>
                            </li>

                            <li class="">
                                <a href="#change-role">Change role</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="change-password" class="tab-pane active"> 
                                <div>
                                    <label for="password">
                                        Password
                                        <input id="password" minlength="6" name="password" type="password" placeholder="Enter password" required />
                                    </label>
                                </div>

                                <div>
                                    <label for="repeat-password">
                                        Repeat password
                                        <input id="repeat-password" minlength="6" name="password" type="password" placeholder="Repeat password" required />
                                    </label>
                                </div>
                            </div> 

                            <div id="change-role" class="tab-pane">
                                <label for="role">
                                    Role
                                    <select name="role" id="role"></select>
                                </label>
                            </div>
                        </div>
                        
                        <div>
                            <button class="btn btn-primary" id="user-editor__action-button" type="button" disabled>Edit</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php include 'spinner.php' ?>
        </div>        
    </body>
</html>