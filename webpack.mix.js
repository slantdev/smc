let mix = require('laravel-mix');
let path = require('path');

mix.setResourceRoot('../');
mix.setPublicPath(path.resolve('./'));

mix.webpackConfig({
  watchOptions: {
    ignored: [
      path.posix.resolve(__dirname, './node_modules'),
      path.posix.resolve(__dirname, './css'),
      path.posix.resolve(__dirname, './js'),
    ],
  },
});

mix.js('resources/js/app.js', 'assets/js');

mix.postCss('resources/css/app.css', 'assets/css');

mix.postCss('resources/css/editor-style.css', 'assets/css');

mix.postCss('resources/css/admin-style.css', 'assets/css');

mix.postCss('resources/css/acf-layouts.css', 'assets/css');

mix.browserSync({
  proxy: 'smc.local',
  //host: 'localhost',
  //open: 'external',
  port: 8000,
  watch: true,
  files: [
    'wp-content/themes/**/*.css',
    'wp-content/themes/**/*.js',
    'wp-content/themes/**/*.php',
  ],
});

if (mix.inProduction()) {
  mix.version();
} else {
  mix.options({ manifest: false });
}
