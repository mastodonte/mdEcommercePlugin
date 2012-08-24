<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($ec_category['id'], 'ec_category_edit', $ec_category) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <span class="<?php echo $ec_category->getNode()->isLeaf() ? 'file' : 'folder' ?>">
    <?php echo $ec_category['name'] ?>
  </span>
</td>
<td class="sf_admin_text sf_admin_list_td_root_id">
  <?php echo $ec_category['root_id'] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_lft">
  <?php echo $ec_category['lft'] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_rgt">
  <?php echo $ec_category['rgt'] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_level">
  <?php echo $ec_category['level'] ?>
</td>
