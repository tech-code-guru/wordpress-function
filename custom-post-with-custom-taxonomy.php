<?php



add_action( 'init', 'codex_book_init' );

function codex_book_init() {
 $labels = array(
  'name'               => _x( 'Search categories', 'post type general name', 'your-plugin-textdomain' ),
  'singular_name'      => _x( 'Search categories', 'post type singular name', 'your-plugin-textdomain' ),
  'menu_name'          => _x( 'Search categories', 'admin menu', 'your-plugin-textdomain' ),
  'name_admin_bar'     => _x( 'Search categories', 'add new on admin bar', 'your-plugin-textdomain' ),
  'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
  'add_new_item'       => __( 'Add New Search categories', 'your-plugin-textdomain' ),
  'new_item'           => __( 'New Search categories', 'your-plugin-textdomain' ),
  'edit_item'          => __( 'Edit Search categories', 'your-plugin-textdomain' ),
  'view_item'          => __( 'View Search categories', 'your-plugin-textdomain' ),
  'all_items'          => __( 'All Search categories', 'your-plugin-textdomain' ),
  'search_items'       => __( 'Search Search categories', 'your-plugin-textdomain' ),
  'parent_item_colon'  => __( 'Parent Search categories:', 'your-plugin-textdomain' ),
  'not_found'          => __( 'No Search categories found.', 'your-plugin-textdomain' ),
  'not_found_in_trash' => __( 'No Search categories found in Trash.', 'your-plugin-textdomain' )
 );

 $args = array(
  'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
  'public'             => true,
  'publicly_queryable' => true,
  'show_ui'            => true,
  'show_in_menu'       => true,
  'query_var'          => true,
  'rewrite'            => array( 'slug' => 'search_cat' ),
  'capability_type'    => 'post',
  'has_archive'        => true,
  'hierarchical'       => false,
  'menu_position'      => null,
  'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
 );

 register_post_type( 'search_cat', $args );
 
}



/*---------------------------------------taxonomy code---------------------------------------------*/
function rs_jp_cats_taxonomy() {

 $labels = array(
  'name'                       => _x( 'Categories', 'Taxonomy General Name', 'your-plugin-textdomain' ),
  'singular_name'              => _x( 'Categories', 'Categories Singular Name', 'your-plugin-textdomain' ),
  'menu_name'                  => __( 'Categories', 'your-plugin-textdomain' ),
  'all_items'                  => __( 'All Items', 'your-plugin-textdomain' ),
  'parent_item'                => __( 'Parent Item', 'your-plugin-textdomain' ),
  'parent_item_colon'          => __( 'Parent Item:', 'your-plugin-textdomain' ),
  'new_item_name'              => __( 'New Item Name', 'your-plugin-textdomain' ),
  'add_new_item'               => __( 'Add New Item', 'your-plugin-textdomainl' ),
  'edit_item'                  => __( 'Edit Item', 'your-plugin-textdomain' ),
  'update_item'                => __( 'Update Item', 'your-plugin-textdomain' ),
  'separate_items_with_commas' => __( 'Separate items with commas', 'your-plugin-textdomain' ),
  'search_items'               => __( 'Search Items', 'your-plugin-textdomain' ),
  'add_or_remove_items'        => __( 'Add or remove items', 'your-plugin-textdomain' ),
  'choose_from_most_used'      => __( 'Choose from the most used items', 'your-plugin-textdomain' ),
  'not_found'                  => __( 'Not Found', 'your-plugin-textdomain' ),
 );
 $args = array(
  'labels'                     => $labels,
  'hierarchical'               => true,
  'public'                     => true,
  'show_ui'                    => true,
  'show_admin_column'          => true,
  'show_in_nav_menus'          => true,
  'show_tagcloud'              => true,
 );
 register_taxonomy( 'search_categories', array( 'search_cat' ), $args );

}


add_action( 'init', 'rs_jp_cats_taxonomy', 0 );



//-------------------------------show taxonomy---------------------


 $args = array(
    'type'                     => 'post',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'taxonomy'                 => 'search_categories',
    'pad_counts'               => false 
   ); 
   $categories = get_categories( $args );
     foreach ($categories as $allCategory)
{
echo $firstCategory = $allCategory->name.', &nbsp'; 
}

?>