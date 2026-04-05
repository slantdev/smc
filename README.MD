# SMC Custom Theme

This is a custom WordPress theme developed for SMC by Slant Agency. It is built upon the Tailpress boilerplate, integrating Tailwind CSS with WordPress and the block editor.

## Tech Stack

- **CSS Framework**: [Tailwind CSS](https://tailwindcss.com/)
- **UI Components**: [daisyUI](https://daisyui.com/)
- **CSS Plugins**: Typography, Forms, and Aspect-Ratio by Tailwind.
- **Build Tools**: [Laravel Mix](https://laravel-mix.com/) wrapping Webpack.
- **WP Boilerplate**: [Tailpress](https://tailpress.io/)

## Development Setup

To get started with development on this theme, you will need to install its Node dependencies and run the build tools.

1. Ensure you have Node.js and npm installed.
2. Navigate to the theme directory:
   ```bash
   cd wp-content/themes/smc
   ```
3. Install dependencies:
   ```bash
   npm install
   ```
4. Start the development server (runs BrowserSync proxied via `smc.local:8000` and watches for asset changes):
   ```bash
   npm run watch
   ```

## Architecture & Workflows

### 1. Working on Assets
Always edit CSS and JS code inside the `/resources` folder.
- `resources/css/app.css` -> Outputs to `assets/css/app.css`
- `resources/js/app.js` -> Outputs to `assets/js/app.js`

**Important**: Do not directly edit files in the `/assets/` directory as they will be overwritten by the bundler.

### 2. Component Structure
- **`/inc`**: Contains PHP logic (theme setup, enqueues, AJAX functions, helpers, and ACF configuration).
- **`/template-parts`**: Component-based templates separated into `sections/`, `layouts/`, `components/`, etc.

### 3. Advanced Custom Fields (ACF) & Page Builder
This theme relies heavily on ACF Pro for page building and site options.
- The theme features a **Custom Page Builder** driven by ACF Flexible Content (`get_row_layout()`).
- New page sections are mapped through the main builder file located at `template-parts/page-builder.php`.
- The corresponding view template files are stored within `template-parts/sections/`.
- ACF field groups are synced using local JSON and revisioned inside the `acf-json/` folder.

## Build Commands

A quick overview of the essential NPM scripts configured in `package.json`:

| Command               | Description |
| --------------------- | ----------- |
| `npm run dev`         | Creates a development build of assets. |
| `npm run watch`       | Watches for changes and compiles assets on the fly. Includes hot reloading via BrowserSync. |
| `npm run production`  | Creates a production-ready, minified build of assets. Run this before deploying to a live server. |

## Credits

- Developed by **Slant Agency**
