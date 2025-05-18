<?php
/**
 * Handle guest checkout functionalities
 *
 * @package TutorPro\GuestCheckout
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 3.3.0
 */

namespace TutorPro\Ecommerce\GuestCheckout;

use Tutor\Models\OrderModel;
use TutorPro\Ecommerce\Settings;

/**
 * Handle guest checkout logics
 *
 * @since 3.3.0
 */
class GuestCheckout {

	/**
	 * Register hooks
	 *
	 * @since 3.3.0
	 */
	public function __construct() {
		if ( ! self::is_enable() ) {
			return;
		}

		if ( ! is_user_logged_in() ) {
			new GuestCart();
			new HooksHandler();
		}

		// This hooks will be triggered after user login.
		// That's way we need register these hooks.
		add_filter( 'tutor_order_placement_success', array( $this, 'clear_cookies' ) );
		add_filter( 'tutor_order_placement_success_message', array( $this, 'update_message' ), 10, 2 );
	}

	/**
	 * Check if guest checkout is enabled
	 *
	 * @since 3.3.0
	 *
	 * @return bool
	 */
	public static function is_enable() {
		return tutor_utils()->get_option( Settings::ENABLE_GUEST_CHECKOUT_OPT, false );
	}

	/**
	 * Clear guest checkout cookies after successful order
	 *
	 * @since 3.3.0
	 *
	 * @return void
	 */
	public function clear_cookies() {
		CookieManager::clear_all();
	}

	/**
	 * Update success message for guest checkout orders
	 *
	 * @since 3.3.0
	 *
	 * @param string $message Default success message.
	 * @param int    $order_id Order ID.
	 *
	 * @return string Modified success message
	 */
	public function update_message( string $message, int $order_id ): string {
		$order_data = ( new OrderModel() )->get_order_by_id( $order_id );
		if ( $order_data && ! empty( $order_data->payment_payloads ) ) {
			$payloads = json_decode( $order_data->payment_payloads );
			if ( $payloads && $payloads->is_guest_checkout ) {
				$message = __( 'Thank you for your order. A password reset email has been sent to your billing email. Please reset your password to access your account.', 'tutor-pro' );
			}
		}

		return $message;
	}

}
