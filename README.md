# JC Core

Wordpress development theme framework to be included into themes, giving you a selection of theme features, widgets and shortcodes

## Contents

* [Features](#features)
	* [Shortcodes](#shortcodes)
		* [Recent Posts](#recent-posts)
		* [Simple Testimonials](#simple-testimonials)
* [Theme Integration](#theme-integration)

## Features

### Shortcodes

#### Recent Posts

##### Shortcode Options

* __limit__: set the amount of posts to be displayed

##### Customisable Templates

To use your own custom templates create files in the following template location.

```
/templates/recent_post/before.php
/templates/recent_post/content.php
/templates/recent_post/after.php
```

#### Simple Testimonials

##### Shortcode Options

* __testimonial__: testimonial message
* __client__: name of client

##### Customisable Templates

To use your own custom templates create files in the following template location.

```
/templates/simple_testimonial/before.php
/templates/simple_testimonial/content.php
/templates/simple_testimonial/after.php
```

## Theme Integration

Copy the jc-core folder into your theme directory and add the line of code to initiate the framework.

```
require_once  __DIR__ . DIRECTORY_SEPARATOR . 'jc-core' . DIRECTORY_SEPARATOR . 'jc-core.php';
```