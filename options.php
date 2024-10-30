<div class="wrap">
  <!--h2>Hybrid.Chat</h2-->
  <div id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">
      <div id="post-body-content">
  <form action="options.php" method="post" id="<?php echo $plugin_id; ?>_options_form" name="<?php echo $plugin_id; ?>_options_form">
  <?php settings_fields($plugin_id.'_options'); ?>

    <h1>Hybrid.Chat Settings</h1>
<p>Hybrid.Chat is a Site Chat + Chatbot platform that lets you talk to your website visitors in <a href="https://hybrid.chat/live-chat-for-slack/">Slack</a> or <a href="https://hybrid.chat/live-chat-for-mattermost/">Mattermost</a>.</p>
<p><a href="https://app.hybrid.chat/register">Signup here</a> to get your embed code. Or just <a href="https://app.hybrid.chat/login">Login</a></p>

      <label for="aFhfc_site_wide_footer_code">
        <h3 class="title">Paste your Site chat bot embed code below</h3>
        <p><textarea name="aFhfc_site_wide_footer_code" rows="10" cols="50" id="aFhfc_site_wide_footer_code" class="large-text code"><?php echo get_option('aFhfc_site_wide_footer_code'); ?></textarea></p>
      </label>
    </div>
<?php submit_button(); ?>
  </form>
      </div> <!-- post-body-content -->
      <!-- sidebar -->
      <div id="postbox-container-1" class="postbox-container">
      </div> <!-- #postbox-container-1 .postbox-container -->
    </div> <!-- #post-body .metabox-holder .columns-2 -->
    <br class="clear">
  </div> <!-- #poststuff -->
</div>
