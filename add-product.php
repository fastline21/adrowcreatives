<?php
    session_start();
    include('includes/autoloader.inc.php');
    $product = new Product();

    // Define variable
    $title = "Add Product";
    $active = "Product";    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['save'])) {
            extract($_REQUEST);
            $upload = $_FILES['file'];
            $add = $product->add_product($name, $description, $category, $quantity, $barcode, $upload);
            if ($add) {
                // Adding Success
                echo "Adding new product success";
            } else {
                // Registration Failed
                echo "Adding new product failed.";
            }
        }
    }
?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <section id="add-product" class="my-5">
        <div class="container">
            <form method="POST" name="add" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Product Name: </label>
                    <input type="text" name="name" placeholder="Enter Product Name" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Product Description: </label>
                    <textarea name="description" placeholder="Enter Product Description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Category: </label>
                    <input type="text" name="category" placeholder="Enter Category" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Quantity: </label>
                    <input type="number" name="quantity" placeholder="Enter Quantity" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Barcode: </label>
                    <input type="text" name="barcode" placeholder="Enter Barcode" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Image: </label>
                    <input type="file" name="file" accept="image/*" class="form-control-file" />
                </div>
                <input type="submit" name="save" value="Save" class="btn btn-primary btn-block section__button" />
            </form>
            <hr />
            <a href="product" class="btn btn-secondary">Back</a>
        </div>
    </section>

<!-- Footer -->
<?php include_once('templates/footer.php'); ?>