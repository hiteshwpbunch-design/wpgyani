<?php
require_once('wp-load.php');
$p = get_page_by_path('contact');
if($p){
    $p->post_content = '[contact-form-7 id="129"]';
    wp_update_post($p);
    echo 'UPDATED:'.$p->ID;
} else {
    $ps = get_pages(['meta_key'=>'_wp_page_template','meta_value'=>'page-contact.php']);
    if(!empty($ps)){
        $ps[0]->post_content = '[contact-form-7 id="129"]';
        wp_update_post($ps[0]);
        echo 'UPDATED:'.$ps[0]->ID;
    } else {
        echo 'NOT FOUND';
    }
}
?>
