<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/views/register.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="public/js/debounce.js" defer></script>
        <script src="public/js/main.js" defer></script>
        <script src="public/js/register.js" defer></script>
        <title>Only Buy</title>
    </head>

    <body>
        <div class="container">
            <div class="row register__content">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <header class="col-md-12">
                        <h1>Register</h1>
                    </header>
                    
                    <form class="col-md-12">
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
                        
                        <div>
                            <button class="btn btn-primary" id="register__action-button" type="button" disabled>Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>