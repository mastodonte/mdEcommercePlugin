<h5>Giro Redpagos:</h5>

<?php include_partial('redpagos/payment', array('md_order' => $md_order)); ?>

<?php include_partial('redpagos/validation', array('md_order' => $md_order, 'ec_redpagos' => $ec_redpagos)); ?>