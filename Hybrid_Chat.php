<?php
/*
    Plugin Name: Hybrid Chat
    Plugin URI:
    Description: Hybrid.Chat is a Site Chat + Chatbot + Click to call platform that lets you talk to your website visitors in Slack or Mattermost.
    Version: 1.0
    Author: Hybrid.Chat
    Author URI: https://profiles.wordpress.org/hybridchat
    License: Public Domain
    @since 3.0.1
*/



/*
    S E T T I N G S   P A G E
    =========================
    For site-wide and footer code
*/

if(!class_exists('aFHFCClass')) :
  define('AFHDFTRCD_ID', 'aFhfc');
  define('AFHDFTRCD_NICK', 'Hybrid.Chat');
  class aFHFCClass
  {
    public static function file_path($file)
    {
      return plugin_dir_path(__FILE__).$file;
    }
    public static function register()
    {
      register_setting(AFHDFTRCD_ID.'_options', 'aFhfc_site_wide_footer_code');
    }
    public static function menu()
    {
      add_options_page(AFHDFTRCD_NICK.' Plugin Options', AFHDFTRCD_NICK, 'manage_options', AFHDFTRCD_ID.'_options', array('aFHFCClass', 'options_page'));
    }
    public static function options_page()
    {
      if (!current_user_can('manage_options'))
      {
        wp_die(__('You do not have sufficient permissions to access this page.'));
      }
      $plugin_id = AFHDFTRCD_ID;
      include(self::file_path('options.php'));
    }
    public static function output_footer_code()
    {
      $site_footer_code = get_option('aFhfc_site_wide_footer_code');
      $meta_footer_code = ((is_archive()) || (is_author()) || (is_category()) || (is_tag()) || (is_home()) || (is_search()) || (is_404())) ? '' : get_post_meta(get_the_ID(),'aFhfc_footer_code',true);
      $footer_replace = get_post_meta(get_the_ID(),'aFhfc_footer_replace',true);
      if(!empty($footer_replace)){
        echo $meta_footer_code."\n";
      }else{
        echo $site_footer_code."\n".$meta_footer_code."\n";
      }
    }
  }
  if (is_admin())
  {
    add_action('admin_init', array('aFHFCClass','register'));
    add_action('admin_menu', array('aFHFCClass','menu'));
  }
  add_action('wp_footer', array('aFHFCClass','output_footer_code'));
endif;

add_action('save_post','aFhfc_save');
function aFhfc_save($post_id)
{
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)return;
  if(!isset($_POST['aFhfc_mb_nonce']) || !wp_verify_nonce($_POST['aFhfc_mb_nonce'],'aFhfc_nonce'))return;
  if(!current_user_can('manage_options'))return;

  if( isset($_POST['aFhfc_footer_code']))
    if( empty($_POST['aFhfc_footer_code']))
      delete_post_meta($post_id,'aFhfc_footer_code');
    else
      update_post_meta($post_id,'aFhfc_footer_code',$_POST['aFhfc_footer_code']);
  $aFHFCFRChk = (isset($_POST['aFhfc_footer_replace']) && $_POST['aFhfc_footer_replace'])?'1':'';
  if(empty($_POST['aFhfc_footer_replace']))
    delete_post_meta($post_id,'aFhfc_footer_replace');
  else
    update_post_meta($post_id,'aFhfc_footer_replace',$aFHFCFRChk);
}
