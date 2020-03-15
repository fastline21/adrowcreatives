<?php
    session_start();
    include('includes/autoloader.inc.php');
    $product = new Product();
    $user = new User();

    // Define variable
    $title = "Print";
    $data = $product->get_all_product();
    $active = "Print";
    $id = $_SESSION['id'];

    // Generate Barcode
    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();

    $printBarcode = $printQRCode = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['submit'])) {
            extract($_REQUEST);

            $printBarcode = true;
            $printBarcodeDialog = true;
            $productItem = $product->get_product($productName)['Name'];
            $barcode = $product->get_product($productName)['Barcode'];

            //$barcodePrint = new Barcode();
            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
        } elseif (isset($_REQUEST['printBarcode'])) {
            $printBarcode = true;
        } elseif (isset($_REQUEST['printQRCode'])) {
            $printQRCode = true;
        }
    }
?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <section class="my-5">
        <div class="container">
            <?php
                if ($printBarcode) {
                    if (isset($printBarcodeDialog)) {
                        ?>
                        <script>
                        window.onload = () => { window.print(); }
                        </script>
                        <style>
                        
                        </style>
                        <div>
                        <?php
                        for ($i = 1; $i <= $quantity; $i++) {
                            echo "<p class='d-inline-block pb-3'>
                                <span>
                                    <b>Item: $productItem</b>
                                </span>
                                <img class='d-block' src='data:image/png;base64," . base64_encode($generatorPNG->getBarcode($barcode, $generatorPNG::TYPE_CODE_128)) . "' />
                                <span>" . $barcode . "</span>
                            </p>&nbsp&nbsp&nbsp&nbsp";
                        }
                        echo "</div>";
                        echo "<hr />";
                        echo "<div>";
                        echo "<a href='" . $parseData['DOMAIN'] . "/print' id='back' class='btn btn-secondary'>Back</a>";
                        echo "<button class='btn btn-primary section__button ml-1' onclick='window.print();'>Print</button>";
                        echo "</div>";
                    } else {
                        ?>
                        <form method="post" action="<?php echo htmlspecialchars($parseData['DOMAIN'] . "/" . pathinfo($_SERVER["PHP_SELF"])['filename']);?>">
                            <div class="form-group">
                                <label>Product Name: </label>
                                <select name="productName" class="form-control">
                                    <?php
                                        for ($i = 0; $i < count($data); $i++) {
                                            echo "<option value=" . $data[$i][0] . ">";
                                            echo $data[$i][1];
                                            echo "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Number of Barcode: </label>
                                <input type="number" name="quantity" class="form-control" placeholder="Enter Number of Barcode" />
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary section__button">Print</button>
                            </div>
                        </form>
                        <hr />
                        <a href="print" class="btn btn-secondary">Back</a>
                        <?php
                    }
                } elseif ($printQRCode) {
                    ?>
                    <h1>QR Code</h1>
                    <form method="post" action="<?php echo htmlspecialchars($parseData['DOMAIN'] . "/" . pathinfo($_SERVER["PHP_SELF"])['filename']);?>">
                        <div class="form-group">
                            <label>Product Name: </label>
                            <select name="productName" class="form-control">
                                <?php
                                    for ($i = 0; $i < count($data); $i++) {
                                        echo "<option value=" . $data[$i][0] . ">";
                                        echo $data[$i][1];
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                        </div>
                    </form>
                    <hr />
                    <a href="print" class="btn btn-secondary">Back</a>
                    <?php
                } else {
                    ?>
                    <form method="post" action="<?php echo htmlspecialchars($parseData['DOMAIN'] . "/" . pathinfo($_SERVER["PHP_SELF"])['filename']);?>">
                        <button type="submit" name="printBarcode" class="btn btn-primary">Print Barcode</button>
                        <button type="submit" name="printQRCode" class="btn btn-primary">Print QR Code</button>
                    </form>
                    <?php
                }
            ?>
        </div>
    </section>

<!-- Footer -->
<?php include_once('templates/footer.php'); ?>