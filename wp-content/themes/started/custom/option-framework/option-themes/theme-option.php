<?php
return array(
	'title' => __('Framework Theme Option', 'vp_textdomain'),
	'logo' => get_template_directory_uri() . '/img/logo.png',
	'menus' => array(
		array(
			'title' => __('Standard Controls', 'vp_textdomain'),
			'name' => 'standard_control',
			'icon' => 'font-awesome:fa-magic',
			'menus' => array(
				array(
					'title' => __('General Settings', 'vp_textdomain'),
					'name' => 'general_settings',
					'icon' => 'font-awesome:fa-th-large',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Toggle display', 'vp_textdomain'),
							'name' => 'toggle_display',
							'description' => __('Enable or disable the display of certain page elements.', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'logo',
									'label' => __('Logo', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'site_name',
									'label' => __('Site Name', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '0',
								),
								array(
									'type' => 'toggle',
									'name' => 'tagline',
									'label' => __('Tag Line', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '0',
								),
							),
						),
						array(					
							'type' => 'section',
							'title' => __('Setting custom your logo', 'vp_textdomain'),
							'name' => 'custom_logo',
							'dependency' => array(
								'field' => 'logo',
								'function' => 'vp_dep_boolean',
							),
							'fields' => array(
								array(
									'type' => 'textbox',
									'name' => 'path_logo',
									'label' => __('Path to custom logo ', 'vp_textdomain'),
									'description' => __('The path to the file you would like to use as your logo file instead of the default logo.', 'vp_textdomain'),
									'validation' => 'url',
								),
								array(
									'type' => 'upload',
									'name' => 'up_logo',
									'label' => __('Upload logo image ', 'vp_textdomain'),
									'description' => __("If you don't have direct file access to the server, use this field to upload your logo.", 'vp_textdomain'),
									'default' => get_template_directory_uri() . '/img/logo.png',
								),
							),
						),
					),
				),
				array(
					'title' => __('Styles and Scripts', 'vp_textdomain'),
					'name' => 'styles_scripts',
					'icon' => 'font-awesome:fa-bug',
					'controls' => array(
						array(
							'type' => 'toggle',
							'name' => 'disable_styles',
							'label' => __('Disable Drupal Core CSS', 'vp_textdomain'),
							'description' => __('Removes all CSS files provided by Drupal Core. <strong>Warning:</strong> This can break things, use with caution.', 'vp_textdomain'),
							'default' => '0',
						),
					),
				),
			),
		),
		
		array(
			'title' => __('Options Framework', 'vp_textdomain'),
			'name' => 'options_framework',
			'icon' => 'font-awesome:fa-cog',
			'menus' => array(
				array(
					'title' => __('Pages Option', 'vp_textdomain'),
					'name' => 'page_optipon',
					'icon' => 'font-awesome:fa-picture-o',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Header Custom Block', 'vp_textdomain'),
							'name' => 'header_options',
							'description' => __('', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'header_option',
									'label' => __('Enable Custom Block', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '0',
								),
								array(
									'type' => 'wpeditor',
									'name' => 'custom_header_html',
									'label' => __('Custom html', 'vp_textdomain'),
									'description' => __('Wordpress tinyMCE editor.', 'vp_textdomain'),
									'use_external_plugins' => '1',
									'disabled_externals_plugins' => '',
									'disabled_internals_plugins' => '',
									'dependency' => array(
										'field' => 'header_option',
										'function' => 'vp_dep_boolean',
									),
								),
								array(
									'type' => 'upload',
									'name' => 'up_banner',
									'label' => __('Upload Banner image ', 'vp_textdomain'),
									'description' => __('Your banner display in after header.', 'vp_textdomain'),
									'dependency' => array(
										'field' => 'header_option',
										'function' => 'vp_dep_boolean',
									),
								),
							),
						),
						array(
							'type' => 'section',
							'title' => __('Header display block', 'vp_textdomain'),
							'name' => 'display_block',
							'dependency' => array(
								'field' => 'header_option',
								'function' => 'vp_dep_boolean',
							),
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'search_option',
									'label' => __('Enable Search Form', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '0',
								),
							),
						),
						array(
							'type' => 'section',
							'title' => __('Footer Custom Block', 'vp_textdomain'),
							'name' => 'footer_options',
							'description' => __('', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'footer_option',
									'label' => __('Enable Custom Block', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '0',
								),
								array(
									'type' => 'wpeditor',
									'name' => 'custom_footer_html',
									'label' => __('Custom html', 'vp_textdomain'),
									'description' => __('Wordpress tinyMCE editor.', 'vp_textdomain'),
									'use_external_plugins' => '0',
									'disabled_externals_plugins' => '',
									'disabled_internals_plugins' => '',
									'dependency' => array(
										'field' => 'footer_option',
										'function' => 'vp_dep_boolean',
									),
								),
							),
						),
						
						array(
							'type' => 'section',
							'title' => __('Layout', 'vp_textdomain'),
							'name' => 'layout_options',
							'description' => __('', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'radioimage',
									'name' => 'layout_option',
									'label' => __('Chosen Layout', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'item_max_height' => '70',
									'item_max_width' => '70',
									'items' => array(
										array(
											'value' => 'theme_one_col',
											'label' => __('Only Main Content', 'vp_textdomain'),
											'img' => get_path_img() . '/layout/1col.png',
										),
										array(
											'value' => 'theme_two_col_left',
											'label' => __('Sidebar - Main Content', 'vp_textdomain'),
											'img' => get_path_img() . '/layout/2cl.png',
										),
										array(
											'value' => 'theme_two_col_right',
											'label' => __('Main Content - Sidebar', 'vp_textdomain'),
											'img' => get_path_img() . '/layout/2cr.png',
										),
										array(
											'value' => 'theme_three_col',
											'label' => __('Sidebar left - Main Content - Sidebar Right', 'vp_textdomain'),
											'img' => get_path_img() . '/layout/3cm.png',
										),
									),
									'default' => 'theme_one_col',
								),
								array(
									'type' => 'radiobutton',
									'name' => 'width_layout',
									'label' => __('Chosen layout width', 'vp_textdomain'),
									'items' => array(
										array(
											'value' => 'full',
											'label' => __('Layout Full width', 'vp_textdomain'),
										),
										array(
											'value' => 'boxed',
											'label' => __('Layout Boxed', 'vp_textdomain'),
										),
									),
									'default' => array(
										'full',
									),
								),
								array(
									'type' => 'slider',
									'name' => 'width_boxed',
									'label' => __('Scroll chosen width layout', 'vp_textdomain'),
									'description' => __('This width layout has minimum value of 960px, maximum value of 1200px', 'vp_textdomain'),
									'min' => '960',
									'max' => '1200',
									'step' => '10',
									'default' => '960',
								),
							),
						),
						
						
					),
				),
				array(
					'title' => __('Skin Options', 'vp_textdomain'),
					'name' => 'skins_options',
					'icon' => 'font-awesome:fa-picture-o',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('What a Wonderful World', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'radiobutton',
									'name' => 'skin_option',
									'label' => __('Please select a skin ', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => 'default',
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value'  => 'vp_skin_options',
											),
										),
									),
								),
							),
						),
					),
				),
				array(
					'title' => __('Background', 'vp_textdomain'),
					'name' => 'background_options',
					'icon' => 'font-awesome:fa-picture-o',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Decider', 'vp_textdomain'),
							'name' => 'background_pattern',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'display_background_pattern',
									'label' => __('Background Patterns (Repeat)', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '0',
								),
							),
						),
						array(
							'type' => 'section',
							'title' => __('Select Background Pattern', 'vp_textdomain'),
							'name' => 'pattern_items',
							'dependency' => array(
								'field' => 'display_background_pattern',
								'function' => 'vp_dep_boolean',
							),
							'fields' => array(
								array(
									'type' => 'upload',
									'name' => 'up_pattern',
									'label' => __('Upload pattern background', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
								),
								array(
									'type' => 'radioimage',
									'name' => 'pattern_item',
									'label' => __('Select Background Pattern items', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'item_max_height' => '40',
									'item_max_width' => '40',
									'items' => array(
										array(
											'value' => 'none',
											'label' => __('None', 'vp_textdomain'),
											'img' => '',
										),
										array(
											'value' => get_path_img() . '/patterns/bg1.png',
											'label' => __('Background 1', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg1.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg2.png',
											'label' => __('Background 1', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg2.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg3.png',
											'label' => __('Background 3', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg3.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg4.png',
											'label' => __('Background 4', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg4.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg5.png',
											'label' => __('Background 5', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg5.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg6.png',
											'label' => __('Background 6', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg6.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg7.png',
											'label' => __('Background 7', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg7.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg8.png',
											'label' => __('Background 8', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg8.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg9.png',
											'label' => __('Background 9', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg9.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg10.png',
											'label' => __('Background 10', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg10.png',
										),
										array(
											'value' => get_path_img() . '/patterns/bg11.png',
											'label' => __('Background 11', 'vp_textdomain'),
											'img' => get_path_img() . '/patterns/bg11.png',
										),
									),
									'default' => array(
										'none',
									),
								),
							),
						),
						array(
							'type' => 'section',
							'title' => __('Decider', 'vp_textdomain'),
							'name' => 'background_image',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'display_background_image',
									'label' => __('Background Image (No-Repeat)', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '0',
								),
							),
						),
						array(					
							'type' => 'section',
							'title' => __('Select Background Pattern', 'vp_textdomain'),
							'name' => 'image_items',
							'dependency' => array(
								'field' => 'display_background_image',
								'function' => 'vp_dep_boolean',
							),
							'fields' => array(
								array(
									'type' => 'upload',
									'name' => 'up_image',
									'label' => __('Upload image background', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
								),
								array(
									'type' => 'radioimage',
									'name' => 'images_item',
									'label' => __('Select Background Image items', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'item_max_height' => '150',
									'item_max_width' => '150',
									'items' => array(
										array(
											'value' => get_path_img() . '/background/themeski_bg.jpg',
											'label' => __('Image 1', 'vp_textdomain'),
											'img' => get_path_img() . '/background/themeski_bg.jpg',
										),
									),
									'default' => array(
										get_path_img() . '/background/themeski_bg.jpg',
									),
								),
							),
						),
						array(
							'type' => 'section',
							'title' => __('Decider', 'vp_textdomain'),
							'name' => 'background_color',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'display_background_color',
									'label' => __('Background Color', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '0',
								),
							),
						),
						array(					
							'type' => 'section',
							'title' => __('Select Background Pattern', 'vp_textdomain'),
							'name' => 'color_items',
							'dependency' => array(
								'field' => 'display_background_color',
								'function' => 'vp_dep_boolean',
							),
							'fields' => array(
								array(
									'type' => 'color',
									'name' => 'top_color',
									'label' => __('Top Background Color', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => 'rgba(255,255,255,0.5)',
									'format' => 'rgba',
								),
								array(
									'type' => 'color',
									'name' => 'bottom_color',
									'label' => __('Bottom Background Color', 'vp_textdomain'),
									'description' => __('', 'vp_textdomain'),
									'default' => '#ffffff',
								),
							),
						),
					),
				),
				array(
					'title' => __('Fonts', 'vp_textdomain'),
					'name' => 'fonts_option',
					'icon' => 'font-awesome:fa-cogs',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Disable google webfont', 'vp_textdomain'),
							'name' => 'base_font_setting',
							'description' => __('', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'display_base_font',
									'label' => __('Use the google webfont family', 'vp_textdomain'),
									'description' => __('Use the custom google webfont family', 'vp_textdomain.', 'vp_textdomain'),
								),
							),
						),
						array(
							'type' => 'section',
							'title' => __('Base font setting', 'vp_textdomain'),
							'name' => 'custom_base_font',
							'dependency' => array(
								'field' => 'display_base_font',
								'function' => 'vp_dep_boolean',
							),
							'fields' => array(
								array(
									'type' => 'html',
									'name' => 'base_font_preview',
									'binding' => array(
										'field'    => 'base_font_face,base_font_style,base_font_weight,base_font_size, base_line_height',
										'function' => 'vp_font_preview',
									),
								),
								array(
									'type' => 'select',
									'name' => 'base_font_face',
									'label' => __('Base Font Face', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_get_gwf_family',
											),
										),
									),
									'default' => '{{first}}'
								),
								array(
									'type' => 'radiobutton',
									'name' => 'base_font_style',
									'label' => __('Base Font Style', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'binding',
												'field' => 'base_font_face',
												'value' => 'vp_get_gwf_style',
											),
										),
									),
									'default' => array(
										'{{first}}',
									),
								),
								array(
									'type' => 'radiobutton',
									'name' => 'base_font_weight',
									'label' => __('Base Font Weight', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'binding',
												'field' => 'base_font_face',
												'value' => 'vp_get_gwf_weight',
											),
										),
									),
									'default' => array(
										'{{first}}',
									),
								),
								array(
									'type'    => 'slider',
									'name'    => 'base_font_size',
									'label'   => __('Base Font Size (px)', 'vp_textdomain'),
									'min'     => '5',
									'max'     => '32',
									'default' => '16',
								),
								array(
									'type'    => 'slider',
									'name'    => 'base_line_height',
									'label'   => __('Base Line Height (em)', 'vp_textdomain'),
									'min'     => '0',
									'max'     => '3',
									'default' => '1.5',
									'step'    => '0.1',
								),
							),
						),
					),
				),
			),
		),
	)
);
/**
 *EOF
 */