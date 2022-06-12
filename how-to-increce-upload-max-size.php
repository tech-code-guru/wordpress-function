<?php
 $size ='800878686868686860000';
        update_option('max_file_size', $size);

add_filter('upload_size_limit', 'sanjay_increase_upload');

function sanjay_increase_upload() {
    return get_option('max_file_size');
}

?>