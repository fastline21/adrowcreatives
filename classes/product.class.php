<?php
    include_once('./config/db.php');
    use Endroid\QrCode\QrCode;

    class Product {
        public $db;

        public function __construct() {
            $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

            if (mysqli_connect_error()) {
                echo "Error: Could not connect to database.";
                exit;
            }
        }

        // Creating New Product
        public function add_product($name, $description, $category, $quantity, $barcode, $upload) {
            $qry = "SELECT * FROM products WHERE Name='$name'";

            // Checking if the product name is available in db
            $check = $this->db->query($qry);
            $count_row = $check->num_rows;

            // If the product name is not in db then insert to the table
            if ($count_row == 0) {
                // String change to lower case and replace spaces to dash
                $uploadName = strtolower(str_replace("-", " ", $name)) . "." . pathinfo($upload['name'], PATHINFO_EXTENSION);

                // Creating Folder
                $path = $this->create_upload_folder("products", $uploadName);

                // Generate Barcode
                $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

                // Set Path for upload
                $pathUpload = $this->get_path_upload("products") . $uploadName;
                
                // Upload Barcode Image
                file_put_contents($this->create_upload_folder("barcodes", "barcode#" . $id . ".png"), $generatorPNG->getBarcode($barcode, $generatorPNG::TYPE_CODE_128));

                // Generate QR Codes
                $qrCode = new QrCode('Product Name: ' . $name);

                // Save QR Code
                $qrCodePath = date("Y") . "/" . date("m") . "/" . date("d") . "/qrcode#" . $id . ".png";
                $qrCode->writeFile($this->create_upload_folder("qr-codes", "qrcode#" . $id . ".png"));

                // Uploading file
                if (move_uploaded_file($upload['tmp_name'], $path)) {
                    $qry = "INSERT INTO products SET Name='$name', Description='$description', Category='$category', Quantity='$quantity', Barcode='$barcode', QR_Code='$qrCodePath', Upload='$uploadName'";
                    $result = mysqli_query($this->db, $qry);
                    return $result;
                }                
            } else {
                return false;
            }
        }

        // Updating Old Product
        public function edit_product($id, $name, $description, $category, $quantity, $barcode, $upload) {
            // String change to lower case and replace spaces to dash
            $uploadName = strtolower(str_replace("-", " ", $name)) . "." . pathinfo($upload['name'], PATHINFO_EXTENSION);

            // Creating Folder
            $path = $this->create_upload_folder("products", $uploadName);

            // Generate Barcode
            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

            // Set Path for upload
            $pathUpload = $this->get_path_upload("products") . $uploadName;
            
            // Upload Barcode
            file_put_contents($this->create_upload_folder("barcodes", $id . ".png"), $generatorPNG->getBarcode($barcode, $generatorPNG::TYPE_CODE_128));

            // Generate QR Codes
            $qrCode = new QrCode('Product Name: ' . $name);

            // Save QR Code
            $qrCodePath = date("Y") . "/" . date("m") . "/" . date("d") . "/qrcode#" . $id . ".png";
            $qrCode->writeFile($this->create_upload_folder("qr-codes", "qrcode#" . $id . ".png"));

            if (move_uploaded_file($upload['tmp_name'], $path)) {
                $qry = "UPDATE products SET Name='$name', Description='$description', Category='$category', Quantity='$quantity', Barcode='$barcode', QR_Code='$qrCodePath', Upload='$pathUpload' WHERE ID='$id'";
                $result = mysqli_query($this->db, $qry);
                return true;
            } else {
                $qry = "UPDATE products SET Name='$name', Description='$description', Category='$category', Quantity='$quantity', Barcode='$barcode', QR_Code='$qrCodePath' WHERE ID='$id'";
                $result = mysqli_query($this->db, $qry);
                return true;
            }
        }

        // Delete Product
        public function delete_product($id) {
            $qry = "DELETE FROM products WHERE ID='$id'";
            $result = mysqli_query($this->db, $qry);
            return true;
        }

        // Show Selected Product
        public function get_product($id) {
            $qry = "SELECT * FROM products WHERE ID='$id'";
            $result = mysqli_query($this->db, $qry);
            $data = mysqli_fetch_array($result);
            return $data;
        }

        // Show all Product
        public function get_all_product() {
            $qry = "SELECT * FROM products";
            $result = mysqli_query($this->db, $qry);
            $data = mysqli_fetch_all($result);
            return $data;
        }

        // Create Upload Folder
        public function create_upload_folder($category, $uploadName) {
            // Current Path with Year, Month, Day
            $currentPath = $this->get_path_upload($category);
            //$currentPath = "./uploads/" . $category . "/" . date("Y") . "/" . date("m") . "/" . date("d") . "/";

            // If Folder exists
            if (!file_exists($currentPath)) {
                mkdir($currentPath, 0777, true);
            }

            return $currentPath . $uploadName;
        }

        private function get_path_upload($category) {
            $currentPath = "./uploads/" . $category . "/" . date("Y") . "/" . date("m") . "/" . date("d") . "/";
            return $currentPath;
        }
    }
?>