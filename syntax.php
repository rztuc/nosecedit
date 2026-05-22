<?php
/**
 * DokuWiki Plugin nosecedit (Syntax Component) 
 * 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps
 * @author  einhirn
 */

use dokuwiki\Extension\SyntaxPlugin;

/*
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_nosecedit extends DokuWiki_Syntax_Plugin
{

    /*
     * enable sectionedit by default
     */
    public function __construct()
    {
        global $ID;

        if ($ID != "") {
            p_set_metadata($ID,array("sectionedit"=>"on"),FALSE,TRUE);
        }
    }

    /*
     * What kind of syntax are we?
     */
    public function getType()
    {
        return 'substition';
    }

    /*
     * Where to sort in?
     */
    public function getSort()
    {
        return 155;
    }

    /*
     * Paragraph Type
     */
    public function getPType()
    {
        return 'normal';
    }

    /*
     * Connect pattern to lexer
     */
    public function connectTo($mode)
    {
        $this->Lexer->addSpecialPattern("~~NOSECTIONEDIT~~",$mode,'plugin_nosecedit');
    }


    /*
     * Handle the matches
     */
    public function handle($match, $state, $pos, Doku_Handler $handler)
    {
        global $ID;
        return (array($ID=>TRUE));        
    }
    
    /*
     * Create output
     */
    public function render($mode, Doku_Renderer $renderer, $opt)
    {
        global $ID;

        //save flags to metadata
        //if($mode == 'metadata')
        {
            if (isset($opt[$ID])==TRUE) {
                p_set_metadata($ID,array("sectionedit"=>"off"),TRUE,TRUE);
            }
            else {
                p_set_metadata($ID,array("sectionedit"=>"on"),FALSE,TRUE);
            }
        }
        return (TRUE);
    }
}
//Setup VIM: ex: et ts=4 enc=utf-8 :
