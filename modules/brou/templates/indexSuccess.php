<h5>Deposito BROU:</h5>

<?php include_partial('brou/payment', array('md_order' => $md_order)); ?>

<?php include_partial('brou/validation', array('md_order' => $md_order, 'ec_brou' => $ec_brou)); ?>