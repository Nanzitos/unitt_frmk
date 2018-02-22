<?php

/*
 * This file is part of Twig.
 *
 * (c) 2009 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Extension_Asset extends Twig_Extension
{
    protected $defaultStrategy;

    public function __construct()
    {
        
    }

    /**
     * Returns the token parser instances to add to the existing list.
     *
     * @return array An array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances
     */
    public function getTokenParsers()
    {
        return array(new Twig_TokenParser_AutoEscape());
    }

    /**
     * Returns the node visitor instances to add to the existing list.
     *
     * @return array An array of Twig_NodeVisitorInterface instances
     */
    public function getNodeVisitors()
    {
        return array(new Twig_NodeVisitor_Escaper());
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            'asset' => new Twig_Filter_Function('twig_asset_filter'), 
        );
    }

     /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'asset';
    }
}

/**
 * Marks a variable as being safe.
 *
 * @param string $string A PHP variable
 */
function twig_raw_filter($string)
{
    return $string;
}


function path($args = false){
		
	$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
	unset($scriptName[sizeof($scriptName)-1]);
	$scriptName = array_values($scriptName);
	
	switch($_SERVER['HTTP_HOST']):

		case "tictac.peopleway.net":
			
			return 'http://'.$_SERVER['SERVER_NAME'].implode('/',$scriptName).'/'.$args;
			break;
			
		case "tictac.peopleway.com.br":
		case "tictac.peopleway.com.br:8085":
			
			return 'http://'.$_SERVER['SERVER_NAME'].':8085'.implode('/',$scriptName).'/'.$args;					
			#return $protocol.$domain.$port.$service;
			break;
			
		default:
			
			return 'http://'.$_SERVER['SERVER_NAME'].implode('/',$scriptName).'/'.$args;
				break;
		
	endswitch;			
	

}


###################################################################################################
function twig_asset_filter($args){
		
		return $this->path('web/bundles/wintimeiHealth/'.$args);

}
