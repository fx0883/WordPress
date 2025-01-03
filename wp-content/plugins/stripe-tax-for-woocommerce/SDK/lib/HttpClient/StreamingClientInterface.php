<?php

namespace Stripe\StripeTaxForWooCommerce\SDK\lib\HttpClient;

interface StreamingClientInterface {

	/**
	 * @param 'delete'|'get'|'post' $method The HTTP method being used
	 * @param string                $absUrl The URL being requested, including domain and protocol
	 * @param array                 $headers Headers to be used in the request (full strings, not KV pairs)
	 * @param array                 $params KV pairs for parameters. Can be nested for arrays and hashes
	 * @param bool                  $hasFile Whether or not $params references a file (via an @ prefix or
	 *                                          CURLFile)
	 * @param callable              $readBodyChunkCallable a function that will be called with chunks of bytes from the body if the request is successful
	 *
	 * @return array an array whose first element is raw request body, second
	 *    element is HTTP status code and third array of HTTP headers
	 * @throws \Stripe\StripeTaxForWooCommerce\SDK\lib\Exception\UnexpectedValueException
	 *
	 * @throws \Stripe\StripeTaxForWooCommerce\SDK\lib\Exception\ApiConnectionException
	 */
	public function requestStream( $method, $absUrl, $headers, $params, $hasFile, $readBodyChunkCallable );
}
