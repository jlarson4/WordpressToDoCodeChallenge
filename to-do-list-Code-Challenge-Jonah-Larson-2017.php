<?php

/*
Plugin Name: To Do List Code Challenge Jonah Larson 2017
Author: Jonah Larson
Description: A To Do List plugin desigin to track and inform users on a list of to-do objectives
Version: 1.0
License: GPL
*/
function tdlcc_install()
{
	global $wpdb;
	$table_name = 'wp_todoitems';
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	     //table not in database. Create new table
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          title text NOT NULL,
	          description text NOT NULL,
	          isCompleted boolean NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	     dbDelta( $sql );
	}
	else{
	}
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'tdlcc_install' );

wp_enqueue_style( 'style', plugins_url( '/admin/css/ToDo.css', __FILE__ ), get_stylesheet_uri());


function tdlcc_shortcodes_init()
{
    function tdlcc_shortcode($atts = [], $content = null)
    {
        // do something to $content
  	$header = '<h1> To Do List</h1>';
  	$titleTextArea = '<textarea rows="1" cols="20" id="wptd_title" onfocus="clearContents(this);">Title for your new To Do Items</textarea>';
  	$descriptionTextArea = '<textarea rows="1" cols="20" id="wptd_description" onfocus="clearContents(this);">To Do description</textarea><div id="addToDo">Add Item<span  class="dashicons dashicons-plus custom-dashicon"></span></div>';
  	$angularapphtml  = '<div data-ng-app="myApp" data-ng-controller="itemCtrl"><table>';
  	$angularapphtml .= '<tr ng-repeat="item in items" data-ng-if="item.isCompleted == 0"><td><h4>{{item.title}}</h4><h5>{{item.description}}</h5></td><td><input type="radio" id="item{{item.id}}"></input></td></tr>';
  	$angularapphtml .= '<tr ng-repeat="item in items" data-ng-if="item.isCompleted == 1"><td class="completed"><h4>{{item.title}}</h4><h5>{{item.description}}</h5></td><td></td></tr>';
  	$angularapphtml .= '</table></div>';
 	$content = $header . $titleTextArea . $descriptionTextArea . '<form id="checkboxes">' . $angularapphtml . '</form>';
        // always return
        return $content;
    }
    add_shortcode('tdlcc', 'tdlcc_shortcode');
}

function ajaxUpdate() {
	global $wpdb;
	$table_name = 'wp_todoitems';
	$wpdb->update( $table_name, array( 'isCompleted' => 1), array(  'id' => $_POST['item'] ), array('%d'), array('%s'));
	//echo updateToDo();
	die();
};
add_action('wp_ajax_nopriv_ajaxUpdate', 'ajaxUpdate');
add_action('wp_ajax_ajaxUpdate', 'ajaxUpdate');

function ajaxConversion() {
	global $wpdb;
	$table_name = 'wp_todoitems';
	$wpdb->insert( $table_name, array( 'title' => $_POST['title'], 'description' => $_POST['description'] ) );
	
	//$returnValue = updateToDo();
	//echo $returnValue;
	die();
};
add_action('wp_ajax_nopriv_ajaxConversion', 'ajaxConversion');
add_action('wp_ajax_ajaxConversion', 'ajaxConversion');

function updateToDo(){
	global $wpdb;
	$items = $wpdb->get_results("SELECT * FROM wp_todoitems ORDER BY isCompleted, id DESC;");
	//$toDoArea .= '<table id="replaceable">';
	$jsonArray = array();
	foreach($items as $item){
		
		$jsonArray[] = array('title' => $item->title, 
			'description' =>$item->description,
			'isCompleted' => $item->isCompleted,
			'id'=> $item->id);
		/*if ($item->isCompleted == 0){
			$toDoArea .= '<tr>';
			$toDoArea .= '<td><h4>'.$item->title.'</h4><h5>'.$item->description.'</h5></td>';
			$toDoArea .= '<td><input type="radio" id="item'. $item->id .'"></input></td>';
		} else {
			$toDoArea .= '<tr class="completed">';
			$toDoArea .= '<td><h4>'.$item->title.'</h4><h5>'.$item->description.'</h5></td>';
			$toDoArea .= '<td></td>';
		}
		$toDoArea .= '</tr>';*/
	}
	//$toDoArea .= '</table>';
	//create an array to use with angular

	echo json_encode($jsonArray);
	die;
}

add_action('wp_ajax_nopriv_updateToDo', 'updateToDo');
add_action('wp_ajax_updateToDo', 'updateToDo');

wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
wp_enqueue_script('angular', 'http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js', array(), null, false);

wp_enqueue_script('ToDo', plugins_url('/admin/js/ToDo.js', __FILE__));
wp_enqueue_script('ToDoAngular', plugins_url('/admin/js/AngularApp/displayMatchModule.js', __FILE__));

wp_localize_script( 'ToDo', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
wp_localize_script( 'ToDoAngular', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

add_action('init', 'tdlcc_shortcodes_init');
?>