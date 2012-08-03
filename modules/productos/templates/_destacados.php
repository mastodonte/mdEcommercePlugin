<div class="box">
  <div class="box-heading">
    <h2><strong>Productos</strong> destacados</h2>
  </div>
  <div class="box-content">
    <div class="box-product">
      <?php foreach ($productos as $producto): ?>        
        <div style="opacity: 1;">
          <div class="product_outside_border">
            <div class="product_outside">
              <div class="product_inside">
                <div class="image">
                  <a href="<?php echo url_for('producto-show', $producto); ?>">
                    <?php include_partial('productos/avatar', array('producto' => $producto, 'width' => 200, 'height' => 173, 'code' => mdWebCodes::CROPRESIZE)); ?>
                  </a>
                </div>
                <div class="name">
                  <a href="<?php echo url_for('producto-show', $producto); ?>"><?php echo $producto->getName(); ?></a>
                </div>
                <div class="cart">
                  <a class="button" onclick="addToCart('41');">
                    <span>Agregar</span>
                  </a>
                </div>
                <?php if (true): ?>
                  <div class="price">
                    <span class="price-old">$587.50</span>
                    <span class="price-new">$611.00</span>
                    <?php if (true): ?>
                      <div class="product_sale">
                        <div class="sale-middle"> Oferta </div>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php else: ?>
                  <div class="price"> $117.50 </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div><!-- << box product >> -->
  </div><!-- << box content >> -->
</div><!-- << box >> -->
