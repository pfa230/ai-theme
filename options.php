<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

    // This gets the theme name from the stylesheet (lowercase and without spaces)
    $themename = get_option( 'stylesheet' );
    $themename = preg_replace("/\W/", "_", strtolower($themename) );

    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);

    // echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Выбрать страницу:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    $options = array();

    $options[] = array(
        'name' => __('Basic Settings', 'options_check'),
        'type' => 'heading');
//
//    $options[] = array(
//        'name' => __('Украинский текст заголовка', 'options_check'),
//        'id' => 'ua_header_text_page',
//        'type' => 'select',
//        'options' => $options_pages);
//
//    $options[] = array(
//        'name' => __('Русский текст заголовка', 'options_check'),
//        'id' => 'ru_header_text_page',
//        'type' => 'select',
//        'options' => $options_pages);
//
//    $options[] = array(
//        'name' => __('Английский текст заголовка', 'options_check'),
//        'id' => 'en_header_text_page',
//        'type' => 'select',
//        'options' => $options_pages);

    /**
     * For $settings options see:
     * http://codex.wordpress.org/Function_Reference/wp_editor
     *
     * 'media_buttons' are not supported as there is no post to attach items to
     * 'textarea_name' is set by the 'id' you choose
     */

    $wp_editor_settings = array(
        'wpautop' => true, // Default
        'textarea_rows' => 5,
        'tinymce' => array( 'plugins' => 'wordpress' )
    );

    $options[] = array(
        'name' => __('Украинский текст заголовка', 'options_check'),
        'id' => 'ua_header_text_page',
        'type' => 'editor',
        'settings' => $wp_editor_settings );

    $options[] = array(
        'name' => __('Русский текст заголовка', 'options_check'),
        'id' => 'ru_header_text_page',
        'type' => 'editor',
        'settings' => $wp_editor_settings );

    $options[] = array(
        'name' => __('Английский текст заголовка', 'options_check'),
        'id' => 'en_header_text_page',
        'type' => 'editor',
        'settings' => $wp_editor_settings );

    return $options;
}