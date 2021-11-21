Tonystaffiero.com Child Theme
===================

Bootstrap (http://getbootstrap.com) in WordPress theme form. (based on WP-Bootstrap)

GETTING STARTED
_______________

To get started, open Terminal or a command prompt and run:

  cd path/to/wp-content/themes
  git clone https://git@bitbucket.org:fredswan/tones.git
  npm install
  grunt

  for live browser update change `proxy: "localhost:8888/theme-dev/` to your local url

FEATURES
________

Tonystaffiero.com Child Theme uses grunt as a task manager to help aid development. Check out the gruntfile.js file for more detail on the default tasks. tones comes with the livereload, sass, grunticon and more tasks out of the box.

To override any of the existing styles included from the parent theme, just comment out or add to /path/to/theme/custom-tones-child/styles.scss 


Page Templates
______________

    - Services template
    - Doctor Search template
    - Staff Template

Lightbox
________

To use lightbox add `data-lity` to link

Carousel
________

There are two carousel shortcodes to choose from:

  - Standard Carousel
  - Posts Carousel


Shortcodes
__________

We’ve built in some shortcodes so you can easily add UI elements found in Bootstrap.

Sidebars
________

There are two different sidebars. One for the homepage and one for the other pages. Add widgets to them.