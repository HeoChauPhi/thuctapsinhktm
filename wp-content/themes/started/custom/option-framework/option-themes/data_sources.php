<?php

VP_Security::instance()->whitelist_function('vp_skin_options');

function vp_skin_options()
{
	$log_directory = get_template_directory() . "\customtheme\css\skins";

	$results_array = array();

	if (is_dir($log_directory))
	{
		if ($handle = opendir($log_directory))
		{
			//Notice the parentheses I added:
			while(($file = readdir($handle)) !== FALSE)
			{
				if ($file != "." && $file != "..") {
					$results_array[] = $file;
				}
			}
			closedir($handle);
		}
	}
	$result = array();
	foreach($results_array as $value){
		$bigcontinents = array(
			$value,
		);
		foreach ($bigcontinents as $data)
		{
			$result[] = array('value' => $data, 'label' => $data, 'img' => 'http://placehold.it/100x100');
		}
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_get_social_fa');

function vp_get_social_fa() {
	$socmeds = array(
		array('value' => 'adn', 'label' => 'Adn'),
		array('value' => 'android', 'label' => 'Android'),
		array('value' => 'angellist', 'label' => 'Angellist'),
		array('value' => 'apple', 'label' => 'Apple'),
		array('value' => 'behance', 'label' => 'Behance'),
		array('value' => 'behance-square', 'label' => 'Behance Square'),
		array('value' => 'bitbucket', 'label' => 'Bitbucket'),
		array('value' => 'bitbucket-square', 'label' => 'Bitbucket Square'),
		array('value' => 'bitcoin', 'label' => 'Bitcoin'),
		array('value' => 'btc', 'label' => 'Btc'),
		array('value' => 'cc-amex', 'label' => 'CC Amex'),
		array('value' => 'cc-discover', 'label' => 'CC Discover'),
		array('value' => 'cc-mastercard', 'label' => 'CC Mastercard'),
		array('value' => 'cc-paypal', 'label' => 'CC Paypal'),
		array('value' => 'cc-stripe', 'label' => 'CC Stripe'),
		array('value' => 'cc-visa', 'label' => 'CC Visa'),
		array('value' => 'codepen', 'label' => 'Codepen'),
		array('value' => 'css3', 'label' => 'CSS3'),
		array('value' => 'delicious', 'label' => 'Delicious'),
		array('value' => 'deviantart', 'label' => 'Deviantart'),
		array('value' => 'digg', 'label' => 'Digg'),
		array('value' => 'dribbble', 'label' => 'Dribbble'),
		array('value' => 'dropbox', 'label' => 'Dropbox'),
		array('value' => 'drupal', 'label' => 'Drupal'),
		array('value' => 'empire', 'label' => 'Empire'),
		array('value' => 'facebook', 'label' => 'Facebook'),
		array('value' => 'facebook-square', 'label' => 'Facebook Square'),
		array('value' => 'flickr', 'label' => 'Flickr'),
		array('value' => 'foursquare', 'label' => 'Foursquare'),
		array('value' => 'ge', 'label' => 'Ge'),
		array('value' => 'git', 'label' => 'Git'),
		array('value' => 'git-square', 'label' => 'Git Square'),
		array('value' => 'github', 'label' => 'Github'),
		array('value' => 'github-alt', 'label' => 'Github Alt'),
		array('value' => 'github-square', 'label' => 'Github Square'),
		array('value' => 'gittip', 'label' => 'Gittip'),
		array('value' => 'google', 'label' => 'Google'),
		array('value' => 'google-plus', 'label' => 'Google Plus'),
		array('value' => 'google-plus-square', 'label' => 'Google Plus Square'),
		array('value' => 'google-wallet', 'label' => 'Google Wallet'),
		array('value' => 'hacker-news', 'label' => 'Hacker News'),
		array('value' => 'html5', 'label' => 'HTML5'),
		array('value' => 'instagram', 'label' => 'Instagram'),
		array('value' => 'ioxhost', 'label' => 'Ioxhost'),
		array('value' => 'joomla', 'label' => 'Joomla'),
		array('value' => 'jsfiddle', 'label' => 'Jsfiddle'),
		array('value' => 'lastfm', 'label' => 'Lastfm'),
		array('value' => 'lastfm-square', 'label' => 'Lastfm Square'),
		array('value' => 'linkedin', 'label' => 'Linkedin'),
		array('value' => 'linkedin-square', 'label' => 'Linkedin Square'),
		array('value' => 'linux', 'label' => 'Linux'),
		array('value' => 'maxcdn', 'label' => 'Maxcdn'),
		array('value' => 'meanpath', 'label' => 'Meanpath'),
		array('value' => 'openid', 'label' => 'Openid'),
		array('value' => 'pagelines', 'label' => 'Pagelines'),
		array('value' => 'paypal', 'label' => 'Paypal'),
		array('value' => 'pied-piper', 'label' => 'Pied Piper'),
		array('value' => 'pied-piper-alt', 'label' => 'Pied Piper Alt'),
		array('value' => 'pinterest', 'label' => 'Pinterest'),
		array('value' => 'pinterest-square', 'label' => 'Pinterest Square'),
		array('value' => 'ra', 'label' => 'RA'),
		array('value' => 'rebel', 'label' => 'Rebel'),
		array('value' => 'reddit', 'label' => 'Reddit'),
		array('value' => 'reddit-square', 'label' => 'Reddit Square'),
		array('value' => 'renren', 'label' => 'Renren'),
		array('value' => 'share-alt', 'label' => 'Share Alt'),
		array('value' => 'share-alt-square', 'label' => 'Share Alt Square'),
		array('value' => 'skype', 'label' => 'Skype'),
		array('value' => 'slack', 'label' => 'Slack'),
		array('value' => 'slideshare', 'label' => 'Slideshare'),
		array('value' => 'soundcloud', 'label' => 'Soundcloud'),
		array('value' => 'spotify', 'label' => 'Spotify'),
		array('value' => 'stack-exchange', 'label' => 'Stack Exchange'),
		array('value' => 'stack-overflow', 'label' => 'Stack Overflow'),
		array('value' => 'steam', 'label' => 'Steam'),
		array('value' => 'steam-square', 'label' => 'Steam Square'),
		array('value' => 'stumbleupon', 'label' => 'Stumbleupon'),
		array('value' => 'stumbleupon-circle', 'label' => 'Stumbleupon Circle'),
		array('value' => 'tencent-weibo', 'label' => 'Tencent Weibo'),
		array('value' => 'trello', 'label' => 'Trello'),
		array('value' => 'tumblr', 'label' => 'Tumblr'),
		array('value' => 'tumblr-square', 'label' => 'Tumblr Square'),
		array('value' => 'twitch', 'label' => 'Twitch'),
		array('value' => 'twitter', 'label' => 'Twitter'),
		array('value' => 'twitter-square', 'label' => 'Twitter Square'),
		array('value' => 'vimeo-square', 'label' => 'Vimeo Square'),
		array('value' => 'vine', 'label' => 'Vine'),
		array('value' => 'vk', 'label' => 'VK'),
		array('value' => 'wechat', 'label' => 'Wechat'),
		array('value' => 'weibo', 'label' => 'Weibo'),
		array('value' => 'weixin', 'label' => 'Weixin'),
		array('value' => 'windows', 'label' => 'Windows'),
		array('value' => 'wordpress', 'label' => 'Wordpress'),
		array('value' => 'xing', 'label' => 'Xing'),
		array('value' => 'xing-square', 'label' => 'Xing Square'),
		array('value' => 'yahoo', 'label' => 'Yahoo'),
		array('value' => 'yelp', 'label' => 'Yelp'),
		array('value' => 'youtube', 'label' => 'Youtube'),
		array('value' => 'youtube-play', 'label' => 'Youtube Play'),
		array('value' => 'youtube-square', 'label' => 'Youtube Square'),
	);

	return $socmeds;
}

