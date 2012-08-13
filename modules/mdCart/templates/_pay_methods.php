<?php foreach($methods as $method): ?>
  <input class="checkbox" type="radio" name="payment" value="<?php echo $method->getLabel(); ?>" <?php echo ($method->getChecked() ? 'checked="checked"' : ''); ?> /><?php echo $method->getName(); ?><br />
  <div class="clear"></div>
<?php endforeach; ?>