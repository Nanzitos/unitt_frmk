<?php

#Autoloader ==============================================================================
#

#MySQL Services ==========================================================================
require_once '../vendor/influx/influx/influx.class.php';

#Slug ===================================================================================
require_once '../vendor/Slug-master/lib/Slug.class.php';

#YML Reader Service ======================================================================
require_once '../vendor/spyc-0.5/spyc.php';


#Commom Library Classes ==================================================================
include 'library/class.Filters.php';
include 'library/SecureSessionHandler.php';
include 'library/class.phpmailer.php';
include 'library/class.Date.php';
include 'library/class.Render.php';
// include 'library/class.xmltoarray.php';


#Twig Library Template ===================================================================

include '../vendor/Twig/Autoloader.php';
Twig_Autoloader::register();


//LOAD COMMONS CLASSES @@ ----------------------------------------------------------------
include 'commons.php';


//LOAD AUTOLOADER  @@ --------------------------------------------------------------------
include 'autoloader.php';
