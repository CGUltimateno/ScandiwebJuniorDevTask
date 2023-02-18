 <nav class="navbar bg-transparent">
     <div class="container px-auto">
     <h2 class="navbar-brand my-auto">Products List</h2>

        <span>
            <a type="button" href="/juniortask/add-product/"  class="btn btn-outline-success">Add</a>
        <form action="/juniortask/delete/" method="post" id="delete-form" class="d-inline-block">
                <button type="submit" name="delete_btn" class="btn btn-outline-danger" id="delete-product-btn">Delete</button>
        </form>
            </span>
     </div>
    </nav>
    <?php echo("<hr>")?>
    <div class="container my-5">
    <div class="row g-4">
            <?php
            foreach ($products as $item => $row) :
            ?>
                <div class="col-6 col-sm-3">
                    <div class="card shadow border-dark">
                        <div class="card-body">
                        <div class="form-check-inline">
                        <label class="form-check-label">
                            <input form="delete-form" type="checkbox" class="delete-checkbox form-check-input" name="<?= $row['sku'] ?>">
                        </label>
                        </div>
                        <h5 class="card-text text-center"><?= $row['sku']; ?></h5>
                        <h5 class="card-text text-center"><?= $row['name']; ?></h5>
                        <h6 class="card-text text-center"><?= $row['price']; ?> $</h6>
                        <h6 class="card-text text-center"><?= $row['value']; ?></h6>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
</div>
</div>
