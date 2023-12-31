<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Ability to interact with post data.
 *
 * @since 4.4
 */
class Vc_Post_Admin {
	/**
	 * Add hooks required to save, update and manipulate post
	 */
	public function init() {
		// Called in BE
		add_action( 'save_post', array(
			$this,
			'save',
		) );

		// Called in FE
		add_action( 'wp_ajax_vc_save', array(
			$this,
			'saveAjaxFe',
		) );
		add_filter( 'content_save_pre', 'wpb_remove_custom_html' );
	}

	/**
	 * @throws \Exception
	 */
	public function saveAjaxFe() {
		$post_id = intval( vc_post_param( 'post_id' ) );
		vc_user_access()->checkAdminNonce()->validateDie()->wpAny( 'edit_posts', 'edit_pages' )->validateDie()->canEdit( $post_id )->validateDie();

		if ( $post_id > 0 ) {
			ob_start();

			// Update post_content, title and etc.
			// post_title
			// content
			// post_status
			if ( vc_post_param( 'content' ) ) {
				$post = get_post( $post_id );
				$post->post_content = stripslashes( vc_post_param( 'content' ) );
				$post_status = vc_post_param( 'post_status' );
				$post_title = vc_post_param( 'post_title' );
				if ( null !== $post_title ) {
					$post->post_title = $post_title;
				}
				if ( vc_user_access()->part( 'unfiltered_html' )->checkStateAny( true, null )->get() ) {
					kses_remove_filters();
				}
				remove_filter( 'content_save_pre', 'balanceTags', 50 );
				if ( $post_status && 'publish' === $post_status ) {
					if ( vc_user_access()->wpAll( array(
						get_post_type_object( $post->post_type )->cap->publish_posts,
						$post_id,
					) )->get() ) {
						if ( 'private' !== $post->post_status && 'future' !== $post->post_status ) {
							$post->post_status = 'publish';
						}
					} else {
						$post->post_status = 'pending';
					}
				}

				wp_update_post( $post );
				$this->setPostMeta( $post_id );
			}

			wpbakery()->buildShortcodesCustomCss( $post_id );
			wp_cache_flush();
			ob_clean();

			wp_send_json_success();
		}

		wp_send_json_error();
	}/** @noinspection PhpDocMissingThrowsInspection */

	/**
	 * Save generated shortcodes, html and WPBakery Page Builder status in posts meta.
	 *
	 * @access public
	 * @param $post_id - current post id
	 *
	 * @return void
	 * @since 4.4
	 *
	 */
	public function save( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || vc_is_inline() ) {
			return;
		}
		$this->setPostMeta( $post_id );
	}

	/**
	 * Saves VC Backend editor meta box visibility status.
	 *
	 * If post param 'wpb_vc_js_status' set to true, then methods adds/updated post
	 * meta option with tag '_wpb_vc_js_status'.
	 * @param $post_id
	 * @since 4.4
	 *
	 */
	public function setJsStatus( $post_id ) {
		$value = vc_post_param( 'wpb_vc_js_status' );
		if ( null !== $value ) {
			if ( '' === get_post_meta( $post_id, '_wpb_vc_js_status' ) ) {
				add_post_meta( $post_id, '_wpb_vc_js_status', $value, true );
			} elseif ( get_post_meta( $post_id, '_wpb_vc_js_status', true ) !== $value ) {
				update_post_meta( $post_id, '_wpb_vc_js_status', $value );
			} elseif ( '' === $value ) {
				delete_post_meta( $post_id, '_wpb_vc_js_status', get_post_meta( $post_id, '_wpb_vc_js_status', true ) );
			}
		}
	}

	/**
	 * Saves VC interface version which is used for building post content.
	 * @param $post_id
	 * @since 4.4
	 * @todo check is it used everywhere and is it needed?!
	 * @deprecated not needed anywhere
	 */
	public function setInterfaceVersion( $post_id ) {
		_deprecated_function( '\Vc_Post_Admin::setInterfaceVersion', '4.4', '' );
	}

	/**
	 * Set Post Settings for VC.
	 *
	 * It is possible to add any data to post settings by adding filter with tag 'vc_hooks_vc_post_settings'.
	 * @param $post_id
	 * @since 4.4
	 * vc_filter: vc_hooks_vc_post_settings - hook to override
	 * post meta settings for WPBakery Page Builder (used in grid for example)
	 */
	public function setSettings( $post_id ) {
		$settings = array();
		$settings = apply_filters( 'vc_hooks_vc_post_settings', $settings, $post_id, get_post( $post_id ) );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			update_post_meta( $post_id, '_vc_post_settings', $settings );
		} else {
			delete_post_meta( $post_id, '_vc_post_settings' );
		}
	}

	/**
	 * Set plugin meta to specific post.
	 *
	 * @param int $id
	 * @throws \Exception
	 */
	protected function setPostMeta( $id ) {
		if ( ! vc_user_access()->wpAny( array(
			'edit_post',
			$id,
		) )->get() ) {
			return;
		}

		$this->setJsStatus( $id );
		if ( 'dopreview' === vc_post_param( 'wp-preview' ) && wp_revisions_enabled( get_post( $id ) ) ) {
			$latest_revision = wp_get_post_revisions( $id );
			if ( ! empty( $latest_revision ) ) {
				$array_values = array_values( $latest_revision );
				$id = $array_values[0]->ID;
			}
		}

		if ( 'dopreview' !== vc_post_param( 'wp-preview' ) ) {
			$this->setSettings( $id );
		}

		$meta_list = $this->get_post_meta_list();

		$this->setPostMetaByList( $id, $meta_list );

		wpbakery()->buildShortcodesCustomCss( $id );
	}

	/**
	 * Get post meta list.
	 * @since 7.0
	 *
	 * @return array
	 */
	public function get_post_meta_list() {
		return apply_filters( 'vc_post_meta_list',
			array(
				//@since 4.4
				'custom_css',
				//@since 7.0
				'custom_js_header',
				'custom_js_footer',
				'custom_layout',
			)
		);
	}

	/**
	 * Set post meta by meta list.
	 * @note we keep this data for meta in regular $_POST
	 * @see include/templates/editors/backend_editor.tpl.php
	 * @see include/templates/editors/frontend_editor.tpl.php
	 * @note we also additionally save data for frontend editor in ajax request to push it in $_POST
	 * @see assets/js/frontend_editor/shortcodes_builder.js ShortcodesBuilder::save()
	 * @since 7.0
	 *
	 * @param int $id
	 * @param array $meta_list
	 */
	public function setPostMetaByList( $id, $meta_list ) {
		foreach ( $meta_list as $meta_name ) {
			$post_param = vc_post_param( 'vc_post_' . $meta_name );
			$value = apply_filters( 'vc_base_save_post_' . $meta_name, $post_param, $id );
			if ( null !== $value && empty( $value ) ) {
				delete_metadata( 'post', $id, '_wpb_post_' . $meta_name );
			} elseif ( null !== $value ) {
				$value = wp_strip_all_tags( $value );
				update_metadata( 'post', $id, '_wpb_post_' . $meta_name, $value );
			}
		}
	}
}
