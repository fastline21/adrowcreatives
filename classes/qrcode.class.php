<?php
    class QRCode {
        public function convertSymbolToHex($name) {
            return strpos($name, '#') ? str_replace('#', '%23', $name) : $name;
        }
    }
?>