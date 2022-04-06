<?php
/**
 * Plugin Name:       Word Count
 * Plugin URI:        https://osmanforhad.net/plugins/practice/
 * Description:       WordPress Word Count Plugin by osman forhad. Which will count word from any WorPress Post
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            osman forhad
 * Author URI:        https://author.osmanforhad.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       word-count
 * Domain Path:       /languages/
 */

 //__CallBack function for Plugin Activation__//
function wordcount_activation_hook(){

}
//Action Hook for Plugin Activation
register_activation_hook(__FILE__, "wordcount_activation_hook");


 //__CallBack function for Plugin DeActivation__//
function wordcount_deactivation_hook(){

}
//Action Hook for Plugin DeActivation
register_deactivation_hook(__FILE__, "wordcount_deactivation_hook");


 //__CallBack function for Plugin TextDomain__//
function wordcount_load_text_domain(){
    load_plugin_textdomain('word-count', false, dirname(__FILE__)."/languages");
}
//Action Hook for Plugin TextDomain
add_action("plugin_loaded", "wordcount_load_text_domain");

 //__CallBack function for Count Total Words from any WordPress Post Content__//
function word_count_words($content){
    //php helper for remove the html tag from contact
    $stripped_content = strip_tags($content);
     //php helper for count total word from any post content
    $wordn = str_word_count($stripped_content);
    $label = __('Total Number of Words', 'word-count');
    //Result
    $content .= sprintf('<h2>%s: %s</h2>', $label, $wordn);
    return $content;
}
//Filter Hook for get wp content
add_filter('the_content', 'word_count_words');