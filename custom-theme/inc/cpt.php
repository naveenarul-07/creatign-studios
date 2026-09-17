<?php
/**
 * Custom post types for projects, services, and testimonials.
 */

if (!defined('ABSPATH')) {
  exit;
}

function creative_studio_register_post_types() {
  register_post_type('project', [
    'labels' => [
      'name'          => __('Projects', 'creative-studio'),
      'singular_name' => __('Project', 'creative-studio'),
      'add_new_item'  => __('Add Project', 'creative-studio'),
      'edit_item'     => __('Edit Project', 'creative-studio'),
    ],
    'public'       => true,
    'has_archive'  => 'work',
    'rewrite'      => [
      'slug'       => 'work',
      'with_front' => false,
    ],
    'show_in_rest' => true,
    'menu_icon'    => 'dashicons-portfolio',
    'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes'],
  ]);

  register_post_type('service', [
    'labels' => [
      'name'          => __('Services', 'creative-studio'),
      'singular_name' => __('Service', 'creative-studio'),
    ],
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_rest'        => true,
    'exclude_from_search' => true,
    'menu_icon'           => 'dashicons-art',
    'supports'            => ['title', 'editor', 'custom-fields', 'page-attributes'],
  ]);

  register_post_type('testimonial', [
    'labels' => [
      'name'          => __('Testimonials', 'creative-studio'),
      'singular_name' => __('Testimonial', 'creative-studio'),
    ],
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_rest'        => true,
    'exclude_from_search' => true,
    'menu_icon'           => 'dashicons-format-quote',
    'supports'            => ['title', 'editor', 'custom-fields', 'page-attributes'],
  ]);
}
add_action('init', 'creative_studio_register_post_types');

/**
 * Archive at /work/ lists every project. Home still slices to 5 in the Work template.
 */
function creative_studio_project_archive_query($query) {
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  if ($query->is_post_type_archive('project')) {
    $query->set('posts_per_page', -1);
    $query->set('orderby', 'menu_order');
    $query->set('order', 'ASC');
  }
}
add_action('pre_get_posts', 'creative_studio_project_archive_query');
