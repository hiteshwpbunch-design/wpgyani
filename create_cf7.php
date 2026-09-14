<?php
require_once('wp-load.php');

// Check if form already exists to avoid duplicates
$existing_forms = get_posts(array(
    'post_type' => 'wpcf7_contact_form',
    'posts_per_page' => 1
));

if (!empty($existing_forms)) {
    echo "EXISTS:" . $existing_forms[0]->ID;
} else {
    $post = array(
        'post_title' => 'Contact Form 1',
        'post_type' => 'wpcf7_contact_form',
        'post_status' => 'publish'
    );
    $id = wp_insert_post($post);
    
    // Default CF7 properties
    $form = '<label> Your name
    [text* your-name autocomplete:name] </label>

<label> Your email
    [email* your-email autocomplete:email] </label>

<label> Subject
    [text* your-subject] </label>

<label> Your message (optional)
    [textarea your-message] </label>

[submit "Submit"]';

    update_post_meta($id, '_form', $form);
    update_post_meta($id, '_mail', array(
        'active' => true,
        'subject' => 'WP Gyani Contact: [your-subject]',
        'sender' => '[your-name] <wordpress@' . $_SERVER['SERVER_NAME'] . '>',
        'recipient' => get_option('admin_email'),
        'body' => 'From: [your-name] <[your-email]>
Subject: [your-subject]

Message Body:
[your-message]

-- 
This e-mail was sent from a contact form on WP Gyani',
        'additional_headers' => 'Reply-To: [your-email]',
        'attachments' => '',
        'use_html' => false,
        'exclude_blank' => false,
    ));
    
    echo "CREATED:" . $id;
}
?>
