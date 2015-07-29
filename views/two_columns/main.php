<?php if (!defined('ABSPATH')) die(); ?>

<div class="nested-menu-widget grid">
  <ul class="nested-menu nested-menu-column-1 col-lg-6 col-md-12 col-sm-12">
    <? foreach($menu_data[1] as $category): ?>
      <?php $this->view('two_columns/menu_item', $category) ?>
    <? endforeach ?>
  </ul>

  <ul class="nested-menu nested-menu-column-2 col-lg-6 col-md-12 col-sm-12">
    <? foreach($menu_data[2] as $category): ?>
      <?php $this->view('two_columns/menu_item', $category) ?>
    <? endforeach ?>
  </ul>
</div>
