# Creative Studio

WordPress theme for a premium creative studio site. Editorial typography, cinematic motion, and an interactive portfolio.

The live frontend is the **WordPress theme** in `custom-theme/`. There is no React app in this repository.

## Stack

- **Site:** WordPress theme (`custom-theme/`)
- **Motion:** GSAP ScrollTrigger, Lenis
- **Styles:** Tailwind CSS 4 (built into the theme)
- **Optional API:** Node.js + Express + MySQL (`server/`)

## WordPress setup

1. Copy `custom-theme` into your WordPress install:

```bash
cp -R custom-theme /path/to/wordpress/wp-content/themes/creative-studio
```

2. In WP Admin → Appearance → Themes, activate **Creative Studio**.
3. Create pages titled Work, Studio, and Contact (the theme ships templates for those slugs).
4. Optional theme CSS rebuild:

```bash
cd custom-theme
npm install
npm run build:css
npm run copy:vendor
```

WordPress should then show Home, Work, project case studies, Studio, Contact, and 404 from PHP templates.

## Optional API

```bash
cp .env.example .env
npm install
npm run dev
```

API: [http://localhost:5000](http://localhost:5000)

The WordPress theme handles content and the contact form on its own. Use the Express API only if you want a separate JSON backend.

| Variable | Description |
| --- | --- |
| `PORT` | Express port (default `5000`) |
| `MYSQL_HOST` / `MYSQL_PORT` / `MYSQL_USER` / `MYSQL_PASSWORD` / `MYSQL_DATABASE` | Optional MySQL. When omitted, the API uses in-memory data. |
| `CLIENT_ORIGIN` | CORS origin in production |
| `NODE_ENV` | `development` or `production` |

## API

All JSON responses follow `{ success, data }` or `{ success, error }`.

- `GET /api/health`
- `GET /api/projects`
- `GET /api/projects/:id`
- `GET /api/services`
- `GET /api/testimonials`
- `POST /api/contact`

Contact body:

```json
{
  "name": "Jordan Lee",
  "email": "jordan@example.com",
  "company": "North",
  "message": "We are planning a new digital flagship for next spring."
}
```

## Project structure

```text
custom-theme/     WordPress theme (templates, assets, CPT, contact)
  assets/
  inc/
  template-parts/
  front-page.php
  archive-project.php
  single-project.php
  page-studio.php
  page-contact.php
server/           Optional Express + MySQL API
  server.js
  routes/
  controllers/
  models/
  middleware/
```

## License

Original studio implementation. Placeholder brands, people and case studies are fictional.
