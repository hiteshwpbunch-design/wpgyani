<?php
// Enqueue Media Uploader Scripts
add_action('admin_enqueue_scripts', 'wpgyani_about_meta_scripts');
function wpgyani_about_meta_scripts($hook) {
    if ($hook == 'post.php' || $hook == 'post-new.php') {
        wp_enqueue_media();
    }
}

// Register Single Tabbed Meta Box for About Us Template
add_action('add_meta_boxes', 'wpgyani_about_add_meta_boxes');
function wpgyani_about_add_meta_boxes() {
    global $post;
    if (empty($post)) return;

    $template_file = get_post_meta($post->ID, '_wp_page_template', true);
    if ($template_file === 'page-about.php') {
        add_meta_box('wpgyani_about_options', 'About Us Page Options', 'wpgyani_about_options_cb', 'page', 'normal', 'high');
    }
}

// Render Helper - Text/Textarea
function wpgyani_render_text_field($id, $label, $value, $type = 'text', $desc = '') {
    echo '<div class="wpgyani-field-wrapper" style="margin-bottom: 15px;">';
    echo '<strong><label for="' . esc_attr($id) . '">' . esc_html($label) . '</label></strong><br>';
    if ($type === 'textarea') {
        echo '<textarea id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" style="width:100%;height:100px;">' . esc_textarea($value) . '</textarea>';
    } else {
        echo '<input type="text" id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_attr($value) . '" style="width:100%;max-width:600px;" />';
    }
    if ($desc) echo '<br><small style="color:#666;">' . esc_html($desc) . '</small>';
    echo '</div>';
}

// Render Helper - Image Uploader
function wpgyani_render_image_field($id, $label, $value, $desc = '') {
    echo '<div class="wpgyani-field-wrapper" style="margin-bottom: 15px;">';
    echo '<strong><label>' . esc_html($label) . '</label></strong><br>';
    
    // Preview container
    echo '<div class="wpgyani-image-preview-wrapper" style="margin: 10px 0;">';
    if ($value) {
        echo '<img src="' . esc_url($value) . '" style="max-width: 100%; height: auto; max-height: 150px; border: 1px solid #ccc; padding: 2px; border-radius: 4px; display: block;" />';
    }
    echo '</div>';
    
    // Hidden input and buttons
    echo '<input type="hidden" id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_attr($value) . '" class="wpgyani-image-url-input" />';
    echo '<button type="button" class="button button-secondary wpgyani-upload-btn">Upload / Select Image</button> ';
    echo '<button type="button" class="button button-link-delete wpgyani-remove-image-btn" style="' . ($value ? '' : 'display:none;') . '">Remove Image</button>';
    
    if ($desc) echo '<br><small style="color:#666; margin-top:5px; display:inline-block;">' . esc_html($desc) . '</small>';
    echo '</div>';
}

// Render Helper - Repeater Row
function wpgyani_render_repeater_row($index, $data) {
    echo '<div class="wpgyani-repeater-row" style="background: #fff; border: 1px solid #ccd0d4; padding: 15px; margin-bottom: 15px; border-radius: 4px; position: relative;">';
    echo '<button type="button" class="button button-link-delete wpgyani-remove-row" style="position: absolute; top: 10px; right: 10px;">Remove Card</button>';
    echo '<h4 style="margin-top:0;">Achievement Card</h4>';
    
    // Title
    echo '<div class="wpgyani-field-wrapper" style="margin-bottom: 10px;">';
    echo '<strong><label>Title</label></strong><br>';
    echo '<input type="text" name="about_achievements[' . esc_attr($index) . '][title]" value="' . esc_attr($data['title']) . '" style="width:100%;max-width:600px;" />';
    echo '</div>';

    // Desc
    echo '<div class="wpgyani-field-wrapper" style="margin-bottom: 10px;">';
    echo '<strong><label>Description</label></strong><br>';
    echo '<textarea name="about_achievements[' . esc_attr($index) . '][desc]" style="width:100%;height:80px;">' . esc_textarea($data['desc']) . '</textarea>';
    echo '</div>';
    
    // Image
    echo '<div class="wpgyani-field-wrapper" style="margin-bottom: 10px;">';
    echo '<strong><label>Image</label></strong><br>';
    echo '<div class="wpgyani-image-preview-wrapper" style="margin: 10px 0;">';
    if (!empty($data['img'])) {
        echo '<img src="' . esc_url($data['img']) . '" style="max-width: 100%; height: auto; max-height: 150px; border: 1px solid #ccc; padding: 2px; border-radius: 4px; display: block;" />';
    }
    echo '</div>';
    echo '<input type="hidden" name="about_achievements[' . esc_attr($index) . '][img]" value="' . esc_attr($data['img'] ?? '') . '" class="wpgyani-image-url-input" />';
    echo '<button type="button" class="button button-secondary wpgyani-upload-btn">Upload / Select Image</button> ';
    echo '<button type="button" class="button button-link-delete wpgyani-remove-image-btn" style="' . (!empty($data['img']) ? '' : 'display:none;') . '">Remove Image</button>';
    echo '</div>';
    
    echo '</div>';
}

// Main Callback for Tabbed UI
function wpgyani_about_options_cb($post) {
    wp_nonce_field('wpgyani_about_save', 'wpgyani_about_nonce');
    ?>
    <style>
        .wpgyani-tab-content { display: none; padding: 15px 5px; }
        .wpgyani-tab-content.active { display: block; }
        .wpgyani-nav-tab { cursor: pointer; }
        .wpgyani-section-title { font-size: 16px; margin: 0 0 10px 0; padding-bottom: 5px; border-bottom: 1px solid #ccc; }
    </style>
    
    <h2 class="nav-tab-wrapper wpgyani-nav-tab-wrapper">
        <a href="#tab-hero" class="nav-tab nav-tab-active wpgyani-nav-tab">Hero Section</a>
        <a href="#tab-story" class="nav-tab wpgyani-nav-tab">Our Story</a>
        <a href="#tab-company" class="nav-tab wpgyani-nav-tab">Company List</a>
        <a href="#tab-values" class="nav-tab wpgyani-nav-tab">Core Values</a>
        <a href="#tab-achievements" class="nav-tab wpgyani-nav-tab">Achievements</a>
        <a href="#tab-stats" class="nav-tab wpgyani-nav-tab">Stats</a>
    </h2>

    <div id="tab-hero" class="wpgyani-tab-content active">
        <h3 class="wpgyani-section-title">Hero Section Details</h3>
        <?php
        wpgyani_render_text_field('about_hero_subtitle', 'Hero Subtitle', get_post_meta($post->ID, 'about_hero_subtitle', true));
        wpgyani_render_text_field('about_hero_title', 'Hero Title (Use HTML for spans/br)', get_post_meta($post->ID, 'about_hero_title', true), 'textarea');
        wpgyani_render_text_field('about_hero_desc', 'Hero Description', get_post_meta($post->ID, 'about_hero_desc', true), 'textarea');
        ?>
    </div>

    <div id="tab-story" class="wpgyani-tab-content">
        <h3 class="wpgyani-section-title">Our Story Section</h3>
        <?php
        wpgyani_render_text_field('about_story_heading', 'Story Heading', get_post_meta($post->ID, 'about_story_heading', true));
        wpgyani_render_text_field('about_story_p1', 'Paragraph 1', get_post_meta($post->ID, 'about_story_p1', true), 'textarea');
        wpgyani_render_text_field('about_story_p2', 'Paragraph 2', get_post_meta($post->ID, 'about_story_p2', true), 'textarea');
        wpgyani_render_image_field('about_story_img', 'Story Image', get_post_meta($post->ID, 'about_story_img', true));
        ?>
    </div>

    <div id="tab-company" class="wpgyani-tab-content">
        <h3 class="wpgyani-section-title">About Our Company Section</h3>
        <?php
        wpgyani_render_text_field('about_company_heading', 'Company Heading', get_post_meta($post->ID, 'about_company_heading', true));
        wpgyani_render_text_field('about_company_desc', 'Company Description', get_post_meta($post->ID, 'about_company_desc', true), 'textarea');
        wpgyani_render_text_field('about_company_list', 'Company List Items (Comma separated)', get_post_meta($post->ID, 'about_company_list', true), 'textarea', 'Example: Setup, Theme Guides, SEO tips');
        ?>
    </div>

    <div id="tab-values" class="wpgyani-tab-content">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <h3 class="wpgyani-section-title" style="margin-top:<?php echo $i>1 ? '30px' : '0'; ?>;">Core Value <?php echo $i; ?></h3>
            <?php
            wpgyani_render_text_field('about_value_' . $i . '_title', 'Title', get_post_meta($post->ID, 'about_value_' . $i . '_title', true));
            wpgyani_render_text_field('about_value_' . $i . '_desc', 'Description', get_post_meta($post->ID, 'about_value_' . $i . '_desc', true), 'textarea');
            ?>
        <?php endfor; ?>
    </div>

    <div id="tab-achievements" class="wpgyani-tab-content">
        <h3 class="wpgyani-section-title">Achievements Header</h3>
        <?php
        wpgyani_render_text_field('about_achieve_heading', 'Section Heading', get_post_meta($post->ID, 'about_achieve_heading', true));
        wpgyani_render_text_field('about_achieve_desc', 'Section Description', get_post_meta($post->ID, 'about_achieve_desc', true), 'textarea');
        ?>
        
        <h3 class="wpgyani-section-title" style="margin-top:30px;">Achievement Cards (Repeater)</h3>
        <div id="wpgyani-achievements-repeater" style="background:#f1f1f1; padding:15px; border-radius:4px; margin-bottom:15px;">
            <?php
            $achievements = get_post_meta($post->ID, 'about_achievements', true);
            if (!is_array($achievements) || empty($achievements)) {
                $achievements = [ ['title' => '', 'desc' => '', 'img' => ''] ];
            }
            
            foreach ($achievements as $index => $achieve) {
                wpgyani_render_repeater_row($index, $achieve);
            }
            ?>
        </div>
        <button type="button" class="button button-primary" id="wpgyani-add-achievement">Add New Card</button>

        <script type="text/template" id="wpgyani-achievement-template">
            <?php wpgyani_render_repeater_row('{INDEX}', ['title' => '', 'desc' => '', 'img' => '']); ?>
        </script>
    </div>

    <div id="tab-stats" class="wpgyani-tab-content">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <h3 class="wpgyani-section-title" style="margin-top:<?php echo $i>1 ? '30px' : '0'; ?>;">Stat Box <?php echo $i; ?></h3>
            <?php
            wpgyani_render_text_field('about_stat_' . $i . '_num', 'Number (e.g. 400K+)', get_post_meta($post->ID, 'about_stat_' . $i . '_num', true));
            wpgyani_render_text_field('about_stat_' . $i . '_label', 'Label', get_post_meta($post->ID, 'about_stat_' . $i . '_label', true));
            ?>
        <?php endfor; ?>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Tab switching logic
        $('.wpgyani-nav-tab').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            
            $('.wpgyani-nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            
            $('.wpgyani-tab-content').removeClass('active');
            $(target).addClass('active');
        });

        // Repeater Logic
        var rowCount = $('.wpgyani-repeater-row').length;
        $('#wpgyani-add-achievement').on('click', function(e) {
            e.preventDefault();
            var template = $('#wpgyani-achievement-template').html();
            template = template.replace(/{INDEX}/g, rowCount);
            $('#wpgyani-achievements-repeater').append(template);
            rowCount++;
        });

        $(document).on('click', '.wpgyani-remove-row', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to remove this card?')) {
                $(this).closest('.wpgyani-repeater-row').remove();
            }
        });

        // WP Media Uploader logic (Event Delegation)
        $(document).on('click', '.wpgyani-upload-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var wrapper = button.siblings('.wpgyani-image-preview-wrapper');
            var hiddenInput = button.siblings('.wpgyani-image-url-input');
            var removeBtn = button.siblings('.wpgyani-remove-image-btn');

            var custom_uploader = wp.media({
                title: 'Select or Upload Image',
                button: { text: 'Use this image' },
                multiple: false
            })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                wrapper.html('<img src="' + attachment.url + '" style="max-width: 100%; height: auto; max-height: 150px; border: 1px solid #ccc; padding: 2px; border-radius: 4px; display: block;" />');
                hiddenInput.val(attachment.url);
                removeBtn.show();
            })
            .open();
        });

        $(document).on('click', '.wpgyani-remove-image-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            button.siblings('.wpgyani-image-preview-wrapper').html('');
            button.siblings('.wpgyani-image-url-input').val('');
            button.hide();
        });
    });
    </script>
    <?php
}

// Save Meta Data
add_action('save_post', 'wpgyani_about_save_meta');
function wpgyani_about_save_meta($post_id) {
    if (!isset($_POST['wpgyani_about_nonce']) || !wp_verify_nonce($_POST['wpgyani_about_nonce'], 'wpgyani_about_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $text_fields = [
        'about_hero_subtitle', 'about_hero_title', 'about_hero_desc',
        'about_story_heading', 'about_story_p1', 'about_story_p2',
        'about_company_heading', 'about_company_desc', 'about_company_list',
        'about_value_1_title', 'about_value_1_desc',
        'about_value_2_title', 'about_value_2_desc',
        'about_value_3_title', 'about_value_3_desc',
        'about_achieve_heading', 'about_achieve_desc',
        'about_stat_1_num', 'about_stat_1_label',
        'about_stat_2_num', 'about_stat_2_label',
        'about_stat_3_num', 'about_stat_3_label'
    ];

    foreach ($text_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, wp_kses_post(wp_unslash($_POST[$field])));
        } else {
            delete_post_meta($post_id, $field);
        }
    }

    $image_fields = [
        'about_story_img'
    ];

    foreach ($image_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, esc_url_raw(wp_unslash($_POST[$field])));
        } else {
            delete_post_meta($post_id, $field);
        }
    }

    // Save Repeater
    if (isset($_POST['about_achievements']) && is_array($_POST['about_achievements'])) {
        $clean_achievements = [];
        foreach ($_POST['about_achievements'] as $achieve) {
            $clean_achievements[] = [
                'title' => wp_kses_post(wp_unslash($achieve['title'] ?? '')),
                'desc' => wp_kses_post(wp_unslash($achieve['desc'] ?? '')),
                'img' => esc_url_raw(wp_unslash($achieve['img'] ?? ''))
            ];
        }
        update_post_meta($post_id, 'about_achievements', $clean_achievements);
    } else {
        delete_post_meta($post_id, 'about_achievements');
    }
}
