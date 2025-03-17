<?php

/**
 * @package     SendPulse chat, a Joomla plugin
 *
 * @version : 1.0.0
 * @link: https://webds.net
 * @author      Roman WebDS
 * @copyright   Copyright © 2025 WebDS (webds.net) All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE.txt
 *
 *  @email: info@webds.net
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

class PlgSystemWebds2spchat extends CMSPlugin
{
    protected $app;

    public function onAfterRender()
    {

	
	
        if ($this->app->isClient('site')) {
            $excludePages = $this->params->get('exclude_pages', '');
            $code_chat    = $this->params->get('code_chat', '');

            $currentPage = $this->app->getMenu()->getActive()->route;


 	   


        $is_show = true;   		

	$excludePagesList = explode("\n", $excludePages);

	if (!empty($excludePagesList)){

		foreach($excludePagesList as $excludePageItem){

			if (trim($excludePageItem) == trim($currentPage)){
                			$is_show = false;
			}

		}

	}
/*
	 echo "<pre>";
            echo "Current Page: " . $currentPage . "\n";
            echo "Exclude Pages: " . $excludePages . "\n";
            echo "Code Chat: " . $code_chat . "\n";
	    print_r(explode("\n", $excludePages));
	 
echo "</pre>";
*/
            

		
            $body = $this->app->getBody();

		if ($is_show){
			//$html = '<div id="webds-sp-chat">' . htmlspecialchars($code_chat, ENT_QUOTES, 'UTF-8') . '</div>';
	    		$html = '<div id="webds-sp-chat"><script src="https://cdn.pulse.is/livechat/loader.js" data-live-chat-id="'.htmlspecialchars($code_chat, ENT_QUOTES, "UTF-8").'" async></script></div>';
			$body = str_replace('</body>', $html . '</body>', $body);
		}

            

            $this->app->setBody($body);
        }
    }
}