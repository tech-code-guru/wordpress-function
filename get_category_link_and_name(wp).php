 <?php
$terms = get_the_terms($post->id , 'category' );

    // print_r( $terms );
    foreach($terms as $term) {
    //echo '<pre>';
    //print_r($term);
    $category_link = get_category_link($term->term_id);
    // echo $sm_cat=$term->name.', ';  
    // echo rtrim($aaa, ',');

    echo '<a class="sm_cat_hover" href='.$category_link.'>'.$term->name.'</a>';

    }

?>