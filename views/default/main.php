<?php if (!defined('ABSPATH')) die(); ?>

<div class="nested-menu-widget">
  <ul class="categories-list">
    <?php foreach($menu_data as $category): ?>
      <?php $this->view('default/category_item', $category) ?>
    <?php endforeach ?>
  </ul>
</div>
