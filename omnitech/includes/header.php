<?php
$flashMessage = flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e($pageDescription) ?>">
  <link rel="icon" href="<?= e(asset('images/logo.svg')) ?>" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=Open+Sans:wght@400;600;700&family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body>
  <a class="skip-link" href="#content">Skip to content</a>
  <header class="site-header" data-header>
    <div class="container header-bar">
      <a class="brand" href="<?= e(url('/')) ?>" aria-label="OMNITECH Systems home">
        <img src="<?= e(asset('images/logo.svg')) ?>" alt="OMNITECH Systems">
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-nav-toggle>
        <span class="sr-only">Menu</span>
        <span></span><span></span><span></span>
      </button>
      <nav class="site-nav" id="site-nav" data-nav>
        <?php foreach (nav_links() as $link): ?>
          <a class="nav-link<?= current_nav($link['href']) ?>" href="<?= e(url($link['href'])) ?>"><?= e($link['label']) ?></a>
        <?php endforeach; ?>
        <a class="btn btn-lime btn-sm" href="<?= e(EMPLOYEE_PORTAL) ?>" target="_blank" rel="noopener noreferrer">Employee Portal</a>
      </nav>
    </div>
  </header>
  <main id="content">
    <?php if ($flashMessage): ?>
      <div class="flash flash-<?= e($flashMessage['type']) ?>" role="status"><?= e($flashMessage['message']) ?></div>
    <?php endif; ?>
