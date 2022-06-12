<?php

add_action(
  'pre_get_posts',
  'custom_pre_get_posts'
);

function custom_pre_get_posts($query) {
    global $wpdb;

    if(!$query->is_main_query()) {
      return;
    }

    $post_name = $query->get('pagename');

    $post_type = $wpdb->get_var(
      $wpdb->prepare(
        'SELECT post_type FROM ' . $wpdb->posts . ' WHERE post_name = %s LIMIT 1',
        $post_name
      )
    );

    switch($post_type) {
      case 'product':
        $query->set('product', $post_name);
        $query->set('post_type', $post_type);
        $query->is_single = true;
        $query->is_page = false;
        break;
    }

    return $query;
}

?>