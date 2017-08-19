<?php
/** 
 * Copyright Lauri Turunen
 * A collection of standardized script snipplets for web analytics which can be dynamically called
 * Benefits: 
 * - Standardized measurements able to uphold tracking quality (no need for customization)
 *   As such using mature uniersally tested solutions signigantly increases analytics reliability
 * - Very easy to set up new tracking: just call the API with a basic tracking call
 * - Support for all types of tracking as the library is beign developed
 * 
 */

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();







?>