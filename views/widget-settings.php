<div class="metatrader-widget-settings">
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
		<?php echo esc_html__( 'Title', 'metatrader' ); ?>:
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'version' ) ); ?>">
<?php echo esc_html__( 'Version', 'metatrader' ); ?>:
</label>
<br />
<select id="<?php echo esc_attr( $this->get_field_id( 'version' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'version' ) ); ?>">
<?php
foreach ( $versions as $value => $label ) {
	$selected = $version === (string) $value ? 'selected' : '';
	echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $label ) . '</option>';
}
?>
</select>
</p>
<h4><?php echo esc_html__( 'Connection', 'metatrader' ); ?></h4>
<p>
<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'restrict_servers' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'restrict_servers' ) ); ?>" data-toggle="<?php echo esc_attr( $this->get_field_id( 'servers-wrap' ) ); ?>" value="1" <?php echo $restrict_servers === '1' ? 'checked' : ''; ?> />
<label for="<?php echo esc_attr( $this->get_field_id( 'restrict_servers' ) ); ?>">
<?php echo esc_html__( 'Restrict trade servers', 'metatrader' ); ?>
</label>
</p>
<p id="<?php echo esc_attr( $this->get_field_id( 'servers-wrap' ) ); ?>">
<label for="<?php echo esc_attr( $this->get_field_id( 'servers' ) ); ?>">
<?php echo esc_html__( 'Trade server list (comma separated)', 'metatrader' ); ?>:
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'servers' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'servers' ) ); ?>" type="text" value="<?php echo esc_attr( $servers ); ?>">
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'login' ) ); ?>">
<?php echo esc_html__( 'Default login', 'metatrader' ); ?>:
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'login' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'login' ) ); ?>" type="text" value="<?php echo esc_attr( $login ); ?>">
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'server' ) ); ?>">
<?php echo esc_html__( 'Default trade server', 'metatrader' ); ?>:
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'server' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'server' ) ); ?>" type="text" value="<?php echo esc_attr( $server ); ?>">
</p>
<h4><?php echo esc_html__( 'Opening demo accounts', 'metatrader' ); ?></h4>
<p>
<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'demo_all_servers' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'demo_all_servers' ) ); ?>" value="1" <?php echo $demo_all_servers === '1' ? 'checked' : ''; ?> />
<label for="<?php echo esc_attr( $this->get_field_id( 'demo_all_servers' ) ); ?>">
<?php echo esc_html__( 'Allow opening demo accounts on any servers', 'metatrader' ); ?>
</label>
</p>
<p>
<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'demo_show_phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'demo_show_phone' ) ); ?>" value="1" <?php echo $demo_show_phone === '1' ? 'checked' : ''; ?> />
<label for="<?php echo esc_attr( $this->get_field_id( 'demo_show_phone' ) ); ?>">
<?php echo esc_html__( 'Allow the field Phone in the dialog of opening a demo account', 'metatrader' ); ?>
</label>
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'utm_campaign' ) ); ?>">
<?php echo esc_html__( 'UTM campaign', 'metatrader' ); ?>:
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'utm_campaign' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'utm_campaign' ) ); ?>" type="text" value="<?php echo esc_attr( $utm_campaign ); ?>">
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'utm_source' ) ); ?>">
<?php echo esc_html__( 'UTM source', 'metatrader' ); ?>:
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'utm_source' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'utm_source' ) ); ?>" type="text" value="<?php echo esc_attr( $utm_source ); ?>">
</p>
<h4><?php echo esc_html__( 'Interface', 'metatrader' ); ?></h4>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>">
		<?php echo esc_html__( 'Width', 'metatrader' ); ?>:
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>">
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
		<?php echo esc_html__( 'Height', 'metatrader' ); ?>:
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>">
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'startup_mode' ) ); ?>">
<?php echo esc_html__( 'What to do at the start for new visitors?', 'metatrader' ); ?>:
</label>
<br />
<select id="<?php echo esc_attr( $this->get_field_id( 'startup_mode' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'startup_mode' ) ); ?>">
<?php
foreach ( $startup_modes as $value => $label ) {
	$selected = $startup_mode === $value ? 'selected' : '';
	echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $label ) . '</option>';
}
?>
</select>
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'lang' ) ); ?>">
<?php echo esc_html__( 'Language', 'metatrader' ); ?>:
</label>
<br />
<select id="<?php echo esc_attr( $this->get_field_id( 'lang' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lang' ) ); ?>">
<?php
foreach ( $langs as $value => $label ) {
	$selected = $lang === $value ? 'selected' : '';
	echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $label ) . '</option>';
}
?>
</select>
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'color_scheme' ) ); ?>">
<?php echo esc_html__( 'Chart color scheme', 'metatrader' ); ?>:
</label>
<br />
<select id="<?php echo esc_attr( $this->get_field_id( 'color_scheme' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'color_scheme' ) ); ?>">
<?php
foreach ( $color_schemes as $value => $label ) {
	$selected = $color_scheme === $value ? 'selected' : '';
	echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $label ) . '</option>';
}
?>
</select>
</p>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.metatrader-widget-settings [data-toggle]').change(function() {
			var $target = $('#' + $(this).data('toggle'));
			var $inputs = $('input', $target);
			var $labels = $('label', $target);

			if (jQuery(this).is(":checked")) {
				$inputs.removeAttr('disabled');
				$labels.removeClass('mt-toggle-disabled');
			} else {
				$inputs.attr('disabled', 'disabled');
				$labels.addClass('mt-toggle-disabled');
			}
		});

		jQuery('.metatrader-widget-settings [data-toggle]').trigger('change');
	});
</script>
