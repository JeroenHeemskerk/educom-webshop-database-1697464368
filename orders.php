<?php

    function getOrdersHeader() {
        return "Orders";
    }

    function showOrdersBody($data) {
        echo '<h2>Hier zullen uw orders in te zien zijn</h2>';
        print_r($data);
    }
?>