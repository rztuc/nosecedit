<?php
/**
 * DokuWiki Plugin nosecedit (Action Component) 
 * 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps
 * @author  einhirn
 */

use dokuwiki\Extension\ActionPlugin;
use dokuwiki\Extension\EventHandler;
use dokuwiki\Extension\Event;

class action_plugin_nosecedit extends DokuWiki_Action_Plugin
{
    /**
     * Register its handlers with the DokuWiki's event controller
     */
    public function register(EventHandler $controller)
    {
        $controller->register_hook('HTML_SECEDIT_BUTTON', 'BEFORE', $this, 'html_secedit_button');
    }

    public function html_secedit_button(Event $event)
    {
        global $ID;

        //Section event?
        if ($event->data['target'] !== 'section' && $event->data['target'] !== 'table')
        {
            return;
        }

        //disable requested?
        if (p_get_metadata($ID,"sectionedit",FALSE) == "off")
        {
            $event->data['name'] = "";
        }
    }
}
# vi:ts=4 sw=4 et
#
