<?php
// GAnalytics plugin, https://github.com/datenstrom/yellow-plugins/tree/master/ganalytics
// Copyright (c) 2013-2017 Datenstrom, https://datenstrom.se
// This file may be used and distributed under the terms of the public license.
/*
Autor: Ami Swami
Install: Put ganalytics.php in plugin directory
Configure: Add in the config.ini file the google analytics code, for example: 

gaTrackingId: UA-0000000-0
*/

class YellowGAnalytics
{
	const VERSION = "0.7.1";
	var $yellow;			//access to API
	
	// Handle initialisation
	function onLoad($yellow)
	{
		$this->yellow = $yellow;
		$this->yellow->config->setDefault("gaTrackingId", "yellow");
	}
	
	// Handle page extra HTML data
	function onExtra($name)
	{
		$output = NULL;
		if($name=="footer")
		{
			$gaId = $this->yellow->config->get("gaTrackingId");
			if(empty($url)) $url = $this->yellow->toolbox->getServerUrl();
			$output = "<script>\n";
			$output .= "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');\n";
			$output .= "ga('create', '".strencode($gaId)."', 'auto');\n";
			$output .= "  ga('send', 'pageview');\n";
			$output .= "</script>";
		}
		return $output;		
	}
}

$yellow->plugins->register("ganalytics", "YellowGAnalytics", YellowGAnalytics::VERSION);
?>