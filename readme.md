Visual is a well-crafted responsive WordPress theme designed to showcase images, artwork and photgraphy in a smart grid layout.

## Installation Instructions

This theme can be installed under "Appearance" > "Themes".  Click on the "Add New" button to upload the theme zip file.

## Developer Instructions

### Grunt

This theme uses Grunt to compile SASS and Javascript.  It also generates translation files, autoprefixes styles, and concats and minifies scripts.

If you have Grunt installed, just run `npm install` in the theme directory to download dependencies.

`grunt watch` can be used while editing SASS and JS.
`grunt release` should be used before browser testing or releasing.

## Credits

Resources
===

This theme makes use of several libraries and scripts built by others.  A big thanks to everyone who has worked on these projects:

Visual was built off the foundation of Underscores (_s):
===

* Underscores: http://underscores.me
* GPL License: https://github.com/Automattic/_s/blob/master/license.txt

Fonts
===

* Raleway (http://www.google.com/webfonts/specimen/Raleway)
* SIL Open Font License: https://github.com/theleagueof/raleway/blob/master/Open%20Font%20License.markdown

Icon Fonts:
===

* Entypo by Daniel Bruce (http://www.entypo.com/)
* SIL Open Font License: http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
* Font Awesome (http://fortawesome.github.com/Font-Awesome)
* SIL Open Font License: http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL

Icon glyphs packaged with Fontello
===

* Fontello: http://fontello.com

## Change Log

Complete list of commits can be found at:
https://github.com/devinsays/visual/commits/master

1.3.2 (10-25-2016)
===

* Bugfix: Wonky menu display (visuallyhidden classes not set correctly)
* Update: Remove language files


1.3.1 (09-25-2016)
===

* Update: Support WordPress 'title-tag'
* Update: Sanitization callbacks on Customizer settings


1.3.0 (09-11-2016)
===

* Translation: Finnish (fi) - Sami Keijonen
* Translation: French (fr_FR) - FxB
* Translation: Portuguese (pt_BR) - Dionizio Bonfim Bach
* Update: Refactor javascript, use WordPress version of Masonry
* Update: Support WordPress 'title-tag'
* Update: Sanitization callbacks on Customizer settings

1.2.0
===

* Update to use grunt workflow
* Support HTML5 markup for comments, search, and gallery
* Fix for styling of alternate input types [email]
* Fix for wide gutters at 790px-820px in masonry
* Better compatibility with long site titles
* Improved RTL compatibility

1.1.0
===

* Fix developer notice when excerpt option not set
* Fix mobile menu when wpadminbar is visible
* Remove navigation walker
* Better support for tweet embeds in masonry layout
* Update screenshot
* Update theme tags
* Remove stylesheet options that are no longer in theme

1.0
===

* Better Jetpack infinite scroll reloading
* Fix theme warning when $meta_text was undefined
* Remove unused images
* Simplify comments-link markup

0.9
===

* Remove light.css from codebase
* Add featured images to the RSS feeds
* Added RTL stylesheet

0.8
===

* Sticky footer
* Fix for styles notice

0.7
===

* Update entry-summary styles on search page
* Update widget title styles
* Update 404 page widget styling
* Option to display full content or excerpts on archives

0.6
===

* Display full content by default on archives
* Added full-width page template
* Replace Options Framework with theme customizer
* Remove color palette option unless alternate is in use

0.5
===

* Updates for widget padding
* Fix for masonry margins
* Better menus for small screen sizes

0.4
===

* Included Options Framework library directly in theme
* Support for Jetpack Infinite Scroll

0.3
===

* Added options panel
* Added multiple style options (dark, light, minimal)
* Added option for footer text
* Removed image lazy loading
* Update SASS files to use bourbon
* Bugfix for responsive menus
* Added .pot file for translations

0.2.2
===

* Style update for pre tags
* Updates readme.txt to link to licenses

0.2.1
===

* New screenshot
* Updated theme URI
* Better support for fallback menus

0.2
===

* Added Icon font Entypo
* Lazy load of images in masonry layout
* Updates to archive, search and 404 templates
* Design polish

0.1
===

* Initial submission to WordPress.org