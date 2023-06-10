<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Only Buy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/views/login.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
        <script src="public/js/utils/debounce.js" defer></script>
        <script src="public/js/main.js" defer></script>
        <script src="public/js/views/login.js" defer></script>
    </head>

    <body>
        <div class="container">
            <div class="row login__content">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <header class="col-md-12">
                        <h1>Login</h1>
                    </header>
                    
                    <form class="col-sm-12">
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

        <div id="alert-container"></div>
    </body>
</html>
