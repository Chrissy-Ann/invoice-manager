<?php
    // List data for 'pending' invoices
    $page = 'pending';

    require "data.php";

    // Array_filter function
    function pending ($var) {
        if ($var['status'] == 'pending'):
            return $var;
            endif;
    }

    $invoices = array_filter($invoices, "pending");

    require "template.php";