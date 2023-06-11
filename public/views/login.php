<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include 'base-head-content.php' ?>
        <script src="public/js/utils/debounce.js" type="text/javascript" defer></script>
        <script src="public/js/views/login.js" type="text/javascript" defer></script>
    </head>

    <body>
        <div class="container">
            <div class="row content">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <header>
                        <h1>Login</h1>
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
                            <label for="password">
                                Password
                                <input id="password" minlength="6" name="password" type="password" placeholder="Enter password" required />
                            </label>
                        </div>
                        
                        <div>
                            <button class="btn btn-primary" id="login__action-button" type="button" disabled>Log in</button>
                        </div>
                    </form>

                    <div class="col-sm-12">
                        <a class="login__forgot-password" href="forgot-password">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'alert.php' ?>
    </body>
</html>
