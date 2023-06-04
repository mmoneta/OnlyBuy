<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/login.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="public/js/login.js" defer></script>
        <title>Only Buy</title>
    </head>

    <body>
        <div class="container">
            <div class="row login__content">
                <div class="col-md-9 col-md-offset-3">
                    <header class="col-md-12">
                        <h1>Login</h1>
                    </header>
                    
                    <form class="col-md-12">
                        <div>
                            <label for="username">
                                Username
                                <input id="username" name="username" type="text" placeholder="Enter username" />
                            </label>
                        </div>

                        <div>
                            <label for="password">
                                Password
                                <input id="password" name="password" type="password" placeholder="Enter password" />
                            </label>
                        </div>
                        
                        <div>
                            <button class="btn btn-primary" id="login__action-button" type="button">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
