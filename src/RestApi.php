<?php

namespace UpdatePluginServer;

use WP_REST_Controller;
use WP_REST_Server;

class RestApi extends WP_REST_Controller {
    public $prefix;
    public $version;
    public $namespace;
    public $routes;
    public $config;
    public function __construct($config){
        $this->version = $config['plugin_version'];
        $this->prefix = $config['plugin_domain'];
        $this->namespace = $this->prefix . '/v' . $this->version;
        $this->routes = [
            'get-info'=> ['get_info'],
            'version'=>['get_version'],
            'update'=>['update', 'update_auth', [ 'license'=>[
                    'type'=>'string',
                    'default'=>false,
                ]]
            ],
        ]; 
        $this->config = $config;
    }
    public function register_routes() {
        foreach($this->routes as $route=>$config){
            list($callback, $perm_callback, $args) = $config;
            $args = is_array($args) ? $args : [];
            $this->register_route($route, $callback, $perm_callback, $args);
        }
    }

    private function register_route($route, $callback, $perm_callback=null, $args=[]){
        // we only need READ requests 
        register_rest_route($this->namespace, '/' . $route, array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array($this, $callback),
                'permission_callback' => $perm_callback ? array($this, $perm_callback) : [$this, 'no_auth'],
                'args'                => $args,
            ),
        ));
    }

    public function no_auth(){
        return true;
    }

    public function get_info(){
        $obj                = new \stdClass();
        $obj->slug          = $this->config['update']['plugin_slug']; //'plugin/plugin.php'
        $obj->plugin_name   = $this->config['update']['plugin_name']; //'plugin'
        $obj->new_version   = $this->config['update']['version'];
        $obj->requires      = $this->config['update']['required_wp_version'];
        // $obj->last_updated  = '2012-01-12';
        // $obj->sections      = array(
        //     'description'     => 'The new version of the Auto-Update plugin',
        //     'another_section' => 'This is another section',
        //     'changelog'       => 'Some new features'
        // );
        $obj->download_link = get_rest_url(null, '/'.$this->namespace . '/' . 'update');
        $response = $this->prepare_item_for_response();
        return new WP_REST_Response();
    }
    public function get_version(){

    }
    public function update(){
    }
    public function update_auth(){
    }
}
