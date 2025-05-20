<?php
    // List data for 'paid' invoices
    $page = 'paid';

    require "data.php";

    // Array_filter function
    function paid ($var) {
        if ($var['status'] == 'paid'):
            return $var;
            endif;
    }

    $invoices = array_filter($invoices, "paid");

    require "template.php";