<?php
/**
 * Seed content and getters.
 *
 * Values are copied from src/data/*.js, src/components/Marquee.jsx,
 * src/components/About.jsx, and src/components/Clients.jsx.
 * Query WordPress CPTs when they have posts; otherwise return the React fallbacks.
 */

if (!defined('ABSPATH')) {
  exit;
}

function creative_studio_seed_nav_links() {
  return [
    ['label' => 'Work', 'href' => '/work'],
    ['label' => 'Studio', 'href' => '/studio'],
    ['label' => 'Services', 'href' => '/#services'],
    ['label' => 'Contact', 'href' => '/contact'],
  ];
}

function creative_studio_seed_social_links() {
  return [
    ['label' => 'Instagram', 'href' => 'https://instagram.com'],
    ['label' => 'Behance', 'href' => 'https://behance.net'],
    ['label' => 'LinkedIn', 'href' => 'https://linkedin.com'],
    ['label' => 'Dribbble', 'href' => 'https://dribbble.com'],
  ];
}

function creative_studio_seed_studio_stats() {
  return [
    ['value' => 12, 'suffix' => '+', 'label' => 'YEARS'],
    ['value' => 80, 'suffix' => '+', 'label' => 'PROJECTS'],
    ['value' => 25, 'suffix' => '+', 'label' => 'CLIENTS'],
    ['value' => 14, 'suffix' => '', 'label' => 'COUNTRIES'],
  ];
}

function creative_studio_seed_process_steps() {
  return [
    [
      'number' => '01',
      'name'   => 'DISCOVER',
      'body'   => 'We listen, look and ask better questions. Research, audits and workshops that surface the real brief hiding inside the first one.',
    ],
    [
      'number' => '02',
      'name'   => 'DEFINE',
      'body'   => 'Positioning, principles and a sharp plan. We decide what the work should do in the world before we decide how it looks.',
    ],
    [
      'number' => '03',
      'name'   => 'DESIGN',
      'body'   => 'Identity, interface and motion. We prototype in high fidelity so ideas can be felt, not just presented.',
    ],
    [
      'number' => '04',
      'name'   => 'DEVELOP',
      'body'   => 'Engineering with the same care as design. Performance, accessibility and craft in the details people never name but always notice.',
    ],
    [
      'number' => '05',
      'name'   => 'LAUNCH',
      'body'   => 'We ship, tune and stand beside the work. Launch films, handoff, and a system the client can actually live with.',
    ],
  ];
}

function creative_studio_seed_testimonials() {
  return [
    [
      'id'      => 't1',
      'quote'   => "THE STUDIO DIDN'T JUST DESIGN OUR WEBSITE. THEY HELPED US REDEFINE HOW OUR BRAND SHOWS UP DIGITALLY.",
      'name'    => 'Elena Voss',
      'company' => 'Neon Atelier',
      'role'    => 'Founder',
    ],
    [
      'id'      => 't2',
      'quote'   => 'WORKING WITH THEM FELT LIKE GAINING A CREATIVE DIRECTOR, A STRATEGIST AND A TECHNICAL CO-FOUNDER AT ONCE.',
      'name'    => 'Marcus Hale',
      'company' => 'Mono Systems',
      'role'    => 'Head of Product',
    ],
    [
      'id'      => 't3',
      'quote'   => 'RARE TO FIND A TEAM THAT CARES ABOUT TYPE, MOTION AND ENGINEERING WITH THE SAME INTENSITY. THE WORK HOLDS UP.',
      'name'    => 'Amina Rahman',
      'company' => 'Arc Collective',
      'role'    => 'Creative Director',
    ],
  ];
}

function creative_studio_seed_services() {
  return [
    [
      'id'          => 'brand-strategy',
      'number'      => '01',
      'name'        => 'BRAND STRATEGY',
      'summary'     => 'Positioning, narrative and systems that give a brand a reason to exist — and a way to grow.',
      'description' => 'We clarify what a brand stands for, who it is for, and how it should behave. Research, verbal identity, brand architecture and go-to-market stories that hold under pressure.',
      'tags'        => ['Positioning', 'Verbal identity', 'Architecture', 'Workshops'],
      'visual'      => 'neon',
    ],
    [
      'id'          => 'visual-identity',
      'number'      => '02',
      'name'        => 'VISUAL IDENTITY',
      'summary'     => 'Marks, type, colour and motion languages built to live across spaces, products and campaigns.',
      'description' => 'Identity as a working kit, not a logo lockup. We design systems with enough constraint to be recognisable and enough range to stay alive for years.',
      'tags'        => ['Wordmark', 'Type', 'Colour', 'Guidelines'],
      'visual'      => 'nova',
    ],
    [
      'id'          => 'web-design',
      'number'      => '03',
      'name'        => 'WEB DESIGN',
      'summary'     => 'Editorial, cinematic interfaces with a point of view — not another template in a dark mode.',
      'description' => 'We design websites as experiences: pacing, hierarchy, and interaction that feel inevitable. Desktop theatre, mobile clarity.',
      'tags'        => ['UX', 'UI', 'Art direction', 'Prototyping'],
      'visual'      => 'echo',
    ],
    [
      'id'          => 'web-development',
      'number'      => '04',
      'name'        => 'WEB DEVELOPMENT',
      'summary'     => 'High-performance frontends and considered backends. Smooth, accessible, built to last.',
      'description' => 'From cinematic marketing sites to product platforms. We engineer for motion, accessibility and real-world performance — not just the staging URL.',
      'tags'        => ['React', 'Node', 'CMS', 'Performance'],
      'visual'      => 'mono',
    ],
    [
      'id'          => 'motion-design',
      'number'      => '05',
      'name'        => 'MOTION DESIGN',
      'summary'     => 'Kinetic identity, product films and interface motion that give a brand a pulse.',
      'description' => 'We design how things arrive, leave and breathe. Motion guidelines, launch films, and micro-interactions that make a product feel inevitable.',
      'tags'        => ['Film', 'Kinetic type', 'UI motion', 'Sound'],
      'visual'      => 'pulse',
    ],
    [
      'id'          => 'digital-experiences',
      'number'      => '06',
      'name'        => 'DIGITAL EXPERIENCES',
      'summary'     => 'Immersive web, installations and interactive stories that people remember with their body.',
      'description' => 'Experiences that respond to presence — cursor, scroll, space. Built for launches, exhibitions and always-on digital flagships.',
      'tags'        => ['Interactive', 'Canvas', 'Installations', 'Campaigns'],
      'visual'      => 'form',
    ],
  ];
}

function creative_studio_seed_team() {
  return [
    ['id' => 'amara', 'name' => 'Amara Chen', 'role' => 'Creative Director', 'initials' => 'AC'],
    ['id' => 'leo', 'name' => 'Leo Hart', 'role' => 'Design Lead', 'initials' => 'LH'],
    ['id' => 'sofia', 'name' => 'Sofia Reyes', 'role' => 'Technical Director', 'initials' => 'SR'],
    ['id' => 'jonah', 'name' => 'Jonah Blake', 'role' => 'Motion Designer', 'initials' => 'JB'],
  ];
}

function creative_studio_seed_clients() {
  return ['AETHER', 'LUMEN', 'KIN', 'ORBITAL', 'VANTAGE', 'NORTH', 'HALO', 'RIDGE'];
}

function creative_studio_seed_marquee() {
  return [
    'BRANDING',
    'DIGITAL EXPERIENCES',
    'CREATIVE DEVELOPMENT',
    'MOTION',
    'STRATEGY',
    'IDENTITY',
  ];
}

function creative_studio_seed_projects() {
  return [
    [
      'id'          => 'neon',
      'name'        => 'NEON',
      'title'       => 'NEON — Brand Experience',
      'category'    => 'Brand Experience',
      'year'        => '2025',
      'client'      => 'Neon Atelier',
      'services'    => ['Brand Strategy', 'Visual Identity', 'Motion Design'],
      'excerpt'     => 'A luminous identity system for a nocturnal culture brand spanning spaces, product and digital.',
      'description' => 'NEON asked us to translate after-hours energy into a living identity. We built a modular brand language that flexes from physical installations to a cinematic digital platform — colour, type and motion working as one instrument.',
      'challenge'   => 'The existing mark felt decorative rather than operational. The brand needed a system that could hold events, merch, editorial and an immersive web presence without losing heat.',
      'approach'    => 'We started with light as material. A reduced wordmark, a custom kinetic type treatment and a palette that shifts from void-black to electric lime. Motion rules govern every reveal so the brand never sits still.',
      'process'     => [
        ['title' => 'Discover', 'body' => 'Immersed in venues, playlists and the community around nocturnal culture.'],
        ['title' => 'Define', 'body' => 'Positioned NEON as a house of light — not a nightclub brand, a cultural frequency.'],
        ['title' => 'Design', 'body' => 'Crafted identity, spatial graphics and a web experience with reactive light fields.'],
        ['title' => 'Develop', 'body' => 'Built a high-performance site with WebGL-inspired canvas and editorial storytelling.'],
        ['title' => 'Launch', 'body' => 'Rolled out identity, campaign films and the digital flagship in a single night drop.'],
      ],
      'results'     => [
        ['label' => 'Brand recognition', 'value' => '+164%'],
        ['label' => 'Campaign reach', 'value' => '4.2M'],
        ['label' => 'Site engagement', 'value' => '3.8 min'],
      ],
      'palette'     => ['#0a0a0a', '#d4ff3f', '#ff4d1c', '#f4f0e6'],
      'visual'      => 'neon',
      'featured'    => true,
      'size'        => 'wide',
    ],
    [
      'id'          => 'mono',
      'name'        => 'MONO',
      'title'       => 'MONO — Digital Product',
      'category'    => 'Digital Product',
      'year'        => '2025',
      'client'      => 'Mono Systems',
      'services'    => ['Product Design', 'Web Development', 'Design Systems'],
      'excerpt'     => 'A quiet operating system for teams who think in systems, not screens.',
      'description' => 'MONO is a product for people who design other products. We distilled a complex workspace into a calm, precise interface with an editorial rhythm — density without noise.',
      'challenge'   => 'Feature sprawl had made the product feel like a tool cabinet. Users needed flow: fewer decisions, faster making, a surface that felt considered.',
      'approach'    => 'We rebuilt information architecture around intent, not modules. Typography, spacing and a monochrome system do the heavy lifting. Motion is functional: it explains, never decorates.',
      'process'     => [
        ['title' => 'Discover', 'body' => 'Mapped daily rituals of design leads and found the moments of friction.'],
        ['title' => 'Define', 'body' => 'Reframed MONO as an operating layer, not another dashboard.'],
        ['title' => 'Design', 'body' => 'Designed a dense, beautiful UI with an editorial type scale and empty states that teach.'],
        ['title' => 'Develop', 'body' => 'Shipped a React design system and a new product shell with measured transitions.'],
        ['title' => 'Launch', 'body' => 'Staged a private beta, then a public release with motion films and docs.'],
      ],
      'results'     => [
        ['label' => 'Task completion', 'value' => '+41%'],
        ['label' => 'Weekly retention', 'value' => '72%'],
        ['label' => 'Support tickets', 'value' => '−38%'],
      ],
      'palette'     => ['#111111', '#f4f0e6', '#8c8c8c', '#d4ff3f'],
      'visual'      => 'mono',
      'featured'    => true,
      'size'        => 'tall',
    ],
    [
      'id'          => 'arc',
      'name'        => 'ARC',
      'title'       => 'ARC — Creative Platform',
      'category'    => 'Creative Platform',
      'year'        => '2024',
      'client'      => 'Arc Collective',
      'services'    => ['Digital Experiences', 'Web Design', 'Creative Development'],
      'excerpt'     => 'A spatial platform where architects publish, sequence and sell their work.',
      'description' => 'ARC needed a home as considered as the buildings it represents. We designed a cinematic archive — large stills, slow pans, and a publishing system that treats projects like exhibitions.',
      'challenge'   => 'Portfolio sites for architecture tend to flatten work into grids. ARC wanted gravity: scale, sequence, and a sense of walking through space.',
      'approach'    => 'We used scroll as architecture. Chapters, thresholds and reveals mimic moving through a building. The CMS lets studios author spatial stories without touching code.',
      'process'     => [
        ['title' => 'Discover', 'body' => 'Studied how practices present work in books, rooms and lectures.'],
        ['title' => 'Define', 'body' => 'Set a principle: the site should feel like a gallery, not a feed.'],
        ['title' => 'Design', 'body' => 'Composed oversized imagery, quiet UI and a typographic system borrowed from monographs.'],
        ['title' => 'Develop', 'body' => 'Engineered smooth scroll chapters, lazy media and a custom publishing flow.'],
        ['title' => 'Launch', 'body' => 'Opened with twelve inaugural studios and a launch film shot on location.'],
      ],
      'results'     => [
        ['label' => 'Studios onboarded', 'value' => '48'],
        ['label' => 'Avg. session', 'value' => '6.1 min'],
        ['label' => 'Press features', 'value' => '22'],
      ],
      'palette'     => ['#161412', '#c6a87c', '#f4f0e6', '#3a342c'],
      'visual'      => 'arc',
      'featured'    => true,
      'size'        => 'square',
    ],
    [
      'id'          => 'nova',
      'name'        => 'NOVA',
      'title'       => 'NOVA — Brand Identity',
      'category'    => 'Brand Identity',
      'year'        => '2024',
      'client'      => 'Nova Labs',
      'services'    => ['Brand Strategy', 'Visual Identity', 'Campaign'],
      'excerpt'     => 'An identity for a research house exploring the edge of computational design.',
      'description' => 'NOVA sits between science and culture. We created a mark that behaves like a particle — stable in print, alive in motion — and a verbal system that speaks with precision and wonder.',
      'challenge'   => 'Deep-tech brands often hide behind abstraction. NOVA needed to feel human, credible and slightly otherworldly without slipping into cliché sci-fi.',
      'approach'    => 'A geometric wordmark, a custom constellation grid and photography that favours process over polish. Motion is orbital: elements find each other rather than bounce.',
      'process'     => [
        ['title' => 'Discover', 'body' => 'Sat with researchers, sketched on whiteboards, listened to how they name things.'],
        ['title' => 'Define', 'body' => 'Positioned NOVA as a studio of inquiry, not a software vendor.'],
        ['title' => 'Design', 'body' => 'Built identity, guidelines, film titles and a digital monograph.'],
        ['title' => 'Develop', 'body' => 'Produced a lightweight site with generative canvas sequences.'],
        ['title' => 'Launch', 'body' => 'Revealed the identity at a closed symposium, then opened the site.'],
      ],
      'results'     => [
        ['label' => 'Partnership inbound', 'value' => '+210%'],
        ['label' => 'Film views', 'value' => '1.1M'],
        ['label' => 'Guideline adoption', 'value' => '100%'],
      ],
      'palette'     => ['#07070c', '#7aa2ff', '#f4f0e6', '#d4ff3f'],
      'visual'      => 'nova',
      'featured'    => true,
      'size'        => 'wide',
    ],
    [
      'id'          => 'form',
      'name'        => 'FORM',
      'title'       => 'FORM — Digital Experience',
      'category'    => 'Digital Experience',
      'year'        => '2026',
      'client'      => 'Form Atelier',
      'services'    => ['Digital Experiences', 'Motion Design', 'Web Development'],
      'excerpt'     => 'An interactive sculpture garden on the web — objects you can feel without touching.',
      'description' => 'FORM invited us to put materiality online. We designed an experience where every object has weight, light and a sound — a digital gallery that rewards lingering.',
      'challenge'   => 'How do you make people slow down on the internet? The work had to feel tactile in a medium that usually rushes.',
      'approach'    => 'Cursor as hand. Hover as proximity. Scroll as walking. We paired reduced type with rich object studies and spatial audio cues that never shout.',
      'process'     => [
        ['title' => 'Discover', 'body' => 'Photographed plaster, metal and cloth under moving light.'],
        ['title' => 'Define', 'body' => 'Wrote interaction principles around weight, patience and silence.'],
        ['title' => 'Design', 'body' => 'Storyboarded object encounters and an index that behaves like a floor plan.'],
        ['title' => 'Develop', 'body' => 'Built performant media sequences and pointer-driven lighting.'],
        ['title' => 'Launch', 'body' => 'Opened the garden with a limited online viewing and a printed companion.'],
      ],
      'results'     => [
        ['label' => 'Avg. dwell time', 'value' => '7.4 min'],
        ['label' => 'Return visits', 'value' => '34%'],
        ['label' => 'Collector inquiries', 'value' => '89'],
      ],
      'palette'     => ['#1a1612', '#e7d5b5', '#8c5a3c', '#f4f0e6'],
      'visual'      => 'form',
      'featured'    => true,
      'size'        => 'tall',
    ],
    [
      'id'          => 'pulse',
      'name'        => 'PULSE',
      'title'       => 'PULSE — Motion System',
      'category'    => 'Motion Design',
      'year'        => '2025',
      'client'      => 'Pulse Audio',
      'services'    => ['Motion Design', 'Brand Strategy', 'Digital Experiences'],
      'excerpt'     => 'A sonic identity that you can see — waveform as brand, rhythm as interface.',
      'description' => 'PULSE makes listening devices. We turned sound into a visual language: a living waveform, a timing system, and a product film grammar that feels like bass in the chest.',
      'challenge'   => 'Audio brands often look like speaker spec sheets. PULSE needed culture, not hardware theatre.',
      'approach'    => 'We designed a motion bible first, then derived still identity from it. If it does not work at 24fps, it is not the brand.',
      'process'     => [
        ['title' => 'Discover', 'body' => 'Recorded rooms, commutes and clubs where the product actually lives.'],
        ['title' => 'Define', 'body' => 'Set the brand around presence — how sound occupies a body.'],
        ['title' => 'Design', 'body' => 'Created waveform marks, type in motion and a campaign of close-up films.'],
        ['title' => 'Develop', 'body' => 'Shipped a web player with reactive visuals tied to product demos.'],
        ['title' => 'Launch', 'body' => 'Dropped the system with a three-film series and a tactile microsite.'],
      ],
      'results'     => [
        ['label' => 'Launch film views', 'value' => '6.8M'],
        ['label' => 'Pre-orders', 'value' => '18k'],
        ['label' => 'Brand search', 'value' => '+320%'],
      ],
      'palette'     => ['#0c0c0c', '#ff4d1c', '#f4f0e6', '#d4ff3f'],
      'visual'      => 'pulse',
      'featured'    => true,
      'size'        => 'square',
    ],
    [
      'id'          => 'echo',
      'name'        => 'ECHO',
      'title'       => 'ECHO — Editorial Platform',
      'category'    => 'Web Design',
      'year'        => '2024',
      'client'      => 'Echo Review',
      'services'    => ['Web Design', 'Creative Development', 'Brand Identity'],
      'excerpt'     => 'A digital magazine that treats criticism as a luxury object.',
      'description' => 'ECHO publishes long, sharp writing on culture. We gave it a typographic house — generous measure, cinematic openers, and a reading experience that respects time.',
      'challenge'   => 'Most magazines on the web still look like blogs. ECHO needed the authority of print with the fluidity of a native app.',
      'approach'    => 'Type is the product. We designed a custom scale, issue-based colourways and page transitions that feel like turning a heavy leaf.',
      'process'     => [
        ['title' => 'Discover', 'body' => 'Read a year of issues and mapped how editors sequence arguments.'],
        ['title' => 'Define', 'body' => 'Framed ECHO as a house of long looking, not hot takes.'],
        ['title' => 'Design', 'body' => 'Composed layouts, issue covers and a reading path with footnotes that behave.'],
        ['title' => 'Develop', 'body' => 'Built a performant reading runtime with offline issue packs.'],
        ['title' => 'Launch', 'body' => 'Released Issue 41 as the first digital-native edition.'],
      ],
      'results'     => [
        ['label' => 'Subscriber growth', 'value' => '+88%'],
        ['label' => 'Read-through', 'value' => '54%'],
        ['label' => 'Time on article', 'value' => '9.2 min'],
      ],
      'palette'     => ['#12110f', '#f4f0e6', '#d4ff3f', '#5c5850'],
      'visual'      => 'echo',
      'featured'    => false,
      'size'        => 'wide',
    ],
  ];
}

function creative_studio_url($path) {
  $path = (string) $path;

  if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, 'mailto:')) {
    return $path;
  }

  if ('/#services' === $path || '#services' === $path) {
    return home_url('/#services');
  }

  if ('/work' === $path) {
    $archive = get_post_type_archive_link('project');
    return $archive ? $archive : home_url('/work/');
  }

  if (preg_match('#^/work/([^/]+)/?$#', $path, $matches)) {
    return creative_studio_project_permalink(['id' => $matches[1]]);
  }

  if ('/studio' === $path) {
    $page = get_page_by_path('studio');
    return $page ? get_permalink($page) : home_url('/studio/');
  }

  if ('/contact' === $path) {
    $page = get_page_by_path('contact');
    return $page ? get_permalink($page) : home_url('/contact/');
  }

  if ('/' === $path || '' === $path) {
    return home_url('/');
  }

  return home_url($path);
}

function creative_studio_get_nav_links() {
  return apply_filters('creative_studio_nav_links', creative_studio_seed_nav_links());
}

function creative_studio_is_current_href($href) {
  if (!is_string($href) || str_contains($href, '#')) {
    return false;
  }

  if ('/work' === $href) {
    return is_post_type_archive('project') || is_singular('project');
  }

  if ('/studio' === $href) {
    return is_page('studio');
  }

  if ('/contact' === $href) {
    return is_page('contact');
  }

  if ('/' === $href) {
    return is_front_page();
  }

  return false;
}

function creative_studio_get_social_links() {
  return apply_filters('creative_studio_social_links', creative_studio_seed_social_links());
}

function creative_studio_get_studio_stats() {
  return apply_filters('creative_studio_studio_stats', creative_studio_seed_studio_stats());
}

function creative_studio_get_process_steps() {
  return apply_filters('creative_studio_process_steps', creative_studio_seed_process_steps());
}

function creative_studio_get_team() {
  return apply_filters('creative_studio_team', creative_studio_seed_team());
}

function creative_studio_get_clients() {
  return apply_filters('creative_studio_clients', creative_studio_seed_clients());
}

function creative_studio_get_marquee_items() {
  return apply_filters('creative_studio_marquee_items', creative_studio_seed_marquee());
}

function creative_studio_decode_meta($value, $default = []) {
  if (is_array($value)) {
    return $value;
  }
  if (!is_string($value) || '' === $value) {
    return $default;
  }
  $decoded = json_decode($value, true);
  return is_array($decoded) ? $decoded : $default;
}

/**
 * Project permalink from the CPT, never a hardcoded domain.
 * Fallback shape matches /work/{slug}/ when the post is not in the database yet.
 */
function creative_studio_project_permalink($project) {
  if (!is_array($project)) {
    return home_url('/');
  }

  if (!empty($project['permalink'])) {
    return $project['permalink'];
  }

  $slug = isset($project['id']) ? sanitize_title((string) $project['id']) : '';
  if ('' === $slug) {
    return home_url('/');
  }

  $post = get_page_by_path($slug, OBJECT, 'project');
  if ($post instanceof WP_Post) {
    return get_permalink($post);
  }

  return home_url(user_trailingslashit('work/' . $slug));
}

function creative_studio_map_project_post($post) {
  $post = get_post($post);
  if (!$post) {
    return null;
  }

  $id = $post->post_name;

  return [
    'id'          => $id,
    'name'        => (string) get_post_meta($post->ID, '_cs_name', true),
    'title'       => get_the_title($post),
    'category'    => (string) get_post_meta($post->ID, '_cs_category', true),
    'year'        => (string) get_post_meta($post->ID, '_cs_year', true),
    'client'      => (string) get_post_meta($post->ID, '_cs_client', true),
    'services'    => creative_studio_decode_meta(get_post_meta($post->ID, '_cs_services', true)),
    'excerpt'     => has_excerpt($post) ? get_the_excerpt($post) : (string) get_post_meta($post->ID, '_cs_excerpt', true),
    'description' => $post->post_content,
    'challenge'   => (string) get_post_meta($post->ID, '_cs_challenge', true),
    'approach'    => (string) get_post_meta($post->ID, '_cs_approach', true),
    'process'     => creative_studio_decode_meta(get_post_meta($post->ID, '_cs_process', true)),
    'results'     => creative_studio_decode_meta(get_post_meta($post->ID, '_cs_results', true)),
    'palette'     => creative_studio_decode_meta(get_post_meta($post->ID, '_cs_palette', true)),
    'visual'      => (string) get_post_meta($post->ID, '_cs_visual', true),
    'featured'    => (bool) get_post_meta($post->ID, '_cs_featured', true),
    'size'        => (string) get_post_meta($post->ID, '_cs_size', true),
    'permalink'   => get_permalink($post),
  ];
}

function creative_studio_get_projects($limit = -1) {
  $query = new WP_Query([
    'post_type'      => 'project',
    'post_status'    => 'publish',
    'posts_per_page' => $limit,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
  ]);

  if ($query->have_posts()) {
    $projects = array_map('creative_studio_map_project_post', $query->posts);
    wp_reset_postdata();
    return $projects;
  }

  $projects = $limit > 0
    ? array_slice(creative_studio_seed_projects(), 0, $limit)
    : creative_studio_seed_projects();

  foreach ($projects as &$project) {
    $project['permalink'] = creative_studio_project_permalink($project);
  }
  unset($project);

  return $projects;
}

function creative_studio_get_project($id) {
  $posts = get_posts([
    'post_type'      => 'project',
    'name'           => sanitize_title($id),
    'post_status'    => 'publish',
    'posts_per_page' => 1,
  ]);

  if ($posts) {
    return creative_studio_map_project_post($posts[0]);
  }

  foreach (creative_studio_seed_projects() as $project) {
    if ($project['id'] === $id) {
      $project['permalink'] = creative_studio_project_permalink($project);
      return $project;
    }
  }

  return null;
}

function creative_studio_get_next_project($id) {
  $projects = creative_studio_get_projects();
  $index    = -1;

  foreach ($projects as $i => $project) {
    if ($project['id'] === $id) {
      $index = $i;
      break;
    }
  }

  if (-1 === $index) {
    return $projects[0] ?? null;
  }

  return $projects[($index + 1) % count($projects)];
}

function creative_studio_map_service_post($post) {
  $post = get_post($post);
  if (!$post) {
    return null;
  }

  return [
    'id'          => $post->post_name,
    'number'      => (string) get_post_meta($post->ID, '_cs_number', true),
    'name'        => get_the_title($post),
    'summary'     => (string) get_post_meta($post->ID, '_cs_summary', true),
    'description' => $post->post_content,
    'tags'        => creative_studio_decode_meta(get_post_meta($post->ID, '_cs_tags', true)),
    'visual'      => (string) get_post_meta($post->ID, '_cs_visual', true),
  ];
}

function creative_studio_get_services() {
  $query = new WP_Query([
    'post_type'      => 'service',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
  ]);

  if ($query->have_posts()) {
    $items = array_map('creative_studio_map_service_post', $query->posts);
    wp_reset_postdata();
    return $items;
  }

  return creative_studio_seed_services();
}

function creative_studio_map_testimonial_post($post) {
  $post = get_post($post);
  if (!$post) {
    return null;
  }

  return [
    'id'      => $post->post_name,
    'quote'   => $post->post_content,
    'name'    => get_the_title($post),
    'company' => (string) get_post_meta($post->ID, '_cs_company', true),
    'role'    => (string) get_post_meta($post->ID, '_cs_role', true),
  ];
}

function creative_studio_get_testimonials() {
  $query = new WP_Query([
    'post_type'      => 'testimonial',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
  ]);

  if ($query->have_posts()) {
    $items = array_map('creative_studio_map_testimonial_post', $query->posts);
    wp_reset_postdata();
    return $items;
  }

  return creative_studio_seed_testimonials();
}

function creative_studio_insert_or_get_page($title, $slug) {
  $existing = get_page_by_path($slug);
  if ($existing) {
    return (int) $existing->ID;
  }

  $id = wp_insert_post([
    'post_title'  => $title,
    'post_name'   => $slug,
    'post_status' => 'publish',
    'post_type'   => 'page',
  ]);

  return is_wp_error($id) ? 0 : (int) $id;
}

function creative_studio_save_project($project, $order) {
  $existing = get_posts([
    'post_type'      => 'project',
    'name'           => $project['id'],
    'post_status'    => 'any',
    'posts_per_page' => 1,
  ]);

  $postarr = [
    'post_type'    => 'project',
    'post_status'  => 'publish',
    'post_title'   => $project['title'],
    'post_name'    => $project['id'],
    'post_excerpt' => $project['excerpt'],
    'post_content' => $project['description'],
    'menu_order'   => $order,
  ];

  if ($existing) {
    $postarr['ID'] = $existing[0]->ID;
    $id = wp_update_post($postarr, true);
  } else {
    $id = wp_insert_post($postarr, true);
  }

  if (is_wp_error($id) || !$id) {
    return;
  }

  update_post_meta($id, '_cs_name', $project['name']);
  update_post_meta($id, '_cs_category', $project['category']);
  update_post_meta($id, '_cs_year', $project['year']);
  update_post_meta($id, '_cs_client', $project['client']);
  update_post_meta($id, '_cs_services', wp_json_encode($project['services']));
  update_post_meta($id, '_cs_excerpt', $project['excerpt']);
  update_post_meta($id, '_cs_challenge', $project['challenge']);
  update_post_meta($id, '_cs_approach', $project['approach']);
  update_post_meta($id, '_cs_process', wp_json_encode($project['process']));
  update_post_meta($id, '_cs_results', wp_json_encode($project['results']));
  update_post_meta($id, '_cs_palette', wp_json_encode($project['palette']));
  update_post_meta($id, '_cs_visual', $project['visual']);
  update_post_meta($id, '_cs_featured', $project['featured'] ? '1' : '');
  update_post_meta($id, '_cs_size', $project['size']);
}

function creative_studio_save_service($service, $order) {
  $existing = get_posts([
    'post_type'      => 'service',
    'name'           => $service['id'],
    'post_status'    => 'any',
    'posts_per_page' => 1,
  ]);

  $postarr = [
    'post_type'    => 'service',
    'post_status'  => 'publish',
    'post_title'   => $service['name'],
    'post_name'    => $service['id'],
    'post_content' => $service['description'],
    'menu_order'   => $order,
  ];

  if ($existing) {
    $postarr['ID'] = $existing[0]->ID;
    $id = wp_update_post($postarr, true);
  } else {
    $id = wp_insert_post($postarr, true);
  }

  if (is_wp_error($id) || !$id) {
    return;
  }

  update_post_meta($id, '_cs_number', $service['number']);
  update_post_meta($id, '_cs_summary', $service['summary']);
  update_post_meta($id, '_cs_tags', wp_json_encode($service['tags']));
  update_post_meta($id, '_cs_visual', $service['visual']);
}

function creative_studio_save_testimonial($item, $order) {
  $existing = get_posts([
    'post_type'      => 'testimonial',
    'name'           => $item['id'],
    'post_status'    => 'any',
    'posts_per_page' => 1,
  ]);

  $postarr = [
    'post_type'    => 'testimonial',
    'post_status'  => 'publish',
    'post_title'   => $item['name'],
    'post_name'    => $item['id'],
    'post_content' => $item['quote'],
    'menu_order'   => $order,
  ];

  if ($existing) {
    $postarr['ID'] = $existing[0]->ID;
    $id = wp_update_post($postarr, true);
  } else {
    $id = wp_insert_post($postarr, true);
  }

  if (is_wp_error($id) || !$id) {
    return;
  }

  update_post_meta($id, '_cs_company', $item['company']);
  update_post_meta($id, '_cs_role', $item['role']);
}

function creative_studio_seed_content() {
  if (get_option('creative_studio_seeded')) {
    return;
  }

  if (!get_option('creative_studio_identity_set')) {
    update_option('blogname', 'Creative Studio');
    update_option('blogdescription', 'Digital Experiences');
    update_option('creative_studio_identity_set', 1);
  }

  foreach (creative_studio_seed_projects() as $index => $project) {
    creative_studio_save_project($project, $index + 1);
  }

  foreach (creative_studio_seed_services() as $index => $service) {
    creative_studio_save_service($service, $index + 1);
  }

  foreach (creative_studio_seed_testimonials() as $index => $item) {
    creative_studio_save_testimonial($item, $index + 1);
  }

  $home_id    = creative_studio_insert_or_get_page('Home', 'home');
  $studio_id  = creative_studio_insert_or_get_page('Studio', 'studio');
  $contact_id = creative_studio_insert_or_get_page('Contact', 'contact');

  if ($home_id) {
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home_id);
  }

  unset($studio_id, $contact_id);

  update_option('permalink_structure', '/%postname%/');
  update_option('creative_studio_seeded', 1);
}
