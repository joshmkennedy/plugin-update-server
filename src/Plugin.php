<?php
namespace UpdatePluginServer;

class Plugin
{
    public const DOMAIN = 'plugin-update-server';
    public const VERSION = '0.1.0';
    public $config;
    public function __construct($file) {
        $this->config = [
            'plugin_basename' => plugin_basename($file),
            'plugin_domain' => self::DOMAIN,
            'plugin_path' => plugin_dir_path($file),
            'plugin_relative_path' => basename(plugin_dir_path($file)),
            'plugin_url' => plugin_dir_url($file),
            'plugin_version' => self::VERSION,
            //information about the plugin we are hosting
            'update' =>[
                'plugin_slug'=>'',
                'plugin_name'=>'',
                'version'=>'',
                'required_wp_verion'=>'5.0',
            ],
        ];
    }
    public function load() {
        //set hooks
    }
}
