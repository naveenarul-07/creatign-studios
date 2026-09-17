<?php
/**
 * Studio page. Matches pages/StudioPage.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

get_header();
?>
<div class="pt-16">
  <?php
  get_template_part('template-parts/about', null, [
    'heading_tag' => 'h1',
  ]);
  get_template_part('template-parts/process');
  get_template_part('template-parts/clients');
  get_template_part('template-parts/contact');
  ?>
</div>
<?php
get_footer();
