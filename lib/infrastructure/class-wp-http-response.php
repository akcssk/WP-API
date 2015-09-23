<?php
/**
 * REST API: WP_HTTP_Response class
 *
 * @package WordPress
 * @subpackage REST_API
 * @since 4.4.0
 */

/**
 * Core class used to process HTTP responses.
 *
 * @since 4.4.0
 *
 * @see WP_HTTP_ResponseInterface
 */
class WP_HTTP_Response implements WP_HTTP_ResponseInterface {

	/**
	 * Response data.
	 *
	 * @since 4.4.0
	 * @access public
	 * @var mixed
	 */
	public $data;

	/**
	 * Response headers.
	 *
	 * @since 4.4.0
	 * @access public
	 * @var int
	 */
	public $headers;

	/**
	 * Response status.
	 *
	 * @since 4.4.0
	 * @access public
	 * @var array
	 */
	public $status;

	/**
	 * Constructor.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @param mixed $data    Response data. Default null
	 * @param int   $status  Optional. HTTP status code. Default 200.
	 * @param array $headers Optional. HTTP header map. Default empty array.
	 */
	public function __construct( $data = null, $status = 200, $headers = array() ) {
		$this->data = $data;
		$this->set_status( $status );
		$this->set_headers( $headers );
	}

	/**
	 * Retrieves headers associated with the response.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @see WP_HTTP_ResponseInterface::get_headers()
	 *
	 * @return array Map of header name to header value.
	 */
	public function get_headers() {
		return $this->headers;
	}

	/**
	 * Sets all header values.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @param array $headers Map of header name to header value.
	 */
	public function set_headers( $headers ) {
		$this->headers = $headers;
	}

	/**
	 * Sets a single HTTP header.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @param string $key     Header name.
	 * @param string $value   Header value.
	 * @param bool   $replace Optional. Whether to replace an existing header of the same name.
	 *                        Default true.
	 */
	public function header( $key, $value, $replace = true ) {
		if ( $replace || ! isset( $this->headers[ $key ] ) ) {
			$this->headers[ $key ] = $value;
		} else {
			$this->headers[ $key ] .= ', ' . $value;
		}
	}

	/**
	 * Retrieves the HTTP return code for the response.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @see WP_HTTP_ResponseInterface::get_status()
	 *
	 * @return int The 3-digit HTTP status code.
	 */
	public function get_status() {
		return $this->status;
	}

	/**
	 * Sets the 3-digit HTTP status code.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @param int $code HTTP status.
	 */
	public function set_status( $code ) {
		$this->status = absint( $code );
	}

	/**
	 * Retrieves the response data.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @see WP_HTTP_ResponseInterface::get_status()
	 *
	 * @return mixed Response data.
	 */
	public function get_data() {
		return $this->data;
	}

	/**
	 * Sets the response data.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @param mixed $data Response data.
	 */
	public function set_data( $data ) {
		$this->data = $data;
	}

	/**
	 * Retrieves the response data for JSON serialization.
	 *
	 * It is expected that in most implementations, this will return the same as get_data(),
	 * however this may be different if you want to do custom JSON data handling.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @return mixed Any JSON-serializable value.
	 */
	// @codingStandardsIgnoreStart
	public function jsonSerialize() {
	// @codingStandardsIgnoreEnd
		return $this->get_data();
	}
}
