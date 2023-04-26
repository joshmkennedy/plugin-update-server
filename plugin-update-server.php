<?php

/**
 * Plugin Name:       Plugin Update Server
 * Description:       Handles Plugin updates with licenses
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       plugin-update-server
 *
 */


require_once dirname(__FILE__) . '/src/Autoloader.php';
\UpdatePluginServer\Autoloader::register();


global $plugin_update_server;
$plugin_update_server = new \UpdatePluginServer\Plugin(__FILE__);
$plugin_update_server->load();

