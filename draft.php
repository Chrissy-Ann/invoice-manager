<?php
    // List data for 'draft' invoices
    $page = 'draft';

    require "data.php";

    // Array_filter function
    function draft ($var) {
        if ($var['status'] == 'draft'):
            return $var;
            endif;
    }

    $invoices = array_filter($invoices, "draft");

    require "template.php";