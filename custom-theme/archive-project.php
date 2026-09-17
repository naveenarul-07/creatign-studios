<?php
/**
 * Project archive. Matches pages/WorkPage.jsx.
 * Main query is the project CPT at /work/ (all entries, not the home limit of 5).
 */

if (!defined('ABSPATH')) {
  exit;
}

get_header();

$projects = [];
if (have_posts()) {
  while (have_posts()) {
    the_post();
    $mapped = creative_studio_map_project_post(get_post());
    if ($mapped) {
      $projects[] = $mapped;
    }
  }
}

if (!$projects) {
  $projects = creative_studio_get_projects();
}
?>
<div class="pt-24">
  <?php
  get_template_part('template-parts/work', null, [
    'heading'  => 'ALL WORK',
    'projects' => $projects,
  ]);
  get_template_part('template-parts/contact');
  ?>
</div>
<?php
get_footer();
