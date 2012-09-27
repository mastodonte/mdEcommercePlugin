<hr />

<?php include_component('categoriasBackend', 'associate', array('object' => $ec_product)); ?>

<div class="clear"></div>

<hr />

<div id="news_extra_info">

  <div id="user_images" style="width:550px">
    
    <?php include_component('mdMediaContentAdmin', 'showAlbums', array('object' => $ec_product)) ?>
    
  </div>

</div>

<div class="clear"></div>

<script type="text/javascript">
  $(document).ready(function() {
    initializeLightBox('<?php echo $ec_product->getId(); ?>', '<?php echo $ec_product->getObjectClass(); ?>', MdAvatarAdmin.getInstance().getDefaultAlbumId());
  });
</script>
