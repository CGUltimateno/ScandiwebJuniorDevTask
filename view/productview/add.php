<nav class="navbar bg-transparent">
    <div class="container px-auto">
    <h2 class="navbar-brand my-auto">Product Add</h2>
    <span>
        <button form="product_form" class="btn btn-outline-success" type="submit">Submit</button>
        <a href="/juniortask/" type="button" class="btn btn-outline-danger">Cancel</a>
            </span>
    </div>
</nav>
<?php echo("<hr>");
 if (!empty($errors)) : ?>
    <div class="container mb-5 alert alert-danger">
        <h5>Data Validation failed.</h5>
        <ul class="m-0">
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container">
    <form method="post" id="product_form" class="needs-validation" novalidate>
        <fieldset>
            <div class="row mb-3 g-3 align-items-center">
                <div class="col-sm-2 col-lg-1">
                    <label for="sku" class="col-form-label">SKU</label>
                </div>
                <div class="col-sm-auto position-relative">
                    <input required type="text" id="sku" name="sku" class="form-control" value="<?= $product->data['sku'] ?? '' ?>">
                    <div id="skuFeedback" class="invalid-feedback">
                        Please enter a SKU.
                    </div>
                </div>
            </div>

            <div class="row mb-3 g-3 align-items-center">
                <div class="col-sm-2 col-lg-1">
                    <label for="name" class="col-form-label">Name</label>
                </div>
                <div class="col-sm-auto">
                    <input required type="text" id="name" name="name" value="<?= $product->data['name'] ?? '' ?>" class="form-control">
                    <div class="invalid-feedback">
                        Please type in a name.
                    </div>
                </div>
            </div>
            <div class="row mb-3 g-3 align-items-center">
                <div class="col-sm-2 col-lg-1">
                    <label for="price" class="col-form-label">Price ($)</label>
                </div>
                <div class="col-sm-auto">
                    <input required type="number" step=".01" min=".01" id="price" name="price" value="<?= $product->data['price'] ?? '' ?>" class="form-control">
                    <div class="invalid-feedback">
                        Please type in a valid price.
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="row mb-5 g-3 align-items-center">
            <div class="col-sm-2 col-lg-1">
                <label for="productType">Product Type</label>
            </div>
            <div class="col-sm-auto">
                <select required id="productType" name="type" class="form-select">
                    <option <?php if (!($product->data['type'] ?? '')) echo "selected"; ?> value="">Type Switcher</option>

                    <?php foreach ($product::$types ?? '' as $value) : ?>
                        <option <?php if (($product->data['type'] ?? '') === $value) echo "selected"; ?> value="<?= $value ?>"><?= $value ?></option>
                    <?php endforeach ?>

                </select>
                <div class="invalid-feedback">
                    Please select a product type.
                </div>
            </div>
        </div>

        <div id="descriptions" class="mb-5">
            <fieldset id="dvdDescription" class="d-none">
                <div class="row mb-1">
                    <legend>Type in a size</legend>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="size" class="col-form-label">Size (MBs)</label>
                    </div>
                    <div class="col-sm-auto">
                        <input type="number" step="1" min="1" id="size" name="size" class="form-control" value="<?= $product->data['size'] ?? '' ?>">
                        <div class="invalid-feedback">
                            Please choose a correct size.
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <span class="form-text">
                            Please enter a positive Size.
                        </span>
                    </div>
                </div>
            </fieldset>

            <fieldset id="bookDescription" class="d-none">
                <div class="row mb-1">
                    <legend>Type in a Weight</legend>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="size" class="col-form-label">Weight (KGs)</label>
                    </div>
                    <div class="col-sm-auto">
                        <input type="number" step="1" min="1" id="weight" name="weight" class="form-control" value="<?= $product->data['weight'] ?? '' ?>">
                        <div class="invalid-feedback">
                            Please enter a valid Weight.
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <span class="form-text">
                            Please enter a positive Weight.
                        </span>
                    </div>
                </div>
            </fieldset>

            <fieldset id="furnitureDescription" class="d-none">
                <div class="row mb-1">
                    <legend>Type in the dimensions</legend>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="size" class="col-form-label">Height (CMs)</label>
                    </div>
                    <div class="col-sm-auto">
                        <input type="number" step="1" min="1" id="height" name="height" class="form-control" value="<?= $product->data['height'] ?? '' ?>">
                        <div class="invalid-feedback">
                            Please provide a valid height.
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <span class="form-text">
                            Please enter a positive Height.
                        </span>
                    </div>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="size" class="col-form-label">Width (CMs)</label>
                    </div>
                    <div class="col-sm-auto">
                        <input type="number" step="1" min="1" id="width" name="width" class="form-control" value="<?= $product->data['width'] ?? '' ?>">
                        <div class="invalid-feedback">
                            Please provide a valid width.
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <span class="form-text">
                            Please enter a positive Width.
                        </span>
                    </div>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="size" class="col-form-label">Length (CMs)</label>
                    </div>
                    <div class="col-sm-auto">
                        <input type="number" step="1" min="1" id="length" name="length" class="form-control" value="<?= $product->data['length'] ?? '' ?>">
                        <div class="invalid-feedback">
                            Please provide a valid length.
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <span class="form-text">
                            Please enter a positive Length.
                        </span>
                    </div>
                </div>
            </fieldset>
        </div>
    </form>
</div>