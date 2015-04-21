<?php
/*
Plugin Name: DW Nested menu
Description: Display nested menu
*/

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

if (class_exists('mmvc')) {
  class DW_nested_menu_controller extends MVC_controller {
    function __construct($args, $instance) {
      global $post;
      $this->args = $args;
      $this->instance = $instance;
      $this->current_page_id = get_queried_object_id();
      $this->ancestors = get_ancestors($this->current_page_id, 'page');

      parent::__construct();
    }

    function main() {
      $this->view('main', $this->get_data());
    }

    private function get_data() {
      return array(
        'menu_data' => $this->get_menu_data()
      );
    }

    private function get_menu_data() {
      $menu_id = $this->instance['nav_menu'];
      $menu = wp_get_nav_menu_items($menu_id);

      $organised_menu = array();
      $count = 0;

      foreach($menu as $item) {
        $count++;

        $item = array(
          'title' => $item->title,
          'ID' => $item->ID,
          'object_id' => (int) $item->object_id,
          'menu_item_parent' => $item->menu_item_parent,
          'url' => $item->url,
          'children' => array()
        );

        if($item['menu_item_parent']) {
          $organised_menu[$item['menu_item_parent']]['children'][$item['ID']] = $item;
        }
        else {
          $item['is_current'] = $this->is_ancestor($item['object_id']);
          $organised_menu[$item['ID']] = $item;
        }
      }

      return $organised_menu;
    }

    private function is_ancestor($menu_post_id) {
      //Debug::full([
      //  'menu_id' => $menu_post_id,
      //  'current_page_id' => $this->current_page_id,
      //  'ancestors' => $this->ancestors
      //]);
      if($menu_post_id === $this->current_page_id) {
        return true;
      }

      foreach($this->ancestors as $ancestor_id) {
        if($menu_post_id === $ancestor_id) {
          return true;
        }
      }

      return false;
    }
  }

  class DW_nested_menu extends WP_Widget {
    function __construct() {
      parent::WP_Widget(false, 'Nested menu', array('description' => 'Nested menu widget'));
    }

    function widget($args, $instance) {
      new DW_nested_menu_controller($args, $instance);
    }

    function update($new_instance, $old_instance){
      $instance = array();
      $instance['nav_menu'] = (!empty($new_instance['nav_menu'])) ? strip_tags($new_instance['nav_menu']) : '';

      return $instance;
    }

    function form($instance) {
  		$nav_menu = isset($instance['nav_menu']) ? $instance['nav_menu'] : __('menu_id', 'text_domain');
  		$menus = get_terms('nav_menu', array('hide_empty' => false));
      ?>

      <p>
        <label for="<?=$this->get_field_id('nav_menu')?>"><?php _e('Select Menu:')?></label>
        <select id="<?=$this->get_field_id('nav_menu')?>" name="<?=$this->get_field_name('nav_menu')?>">
        <?php foreach($menus as $menu): ?>
            <option value="<?=$menu->term_id?>" <?=selected( $nav_menu, $menu->term_id, false)?> ><?=$menu->name?></option>
        <?php endforeach ?>
        </select>
      </p>

      <?php
    }
  }

  add_action('widgets_init', create_function('', 'return register_widget("DW_nested_menu");'));
}

?>
