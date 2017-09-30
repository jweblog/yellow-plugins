<?php
// YandexMetrica plugin, https://github.com/datenstrom/yellow-plugins/tree/master/yandex
// Copyright (c) 2013-2017 Datenstrom, https://datenstrom.se
// This file may be used and distributed under the terms of the public license.

/*
Autor: jweblog
Abstract: Get code https://metrica.yandex.com. To install yandex.php, put file in plugin directory.
Configure: Add in the config.ini file the google analytics code, for example:
yandexMetricaId: 0000000
*/

class YellowYandexMetrica
{
	const VERSION = "0.7.1";
	var $yellow;			
	
	// Handle initialisation
	function onLoad($yellow)
	{
		$this->yellow = $yellow;
		$this->yellow->config->setDefault("yandexMetricaId", "yellow");
	}
	
	// Handle page extra HTML data
	function onExtra($name)
	{
		$output = NULL;
		if($name=="footer")
		{
			$ymId = $this->yellow->config->get("yandexMetricaId");
			if(empty($url)) $url = $this->yellow->toolbox->getServerUrl();
			$output = "<script type=\"text/javascript\">";
			$output .= "(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter".strencode($ymId)." = new Ya.Metrika({ id:".strencode($ymId).", clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName(\"script\")[0], s = d.createElement(\"script\"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = \"text/javascript\"; s.async = true; s.src = \"https://mc.yandex.ru/metrika/watch.js\"; if (w.opera == \"[object Opera]\") { d.addEventListener(\"DOMContentLoaded\", f, false); } else { f(); } })(document, window, \"yandex_metrika_callbacks\");";
			$output .= "</script>";
			//$output .= "<noscript><img src=\"https://mc.yandex.ru/watch/'".strencode($ymId)."'\" style=\"position:absolute; left:-9999px;\" alt=\"yandex\" />";
			//$output .= "</noscript>"; 
		}
		return $output;		
	}
}

$yellow->plugins->register("yandex", "YellowYandexMetrica", YellowYandexMetrica::VERSION);
?>

 
  
