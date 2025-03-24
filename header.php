<?php
    /**
     * The header for our theme
     *
     * This is the template that displays all of the <head> section and everything up until <div id="content">
     *
     * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
     *
     * @package KAPITAN_PUB
     */

?>
<!doctype html>
<html      <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body      <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
 <div class="container">
  <div class="header__inner">
   <div class="header__logo">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="logo">
   </div>
  </div>
 </div>
</header>