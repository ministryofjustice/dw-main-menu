<?php if (!defined('ABSPATH')) die(); ?>

<div style="clear: both">
</div>
<div class="nested-menu-widget">
  <ul class="nested-menu-categories-list">
    <? foreach($menu_data as $category): ?>
      <?php $this->view('category_item', $category) ?>
    <? endforeach ?>
  </ul>
</div>
