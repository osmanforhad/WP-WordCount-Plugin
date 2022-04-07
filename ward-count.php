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
function wordcount_activation_hook()
{
}
//Action Hook for Plugin Activation
register_activation_hook(__FILE__, "wordcount_activation_hook");


//__CallBack function for Plugin DeActivation__//
function wordcount_deactivation_hook()
{
}
//Action Hook for Plugin DeActivation
register_deactivation_hook(__FILE__, "wordcount_deactivation_hook");


//__CallBack function for Plugin TextDomain__//
function wordcount_load_text_domain()
{
    load_plugin_textdomain('word-count', false, dirname(__FILE__) . "/languages");
}
//Action Hook for Plugin TextDomain
add_action("plugin_loaded", "wordcount_load_text_domain");


//__CallBack function for Count Total Words from any WordPress Post Content__//
function word_count_words($content)
{
    //php helper for remove the html tag from contact
    $stripped_content = strip_tags($content);
    //php helper for count total word from any post content
    $totalWord = str_word_count($stripped_content);
    $label = __('Total Number of Words', 'word-count');
    //__Filter Hook for User Input__//
    $label_for_userInput = apply_filters("wordcount_heading", $label);
    $tag = apply_filters("wordcount_tag", 'h2');
    //Result
    $content .= sprintf(
        '<%s>%s: %s</%s>',
        $tag,
        $label_for_userInput,
        $totalWord,
        $tag
    );
    return $content;
}
//Filter Hook for get wp content
add_filter('the_content', 'word_count_words');


//__CallBack function for Post Content Reading Time__//
function word_count_reading_time($content)
{
    //php helper for remove the html tag from contact
    $stripped_content = strip_tags($content);
    //php helper for count total word from any post content
    $totalWord = str_word_count($stripped_content);

    $reading_minute = floor($totalWord / 200);
    $second = 200 / 60;
    $reading_seconds = floor($totalWord % 200 / $second);
    //Check user permission for display reading time
    $is_visible = apply_filters('wordcount_display_reading_time', 1);
    if ($is_visible) {
        $label = __('Total Reading Time', 'word-count');
        //__Filter Hook for User Input__//
        $label_for_userInput = apply_filters("wordcount_readingtime_heading", $label);
        $tag = apply_filters("wordcount_readingtime_tag", 'h4');
        //Result
        $content .= sprintf(
            '<%s>%s: %s minutes % seconds</%s>',
            $tag,
            $label_for_userInput,
            $reading_minute,
            $reading_seconds,
            $tag
        );
    }
    return $content;
}

//Filter Hook for get wp content
add_filter('the_content', 'word_count_reading_time');
