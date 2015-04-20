<?php if (!defined('ABSPATH')) die(); ?>

<div class="nested-menu-widget">
  <ul class="nested-menu-categories-list">
    <? foreach($menu_data as $category): ?>
      <?php $this->view('category_item', $category) ?>
    <? endforeach ?>
  </ul>
</div>
