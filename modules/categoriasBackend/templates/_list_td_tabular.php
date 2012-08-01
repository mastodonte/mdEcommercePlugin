<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($ec_category['id'], 'ec_category_edit', $ec_category) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <span class="<?php echo $ec_category->getNode()->isLeaf() ? 'file' : 'folder' ?>">
    <?php echo $ec_category['name'] ?>
  </span>
</td>
