<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    $product = new Product();
    $qrcode = new QRCode();

    // Define variable
    $data = $product->get_all_product();
    $title = "Product";
    $active = "Product";
    $id = $_SESSION['id'];

    if (isset($_GET['a'])) {
        if ($_GET['a'] == 'delete') {
            $product->delete_product($_GET['id']);
            header("location: product.php");
        }
    }

    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <section class="my-5">
        <div class="container">
            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <!--<th scope="col">Description</th>-->
                        <th scope="col">Category</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Barcode</th>
                        <th scope="col">QR Code</th>
                        <th scope="col" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($i = 0; $i < count($data); $i++) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $data[$i][0] . "</th>";
                            echo "<td>" . $data[$i][1] . "</td>";
                            //echo "<td>" . $data[$i][2] . "</td>";
                            echo "<td>" . $data[$i][3] . "</td>";
                            echo "<td>" . $data[$i][4] . "</td>";
                            echo "<td><img class='img-fluid' src='data:image/png;base64," . base64_encode($generator->getBarcode($data[$i][5], $generator::TYPE_CODE_128)) . "' /></td>";
                            echo "<td><img class='img-fluid qrCode' src='" . $parseData['DOMAIN'] . "/uploads/qr-codes/" . $qrcode->convertSymbolToHex($data[$i][6]) . "' /></td>";
                            echo "<td><a href='view-product?a=view&id=" . $data[$i][0] . "' class='btn btn-primary'>View</a></td>";
                            echo "<td><a href='edit-product?a=edit&id=" . $data[$i][0] . "' class='btn btn-success'>Edit</a></td>";
                            echo "<td><a href='product?a=delete&id=" . $data[$i][0] . "'  class='btn btn-danger'>Delete</a></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <hr />
            <!--<a href="home" class="btn btn-primary">Home</a>-->
            <a href="add-product" class="btn btn-primary section__button">Add Product</a>
        </div>
    </section>

<!-- Footer -->
<?php include_once('templates/footer.php'); ?>