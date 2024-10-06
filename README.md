# WordPress Widget Boilerplate for Elementor

Write custom blocks with a pre-configured TypeScript/SCSS bundler and a prepared object-oriented plugin.

## What's inside

- TypeScript / JavaScript bundler into a single file (minification, without comments, single file)
- SCSS bundler
- Live Browser Reload
- Example block for Elementor as a plugin (object-oriented)
- Prepared internationalization (configured in the `/languages` folder)

## What you need

- Node.js v20.9.0 or newer
- Gulp.js

## How to use

- Clone this repo as WordPress Plugin
- Instal depediences with `npm i`
- Change proxy URL in browserSync from `http://elementor-demo.local` in `gulpfile.js`
- Run `npm run dev`
