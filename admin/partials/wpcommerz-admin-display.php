<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wpcommerz.com/
 * @since      1.0.0
 *
 * @package    Wpcommerz
 * @subpackage Wpcommerz/admin/partials
 */



global $wpdb;

$employees = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}task");

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<div class="wrap">
    <div class="task-block">
        <form method="post" class="input-form">
            <h3>List of Emplyees</h3>
            <?php foreach ($employees as $employee) { ?>

                <input type="text" name="name" value="<?php echo $employee->name; ?>">

           <?php  } ?>
            

            <input class="task-add-more" type="submit" name="add" value="Add More">
        </form>
        <input class="task-save" type="submit" name="submit" value="Save Settings">
    </div>
</div>
