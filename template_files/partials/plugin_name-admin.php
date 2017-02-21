<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
<form method="post" name="ari_options" action="options.php">
    <?php
        $options = get_option($this->plugin_name);
        $ari_action = $options['ari_action'];
        $brett_filter = $options['brett_filter'];
    ?>

    <?php 
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>

    <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-ari_action" 
        name="<?php echo $this->plugin_name; ?>[ari_action]" 
        value="1"
        <?php checked($ari_action, 1); ?>
    />
    <span><?php esc_attr_e('Allow Ari to walk on headers', $this->plugin_name); ?></span>
    <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-brett_filter" 
        name="<?php echo $this->plugin_name; ?>[brett_filter]" 
        value="1"
        <?php checked($brett_filter, 1); ?>
    />
    <span><?php esc_attr_e('Allow Brett to override the header', $this->plugin_name); ?></span>
    <?php submit_button(__('Save all changes'), 'primary','submit', TRUE); ?>
</form>
