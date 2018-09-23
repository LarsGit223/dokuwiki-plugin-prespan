<?php
/**
 * wpre Plugin: for output using word wrapped preformatted text
 * Syntax:     <wpre> text </wpre>
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Max Binshtok (max.binshtok@gmail.com)
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
 
/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_prespan extends DokuWiki_Syntax_Plugin {
 
    /**
     * return some info
     */
    function getInfo(){
        return array(
          'author' => 'Max Binshtok',
          'email'  => 'max.binshtok@gmail.com',
          'date'   => '2010-02-12',
          'name'   => 'wpre Plugin',
          'desc'   => 'for output using word wrapped preformatted text',
          'url'    => 'http://www.dokuwiki.org/plugin:wpre',
        );
    }
 
    /**
     * What kind of syntax are we?
     */
    function getType(){
        return 'formatting';
    }

 
    /**
     * What about paragraphs? (optional)
     */
   function getPType(){
       return 'normal';
   }
 
    /**
     * Where to sort in?
     */
    function getSort(){
        return 195;
    }

    function getAllowedTypes(){
        return array('formatting', 'substition', 'disabled');
    }

    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addEntryPattern('<prespan>(?=.*</prespan>)', $mode, 'plugin_prespan');
        $this->Lexer->addEntryPattern('\!\[(?=.*\]\!)', $mode, 'plugin_prespan');
    }

    function postConnect() {
        $this->Lexer->addExitPattern('</prespan>', 'plugin_prespan');
        $this->Lexer->addExitPattern('\]\!', 'plugin_prespan');
    }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        switch ($state) {
          case DOKU_LEXER_ENTER : 
            break;
          case DOKU_LEXER_MATCHED :
            break;
          case DOKU_LEXER_UNMATCHED :
            break;
          case DOKU_LEXER_EXIT :
            break;
          case DOKU_LEXER_SPECIAL :
            break;
        }
        return array($match, $state);
    }
 
    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
        if($mode == 'xhtml'){
            if ($data[1] == DOKU_LEXER_ENTER){
                $renderer->doc .= '<span class="prespan">';
            } else if ($data[1] == DOKU_LEXER_UNMATCHED){
                $renderer->doc .= $renderer->_xmlEntities($data[0]);
            } else if ($data[1] == DOKU_LEXER_EXIT){
                $renderer->doc .= '</span>';
            }
            return true;
        }
        return false;
    }   
}
 
//Setup VIM: ex: et ts=4 enc=utf-8 :
 
?>
