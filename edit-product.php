<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    $product = new Product();

    // Define variable
    $product_id = $_GET['id'];
    $id = $_SESSION['id'];
    $data = $product->get_product($product_id);
    $title = "Edit Product";
    $active = "Product";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['save'])) {
            extract($_REQUEST);

            
            if ($_FILES['file']['error'] == 0) {
                $upload = $_FILES['file'];
            } elseif ($_FILES['file']['error'] == 4) {
                $upload = $oldUpload;
            }

            $edit = $product->edit_product($product_id, $name, $description, $category, $quantity, $barcode, $upload);
            if ($edit) {
                // Updating Success
                header("location: product");
            } else {
                // Updating Failed
                echo "Updating product failed.";
            }
        }
    }
?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <section class="my-5">
        <div class="container">
            <h1>Product ID: <?php echo $product_id; ?></h1>
            <form method="POST" name="edit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $product_id; ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Product Name: </label>
                    <input type="text" name="name" placeholder="Enter Product Name" value="<?php echo $data['Name']; ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Product Description: </label>
                    <textarea name="description" placeholder="Enter Product Description" class="form-control"><?php echo htmlspecialchars($data['Description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label>Category: </label>
                    <input type="text" name="category" placeholder="Enter Category" value="<?php echo $data['Category']; ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Quantity: </label>
                    <input type="number" name="quantity" placeholder="Enter Quantity" value="<?php echo $data['Quantity']; ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Barcode: </label>
                    <input type="text" name="barcode" placeholder="Enter Barcode" value="<?php echo $data['Barcode']; ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Image: </label>
                    <input type="hidden" name="oldUpload" value="<?php echo $data['Upload']; ?>" />
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