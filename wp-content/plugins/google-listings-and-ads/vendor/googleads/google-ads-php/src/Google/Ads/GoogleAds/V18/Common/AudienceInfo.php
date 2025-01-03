<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v18/common/criteria.proto

namespace Google\Ads\GoogleAds\V18\Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * An audience criterion.
 *
 * Generated from protobuf message <code>google.ads.googleads.v18.common.AudienceInfo</code>
 */
class AudienceInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * The Audience resource name.
     *
     * Generated from protobuf field <code>string audience = 1;</code>
     */
    protected $audience = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $audience
     *           The Audience resource name.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Ads\GoogleAds\V18\Common\Criteria::initOnce();
        parent::__construct($data);
    }

    /**
     * The Audience resource name.
     *
     * Generated from protobuf field <code>string audience = 1;</code>
     * @return string
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * The Audience resource name.
     *
     * Generated from protobuf field <code>string audience = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setAudience($var)
    {
        GPBUtil::checkString($var, True);
        $this->audience = $var;

        return $this;
    }

}

