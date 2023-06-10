<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/views/product-creator.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="public/js/debounce.js" defer></script>
        <script src="public/js/main.js" defer></script>
        <script src="public/js/product-creator.js" defer></script>
        <title>Only Buy</title>
    </head>

    <body>
        <div class="container">
            <div class="row product-creator__content">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <header class="col-md-12">
                        <h1>Creator of product</h1>
                    </header>
                    
                    <form class="col-md-12">
                        <div>
                            <label for="name">
                                Name
                                <input id="name" minlength="5" name="name" type="text" placeholder="Enter name" required />
                            </label>
                        </div>

                        <div>
                            <label for="description">
                                Description
                                <textarea id="description" name="description" placeholder="Enter description" required></textarea>
                            </label>
                        </div>

                        <div>
                            <label for="image">Choose images to upload (PNG, JPG)</label>

                            <button
                                onclick="document.getElementById('images').click()"
                                class="btn btn-secondary"
                                type="button"
                            >
                                Select file
                            </button>

                            <input accept=".jpg, .jpeg, .png" id="images" name="images" type="file" multiple />

                            <div class="preview">
                                <p>No files currently selected for upload</p>
                            </div>
                        </div>

                        <div>
                            <label for="promo">
                                Promo
                                <input id="promo" name="promo" type="checkbox" />
                            </label>
                        </div>

                        <div>
                            <label for="active">
                                Active
                                <input id="active" name="active" type="checkbox" />
                            </label>
                        </div>
                        
                        <div>
                            <button class="btn btn-primary" id="product-creator__action-button" type="button" disabled>Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>