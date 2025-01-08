<?php
/**
 * Importer the demo content
 * Hooks for importer
 * @since  1.0
 * @package Archi
 */
function archi_importer() {
	return array(
		array(
			'name'       => 'Home Original Dark <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/original_dark_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Original',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Original Light <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/light/original_light_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/light/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/light/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/light/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/light/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Original Light',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'menu-main',
			)
		),
		array(
			'name'       => 'Home Modern',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/modern_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Modern',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Coworking',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/coworking_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Coworking',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Before After',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/before_after_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Before After',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Arts',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/arts_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Arts',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Portfolio Minimal',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/portfolio_minimal_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Portfolio Minimal',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Corporate',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/coporate_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Corporate',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Elegant Modern',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/elegant_modern_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Elegant',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Header Bottom',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/header_bottom_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Header Bottom',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Minisite <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/minisite/minisite-preview.jpg',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/minisite/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/minisite/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/minisite/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Masonry',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/masonry_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Masonry',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Profession',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/profession_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Profession',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Minimal',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/minimal_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Minimal',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Studio',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/studio_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Studio',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Garden <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/garden/garden_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/garden/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/garden/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/garden/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/garden/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'menu-1',
			)
		),
		array(
			'name'       => 'Home Industry <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/industry/industry_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/industry/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/industry/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/industry/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/industry/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'menu-main',
			)
		),
		array(
			'name'       => 'Home Photography <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/photography/photography_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/photography/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/photography/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/photography/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/photography/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Sidebar Dark <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/sidebar_dark_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Architecture Sidebar',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/architecture_sidebar_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Sidenav Architecture',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Sidebar Light <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-light/sidebar_light_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-light/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-light/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-light/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/sidebar-light/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Holiday',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/holiday_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Snowy',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Landing Page',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/landing_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home One Page',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home One Page',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/onepage_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home One Page 2',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Artist <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/artist/artist-preview.jpg',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/artist/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/artist/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/artist/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/artist/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Solar <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/solar/solar-preview.jpg',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/solar/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/solar/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/solar/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home Solar',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home CCTV Services <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/cctv/cctv-preview.jpg',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/cctv/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/cctv/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/cctv/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home CCTV',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Apartment <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/apartment/apartment_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/apartment/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/apartment/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/apartment/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/apartment/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Apartment',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Kitchen <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/kitchen/kitchen_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/kitchen/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/kitchen/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/kitchen/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/kitchen/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Kitchen',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Painting <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/painting/painting_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/painting/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/painting/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/painting/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home painting',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Swimming Pool <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/pool/pool-preview.jpg',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/pool/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/pool/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/pool/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home Pool',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Laundry <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/laundry/laundry-preview.jpg',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/laundry/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/laundry/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/laundry/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/laundry/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Laundry',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Doors & Windowns <span>Full Site</span>',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/doors/doors-preview.jpg',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/doors/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/doors/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/doors/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/doors/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Coming Soon',
			'preview'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/soon_preview.webp',
			'content'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/demo-content.xml',
			'customizer' => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/customizer.dat',
			'widgets'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/widgets.wie',
			'sliders'    => 'https://ot-archi.s3.amazonaws.com/demo-content/dark/sliders.zip',
			'pages'      => array(
				'front_page' => 'Coming Soon',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
	);
}

add_filter( 'soo_demo_packages', 'archi_importer', 30 );