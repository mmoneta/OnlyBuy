<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include 'base-head-content.php' ?>
        <script src="public/js/utils/debounce.js" type="text/javascript" defer></script>
        <script src="public/js/views/product-creator.js" type="text/javascript" defer></script>
    </head>

    <body>
        <div class="container">
            <div class="row content">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <header>
                        <img alt="Left arrow" id="left-arrow" src="public/icons/left-arrow.svg" />
                        <h1>Creator of product</h1>
                    </header>
                </div>    
                    
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-12">
                    <form>
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

                            <input
                                accept=".jpg, .jpeg, .png"
                                class="d-none"
                                id="images"
                                name="images"
                                type="file"
                                multiple
                            />

                            <div class="preview">
                                <p>No files currently selected for upload</p>
                            </div>
                        </div>

                        <div>
                            <input id="promo" name="promo" type="checkbox" />
                            <label for="promo">Promo</label> 
                        </div>

                        <div>
                            <input id="active" name="active" type="checkbox" />
                            <label for="active">Active</label> 
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