# SMC Theme - Project Analysis

This file contains an overview of the SMC Custom WordPress Theme architecture, technology stack, and directory structure.

## Overview

- **Theme Name**: smc (Custom Theme for SMC)
- **Author**: Slant Agency
- **Repository**: slantdev/smc

## Technology Stack

### Front-End
- **CSS Framework**: [Tailwind CSS](https://tailwindcss.com/)
- **UI Components**: [daisyUI](https://daisyui.com/) (Tailwind CSS plugin)
- **Forms/Typography**: Tailwind plugins for forms, typography, and aspect-ratio.
- **WordPress Integration**: [Tailpress](https://tailpress.io/) is used as the foundational boilerplate to integrate Tailwind CSS with WordPress and the block editor.

### Build Tools
- **Bundler**: [Laravel Mix](https://laravel-mix.com/) (Webpack-based wrapper)
- **Development Server**: BrowserSync (proxied via `smc.local:8000`)
- **Commands**:
  - `npm run dev`: Creates a development build.
  - `npm run watch`: Watches for changes and compiles assets on the fly.
  - `npm run production`: Creates a production-ready minified build.

### Back-End / WordPress Integrations
- **Advanced Custom Fields (ACF)**:
  - Heavy reliance on ACF (likely Pro, given the usage of Options Pages and Flexible Content).
  - Uses `acf-json` for syncing field groups.
  - Includes plugins/features like ACF Icon Picker and specific palette configurations in the admin area.
- **Page Builder**: 
  - A custom page builder approach using ACF Flexible Content (`get_row_layout()`).
  - Rendered via `template-parts/page-builder.php` handling various sections (e.g., `image_text`, `hero_slider`, `whats_on`, `contact`).

## Directory Structure

- **`/inc`**: PHP logic separated into functional helpers.
  - `acf.php`: ACF settings, theme settings, options page registration, color palettes.
  - `ajax.php`: Contains AJAX endpoints and handlers.
  - `enqueue.php`: Enqueues compiled CSS/JS assets.
  - `theme-setup.php` & `helpers.php`: Standard WordPress theme registration and custom utilities.
- **`/template-parts`**: Component-based template pieces.
  - `sections/`: Contains the PHP templates mapped to the ACF flexible content layouts (e.g., `whats_on.php`, `hero_slider.php`).
  - `layouts/`, `components/`, `single/`: Reusable template parts for headers, footers, structural elements.
  - `page-builder.php`: The main entry point looping through ACF 'section' rows.
- **`/resources`**: Source files for front-end assets.
  - Contains all the uncompiled `css/` (`app.css`, `editor-style.css`, etc.) and `js/` (`app.js`).
- **`/assets`**: Compiled/output directory. **Do not edit these files directly.**
- **`theme.json` & `tailwind.config.js`**: Both files work in tandem to map Tailwind colors, spacing, and typography settings to WordPress's block editor and frontend generation.

## Key Development Workflows

1. **Working on Assets**: Always edit CSS/JS inside the `/resources` folder and run `npm run watch` (or `dev`). The compiled files are piped into the `/assets` directory.
2. **Adding New Page Sections**:
   - Register a new layout in the ACF `section` flexible content area.
   - Map it inside `template-parts/page-builder.php`.
   - Create the corresponding template file inside `template-parts/sections/`.
3. **Styling and Theming**: Configuration changes for colors, fonts, or screens should typically be mapped out via `theme.json`, which Tailpress will consume and inject into `tailwind.config.js`.
