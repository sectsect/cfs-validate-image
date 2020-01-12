<?php

class cfs_validate_image extends cfs_field {


	function __construct() {
		$this->name  = 'validate_image';
		$this->label = __( 'Validate Image Upload', 'cfs-validateimage' );
	}


	function html( $field ) {
		$file_url = $field->value;

		if ( ctype_digit( $field->value ) ) {
			if ( wp_attachment_is_image( $field->value ) ) {
				$file_url = wp_get_attachment_image_src( $field->value );
				$file_url = '<img src="' . $file_url[0] . '" />';
			} else {
				$file_url = wp_get_attachment_url( $field->value );
				$filename = substr( $file_url, strrpos( $file_url, '/' ) + 1 );
				$file_url = '<a href="' . $file_url . '" target="_blank">' . $filename . '</a>';
			}
		}

		// CSS logic for "Add" / "Remove" buttons
		$css = empty( $field->value ) ? array( '', ' hidden' ) : array( ' hidden', '' );
		?>
		<span class="file_url"><?php echo $file_url; ?></span>
		<input type="button" class="button cfsimgfld add<?php echo $css[0]; ?>" value="<?php _e( 'Add File', 'cfs' ); ?>" />
		<input type="button" class="button cfsimgfld remove<?php echo $css[1]; ?>" value="<?php _e( 'Remove', 'cfs' ); ?>" />
		<input type="hidden" name="<?php echo $field->input_name; ?>" class="file_value" value="<?php echo $field->value; ?>" />

		<?php
	}


	function options_html( $key, $field ) {
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Return Value', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'       => 'select',
							'input_name' => "cfs[fields][$key][options][return_value]",
							'options'    => array(
								'choices'      => array(
									'url' => __( 'File URL', 'cfs' ),
									'id'  => __( 'Attachment ID', 'cfs' ),
								),
								'force_single' => true,
							),
							'value'      => $this->get_option( $field, 'return_value', 'url' ),
						)
					);
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Validation', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'        => 'true_false',
							'input_name'  => "cfs[fields][$key][options][required]",
							'input_class' => 'true_false',
							'value'       => $this->get_option( $field, 'required' ),
							'options'     => array( 'message' => __( 'This is a required field', 'cfs' ) ),
						)
					);
				?>
			</td>
		</tr>

		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Max Width (px)', 'cfs-validateimage' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'       => 'text',
							'input_name' => "cfs[fields][$key][options][maxwidth]",
							'value'      => ( '' !== $this->get_option( $field, 'maxwidth' ) ) ? $this->get_option( $field, 'maxwidth' ) : '',
						)
					);
				?>
				<p style="margin-top: 5px;">Example: <code>1024</code></p>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Max Height (px)', 'cfs-validateimage' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'       => 'text',
							'input_name' => "cfs[fields][$key][options][maxheight]",
							'value'      => ( '' !== $this->get_option( $field, 'maxheight' ) ) ? $this->get_option( $field, 'maxheight' ) : '',
						)
					);
				?>
				<p style="margin-top: 5px;">Example: <code>1024</code></p>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Minimum Width (px)', 'cfs-validateimage' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'       => 'text',
							'input_name' => "cfs[fields][$key][options][minwidth]",
							'value'      => ( '' !== $this->get_option( $field, 'minwidth' ) ) ? $this->get_option( $field, 'minwidth' ) : '',
						)
					);
				?>
				<p style="margin-top: 5px;">Example: <code>320</code></p>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Minimum Height (px)', 'cfs-validateimage' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'       => 'text',
							'input_name' => "cfs[fields][$key][options][minheight]",
							'value'      => ( '' !== $this->get_option( $field, 'minheight' ) ) ? $this->get_option( $field, 'minheight' ) : '',
						)
					);
				?>
				<p style="margin-top: 5px;">Example: <code>320</code></p>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Reject mime-type', 'cfs-validateimage' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'       => 'select',
							'input_name' => "cfs[fields][$key][options][reject_extension]",
							'options'    => array(
								'multiple' => '1',
								'choices'  => array(
									'jpeg' => __( 'jpg', 'cfs-validateimage' ),
									'png'  => __( 'png', 'cfs-validateimage' ),
									'gif'  => __( 'gif', 'cfs-validateimage' ),
								),
							),
							'value'      => $this->get_option( $field, 'reject_extension' ),
						)
					);
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Alert Text (Image Dimention > Max Dimention)', 'cfs-validateimage' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'       => 'text',
							'input_name' => "cfs[fields][$key][options][maxtext]",
							'value'      => ( '' !== $this->get_option( $field, 'maxtext' ) ) ? $this->get_option( $field, 'maxtext' ) : 'The image Dimention has exceeded!',
						)
					);
				?>
				<p style="margin-top: 5px;">Dafault: <code>The image Dimention has exceeded!</code></p>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Alert Text (Image Dimention < Min Dimention)', 'cfs-validateimage' ); ?></label>
			</td>
			<td>
				<?php
					CFS()->create_field(
						array(
							'type'       => 'text',
							'input_name' => "cfs[fields][$key][options][mintext]",
							'value'      => ( '' !== $this->get_option( $field, 'mintext' ) ) ? $this->get_option( $field, 'mintext' ) : 'The image Dimention is not enough!',
						)
					);
				?>
				<p style="margin-top: 5px;">Dafault: <code>The image Dimention is not enough!</code></p>
			</td>
		</tr>
		<?php
	}


	function input_head( $field = null ) {
		global $post;
		wp_enqueue_media();

		$max_w      = intval( $this->get_option( $field, 'maxwidth' ) );
		$max_h      = intval( $this->get_option( $field, 'maxheight' ) );
		$min_w      = intval( $this->get_option( $field, 'minwidth' ) );
		$min_h      = intval( $this->get_option( $field, 'minheight' ) );
		$maxtext    = $this->get_option( $field, 'maxtext' );
		$mintext    = $this->get_option( $field, 'mintext' );
		$rejectmime = $this->get_option( $field, 'reject_extension' );
		if ( $rejectmime ) {
			$var = '["' . implode( '","', $rejectmime ) . '"]';
		}
		?>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
		<style>
		/* For sweetalert.min.js */
		.sweet-overlay{
			z-index: 170000;
		}
		.sweet-alert{
			z-index: 99999999;
		}


		.cfs_media_frame .media-frame-menu {
			display: none;
		}

		.cfs_media_frame .media-frame-title,
		.cfs_media_frame .media-frame-router,
		.cfs_media_frame .media-frame-content,
		.cfs_media_frame .media-frame-toolbar {
			left: 0;
		}
		</style>

		<script>
		(function($) {
			$(function() {

				var cfs_media_frame;

				$(document).on('click', '.add.cfsimgfld', function(e) {
					$this = $(this);

					if (cfs_media_frame) {
						cfs_media_frame.open();
						return;
					}

					cfs_media_frame = wp.media.frames.cfs_media_frame = wp.media({
						className: 'media-frame cfs_media_frame',
						frame: 'post',
						multiple: false
					});

					cfs_media_frame.on('insert', function() {

						var attachment = cfs_media_frame.state().get('selection').first().toJSON();
						if ('image' == attachment.type && 'undefined' != typeof attachment.sizes) {
							file_url = attachment.sizes.full.url;
							if ('undefined' != typeof attachment.sizes.thumbnail) {
								file_url = attachment.sizes.thumbnail.url;
							}

							/*==================================================
								Add code
							================================================== */
							var width = attachment.sizes.full.width;
							var height = attachment.sizes.full.height;
							var maxtext = "<?php echo $maxtext; ?>";
							var mintext = "<?php echo $mintext; ?>";

							<?php if ( $min_w && $min_h ) : ?>
							if(width < <?php echo $min_w; ?> || height < <?php echo $min_h; ?>){
								swal("Oops...", mintext, "error");
								return false;
							}
							<?php elseif ( $min_w && ! $min_h ) : ?>
							if(width < <?php echo $min_w; ?>){
								swal("Oops...", mintext, "error");
								return false;
							}
							<?php elseif ( ! $min_w && $min_h ) : ?>
							if(height < <?php echo $min_h; ?>){
								swal("Oops...", mintext, "error");
								return false;
							}
							<?php endif; ?>


							<?php if ( $max_w && $max_h ) : ?>
							if(width > <?php echo $max_w; ?> || height > <?php echo $max_h; ?>){
								swal("Oops...", maxtext, "error");

								return false;
							}
							<?php elseif ( $max_w && ! $max_h ) : ?>
							if(width > <?php echo $max_w; ?>){
								swal("Oops...", maxtext, "error");
								return false;
							}
							<?php elseif ( ! $max_w && $max_h ) : ?>
							if(height > <?php echo $max_h; ?>){
								swal("Oops...", maxtext, "error");
								return false;
							}
							<?php endif; ?>

							<?php if ( $rejectmime ) : ?>
							var mime = attachment.mime.replace('image/', '');
							var extension = <?php echo $var; ?>;
							if ($.inArray(mime, extension) != -1) {
								swal("Oops...", "The extension (" + mime + ") is not allowed!", "error");
								return false;
							}
							<?php endif; ?>
							/*==================================================
								Add code
							================================================== */

							file_url = '<img src="' + file_url + '" />';
						}
						else {
							file_url = '<a href="' + attachment.url + '" target="_blank">' + attachment.filename + '</a>';
						}
						$this.hide();
						$this.siblings('.remove.cfsimgfld').show();
						$this.siblings('.file_value').val(attachment.id);
						$this.siblings('.file_url').html(file_url);
					});

					cfs_media_frame.open();
					cfs_media_frame.content.mode('upload');
				});

				$(document).on('click', '.remove.cfsimgfld', function() {
					$(this).siblings('.file_url').html('');
					$(this).siblings('.file_value').val('');
					$(this).siblings('.add.cfsimgfld').show();
					$(this).hide();
				});
			});
		})(jQuery);
		</script>

		<?php
	}


	function format_value_for_api( $value, $field = null ) {
		if ( ctype_digit( $value ) ) {
			$return_value = $this->get_option( $field, 'return_value', 'url' );
			return ( 'id' === $return_value ) ? (int) $value : wp_get_attachment_url( $value );
		}
		return $value;
	}
}
