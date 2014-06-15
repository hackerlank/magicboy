<?php
/**
 *  This file is part of amfPHP
 *
 * LICENSE
 *
 * This source file is subject to the license that is bundled
 * with this package in the file license.txt.
 * @package Amfphp_Examples
 */

/**
 * a gateway php script like the normal gateway except that it uses example services
 * @author Ariel Sommeria-klein
 */
require_once dirname(__FILE__) . '/../../../amfphp/Amfphp/ClassLoader.php';
require_once(__DIR__.'/../../app.inc');

$config = new Amfphp_Core_Config();
$config->serviceFolderPaths = array(dirname(__FILE__) . '/Services/');
$config->pluginsConfig['AmfphpCustomClassConverter'] = array('customClassFolderPaths' => array(dirname(__FILE__) . '/Services/Vo'));
$gateway = Amfphp_Core_HttpRequestGatewayFactory::createGateway($config);
$gateway->service();
$gateway->output();

?>
