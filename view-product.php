<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    $product = new Product();
    $qrcode = new QRCode();

    // Define variable
    $id = $_SESSION['id'];
    $product_id = $_GET['id'];
    $data = $product->get_product($product_id);
    $title = "View Product";
    $active = "Product";

    // Generate Barcode
    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <section class="my-5">
        <div class="container">
            <table class="table table-bordered">
                <tbody>
                    <?php
                        for ($x = 1; $x < count($data); $x++) {
                            $y = $x;
                            echo "<tr>";
                            echo "<th scope='row' style='width: 10%;'>" . str_replace('_', ' ', array_keys($data)[$x]) . ":</th>";
                            if (array_keys($data)[$x] == 'Barcode') {
                                echo "<td><img class='img-fluid' src='data:image/png;base64," . base64_encode($generatorPNG->getBarcode(array_values($data)[$x], $generatorPNG::TYPE_CODE_128)) . "' /></td>";
                            } elseif (array_keys($data)[$x] == 'Upload') {
                                echo "<td><img class='img-fluid w-25' src=" . array_values($data)[$x] . " /></td>";
                            } elseif (array_keys($data)[$x] == 'QR_Code') {
                                echo "<td><img class='img-fluid w-25' src=" . $parseData['DOMAIN'] . "/uploads/qr-codes/" . $qrcode->convertSymbolToHex(array_values($data)[$x]) . " /></td>";  
                            } else {
                                echo "<td>" . array_values($data)[$x] . "</td>";
                            }
                            echo "</tr>";
                            $x++;
                        }
                    ?>
                </tbody>
            </table>
            <hr />
            <a href="product" class="btn btn-secondary">Back</a>
        </div>
    </section>

<!-- Footer -->
<?php include_once('templates/footer.php'); ?>