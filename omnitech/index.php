<?php

declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/handlers.php';

$path = request_path();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST' && $path === '/contact') {
    handle_contact();
}
if ($method === 'POST' && $path === '/apply') {
    handle_apply();
}

if (preg_match('#^/career/([a-z0-9-]+)$#', $path, $matches) === 1) {
    $job = job_by_slug($matches[1]);
    if ($job === null) {
        render_404();
        exit;
    }
    render('career.php', [
        'job' => $job,
        'pageTitle' => $job['title'] . ' — OMNITECH Systems',
        'pageDescription' => $job['intro'],
    ]);
    exit;
}

$routes = [
    '/' => [
        'view' => 'home.php',
        'title' => 'Home — OMNITECH Systems',
        'description' => 'The Accountable Enterprise. OMNITECH Systems delivers Commercial and Federal enterprise IT solutions.',
    ],
    '/about' => [
        'view' => 'about.php',
        'title' => 'About — OMNITECH Systems',
        'description' => 'OMNITECH Systems was established in 1999 and is headquartered in the Washington DC metropolitan area.',
    ],
    '/solutions' => [
        'view' => 'solutions.php',
        'title' => 'Solutions & Services — OMNITECH Systems',
        'description' => 'Enterprise IT solutions and services including data management, CLM, analytics, DevOps, and application development.',
    ],
    '/solutions/contract-lifecycle-management' => [
        'view' => 'clm.php',
        'title' => 'Contract Lifecycle Management — OMNITECH Systems',
        'description' => 'Accountable CLM strategy, vendor selection, implementation, migration, and managed services.',
    ],
    '/contact' => [
        'view' => 'contact.php',
        'title' => 'Contact — OMNITECH Systems',
        'description' => 'Contact OMNITECH Systems in Vienna, Virginia.',
    ],
    '/careers' => [
        'view' => 'careers.php',
        'title' => 'Careers — OMNITECH Systems',
        'description' => 'Open roles and benefits at OMNITECH Systems.',
    ],
    '/job-positions' => [
        'view' => 'jobs.php',
        'title' => 'Job Positions — OMNITECH Systems',
        'description' => 'Current job openings at OMNITECH Systems.',
    ],
    '/privacy' => [
        'view' => 'privacy.php',
        'title' => 'Privacy Policy — OMNITECH Systems',
        'description' => 'How OMNITECH Systems collects and uses information submitted through this website.',
    ],
    '/terms' => [
        'view' => 'terms.php',
        'title' => 'Terms and Conditions — OMNITECH Systems',
        'description' => 'Terms and conditions for the OMNITECH Systems website.',
    ],
    '/insights' => [
        'view' => 'insights.php',
        'title' => 'Insights — OMNITECH Systems',
        'description' => 'Insights from OMNITECH Systems.',
    ],
];

if (!isset($routes[$path])) {
    render_404();
    exit;
}

$route = $routes[$path];
render($route['view'], [
    'pageTitle' => $route['title'],
    'pageDescription' => $route['description'],
]);
