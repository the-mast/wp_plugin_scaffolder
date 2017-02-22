<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
<form method="post" name="{plugin_name}_options" action="options.php">
    <?php
        $options = get_option($this->plugin_name);
        ${plugin_name}_action = $options['{plugin_name}_action'];
        ${plugin_name}_filter = $options['{plugin_name}_filter'];
    ?>

    <?php 
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>

    <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-{plugin_name}_action" 
        name="<?php echo $this->plugin_name; ?>[{plugin_name}_action]" 
        value="1"
        <?php checked(${plugin_name}_action, 1); ?>
    />
    <span><?php esc_attr_e('Allow {plugin_name} to walk on headers', $this->plugin_name); ?></span>
    <input type="checkbox" 
        id="<?php echo $this->plugin_name; ?>-{plugin_name}_filter" 
        name="<?php echo $this->plugin_name; ?>[{plugin_name}_filter]" 
        value="1"
        <?php checked(${plugin_name}_filter, 1); ?>
    />
    <span><?php esc_attr_e('Allow {plugin_name} to override the header', $this->plugin_name); ?></span>
    <?php submit_button(__('Save all changes'), 'primary','submit', TRUE); ?>
</form>
