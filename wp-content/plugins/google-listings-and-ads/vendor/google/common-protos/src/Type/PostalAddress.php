<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/type/postal_address.proto

namespace Google\Type;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Represents a postal address, e.g. for postal delivery or payments addresses.
 * Given a postal address, a postal service can deliver items to a premise, P.O.
 * Box or similar.
 * It is not intended to model geographical locations (roads, towns,
 * mountains).
 * In typical usage an address would be created via user input or from importing
 * existing data, depending on the type of process.
 * Advice on address input / editing:
 *  - Use an i18n-ready address widget such as
 *    https://github.com/google/libaddressinput)
 * - Users should not be presented with UI elements for input or editing of
 *   fields outside countries where that field is used.
 * For more guidance on how to use this schema, please see:
 * https://support.google.com/business/answer/6397478
 *
 * Generated from protobuf message <code>google.type.PostalAddress</code>
 */
class PostalAddress extends \Google\Protobuf\Internal\Message
{
    /**
     * The schema revision of the `PostalAddress`. This must be set to 0, which is
     * the latest revision.
     * All new revisions **must** be backward compatible with old revisions.
     *
     * Generated from protobuf field <code>int32 revision = 1;</code>
     */
    protected $revision = 0;
    /**
     * Required. CLDR region code of the country/region of the address. This
     * is never inferred and it is up to the user to ensure the value is
     * correct. See http://cldr.unicode.org/ and
     * http://www.unicode.org/cldr/charts/30/supplemental/territory_information.html
     * for details. Example: "CH" for Switzerland.
     *
     * Generated from protobuf field <code>string region_code = 2;</code>
     */
    protected $region_code = '';
    /**
     * Optional. BCP-47 language code of the contents of this address (if
     * known). This is often the UI language of the input form or is expected
     * to match one of the languages used in the address' country/region, or their
     * transliterated equivalents.
     * This can affect formatting in certain countries, but is not critical
     * to the correctness of the data and will never affect any validation or
     * other non-formatting related operations.
     * If this value is not known, it should be omitted (rather than specifying a
     * possibly incorrect default).
     * Examples: "zh-Hant", "ja", "ja-Latn", "en".
     *
     * Generated from protobuf field <code>string language_code = 3;</code>
     */
    protected $language_code = '';
    /**
     * Optional. Postal code of the address. Not all countries use or require
     * postal codes to be present, but where they are used, they may trigger
     * additional validation with other parts of the address (e.g. state/zip
     * validation in the U.S.A.).
     *
     * Generated from protobuf field <code>string postal_code = 4;</code>
     */
    protected $postal_code = '';
    /**
     * Optional. Additional, country-specific, sorting code. This is not used
     * in most regions. Where it is used, the value is either a string like
     * "CEDEX", optionally followed by a number (e.g. "CEDEX 7"), or just a number
     * alone, representing the "sector code" (Jamaica), "delivery area indicator"
     * (Malawi) or "post office indicator" (e.g. Côte d'Ivoire).
     *
     * Generated from protobuf field <code>string sorting_code = 5;</code>
     */
    protected $sorting_code = '';
    /**
     * Optional. Highest administrative subdivision which is used for postal
     * addresses of a country or region.
     * For example, this can be a state, a province, an oblast, or a prefecture.
     * Specifically, for Spain this is the province and not the autonomous
     * community (e.g. "Barcelona" and not "Catalonia").
     * Many countries don't use an administrative area in postal addresses. E.g.
     * in Switzerland this should be left unpopulated.
     *
     * Generated from protobuf field <code>string administrative_area = 6;</code>
     */
    protected $administrative_area = '';
    /**
     * Optional. Generally refers to the city/town portion of the address.
     * Examples: US city, IT comune, UK post town.
     * In regions of the world where localities are not well defined or do not fit
     * into this structure well, leave locality empty and use address_lines.
     *
     * Generated from protobuf field <code>string locality = 7;</code>
     */
    protected $locality = '';
    /**
     * Optional. Sublocality of the address.
     * For example, this can be neighborhoods, boroughs, districts.
     *
     * Generated from protobuf field <code>string sublocality = 8;</code>
     */
    protected $sublocality = '';
    /**
     * Unstructured address lines describing the lower levels of an address.
     * Because values in address_lines do not have type information and may
     * sometimes contain multiple values in a single field (e.g.
     * "Austin, TX"), it is important that the line order is clear. The order of
     * address lines should be "envelope order" for the country/region of the
     * address. In places where this can vary (e.g. Japan), address_language is
     * used to make it explicit (e.g. "ja" for large-to-small ordering and
     * "ja-Latn" or "en" for small-to-large). This way, the most specific line of
     * an address can be selected based on the language.
     * The minimum permitted structural representation of an address consists
     * of a region_code with all remaining information placed in the
     * address_lines. It would be possible to format such an address very
     * approximately without geocoding, but no semantic reasoning could be
     * made about any of the address components until it was at least
     * partially resolved.
     * Creating an address only containing a region_code and address_lines, and
     * then geocoding is the recommended way to handle completely unstructured
     * addresses (as opposed to guessing which parts of the address should be
     * localities or administrative areas).
     *
     * Generated from protobuf field <code>repeated string address_lines = 9;</code>
     */
    private $address_lines;
    /**
     * Optional. The recipient at the address.
     * This field may, under certain circumstances, contain multiline information.
     * For example, it might contain "care of" information.
     *
     * Generated from protobuf field <code>repeated string recipients = 10;</code>
     */
    private $recipients;
    /**
     * Optional. The name of the organization at the address.
     *
     * Generated from protobuf field <code>string organization = 11;</code>
     */
    protected $organization = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $revision
     *           The schema revision of the `PostalAddress`. This must be set to 0, which is
     *           the latest revision.
     *           All new revisions **must** be backward compatible with old revisions.
     *     @type string $region_code
     *           Required. CLDR region code of the country/region of the address. This
     *           is never inferred and it is up to the user to ensure the value is
     *           correct. See http://cldr.unicode.org/ and
     *           http://www.unicode.org/cldr/charts/30/supplemental/territory_information.html
     *           for details. Example: "CH" for Switzerland.
     *     @type string $language_code
     *           Optional. BCP-47 language code of the contents of this address (if
     *           known). This is often the UI language of the input form or is expected
     *           to match one of the languages used in the address' country/region, or their
     *           transliterated equivalents.
     *           This can affect formatting in certain countries, but is not critical
     *           to the correctness of the data and will never affect any validation or
     *           other non-formatting related operations.
     *           If this value is not known, it should be omitted (rather than specifying a
     *           possibly incorrect default).
     *           Examples: "zh-Hant", "ja", "ja-Latn", "en".
     *     @type string $postal_code
     *           Optional. Postal code of the address. Not all countries use or require
     *           postal codes to be present, but where they are used, they may trigger
     *           additional validation with other parts of the address (e.g. state/zip
     *           validation in the U.S.A.).
     *     @type string $sorting_code
     *           Optional. Additional, country-specific, sorting code. This is not used
     *           in most regions. Where it is used, the value is either a string like
     *           "CEDEX", optionally followed by a number (e.g. "CEDEX 7"), or just a number
     *           alone, representing the "sector code" (Jamaica), "delivery area indicator"
     *           (Malawi) or "post office indicator" (e.g. Côte d'Ivoire).
     *     @type string $administrative_area
     *           Optional. Highest administrative subdivision which is used for postal
     *           addresses of a country or region.
     *           For example, this can be a state, a province, an oblast, or a prefecture.
     *           Specifically, for Spain this is the province and not the autonomous
     *           community (e.g. "Barcelona" and not "Catalonia").
     *           Many countries don't use an administrative area in postal addresses. E.g.
     *           in Switzerland this should be left unpopulated.
     *     @type string $locality
     *           Optional. Generally refers to the city/town portion of the address.
     *           Examples: US city, IT comune, UK post town.
     *           In regions of the world where localities are not well defined or do not fit
     *           into this structure well, leave locality empty and use address_lines.
     *     @type string $sublocality
     *           Optional. Sublocality of the address.
     *           For example, this can be neighborhoods, boroughs, districts.
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $address_lines
     *           Unstructured address lines describing the lower levels of an address.
     *           Because values in address_lines do not have type information and may
     *           sometimes contain multiple values in a single field (e.g.
     *           "Austin, TX"), it is important that the line order is clear. The order of
     *           address lines should be "envelope order" for the country/region of the
     *           address. In places where this can vary (e.g. Japan), address_language is
     *           used to make it explicit (e.g. "ja" for large-to-small ordering and
     *           "ja-Latn" or "en" for small-to-large). This way, the most specific line of
     *           an address can be selected based on the language.
     *           The minimum permitted structural representation of an address consists
     *           of a region_code with all remaining information placed in the
     *           address_lines. It would be possible to format such an address very
     *           approximately without geocoding, but no semantic reasoning could be
     *           made about any of the address components until it was at least
     *           partially resolved.
     *           Creating an address only containing a region_code and address_lines, and
     *           then geocoding is the recommended way to handle completely unstructured
     *           addresses (as opposed to guessing which parts of the address should be
     *           localities or administrative areas).
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $recipients
     *           Optional. The recipient at the address.
     *           This field may, under certain circumstances, contain multiline information.
     *           For example, it might contain "care of" information.
     *     @type string $organization
     *           Optional. The name of the organization at the address.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Type\PostalAddress::initOnce();
        parent::__construct($data);
    }

    /**
     * The schema revision of the `PostalAddress`. This must be set to 0, which is
     * the latest revision.
     * All new revisions **must** be backward compatible with old revisions.
     *
     * Generated from protobuf field <code>int32 revision = 1;</code>
     * @return int
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * The schema revision of the `PostalAddress`. This must be set to 0, which is
     * the latest revision.
     * All new revisions **must** be backward compatible with old revisions.
     *
     * Generated from protobuf field <code>int32 revision = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setRevision($var)
    {
        GPBUtil::checkInt32($var);
        $this->revision = $var;

        return $this;
    }

    /**
     * Required. CLDR region code of the country/region of the address. This
     * is never inferred and it is up to the user to ensure the value is
     * correct. See http://cldr.unicode.org/ and
     * http://www.unicode.org/cldr/charts/30/supplemental/territory_information.html
     * for details. Example: "CH" for Switzerland.
     *
     * Generated from protobuf field <code>string region_code = 2;</code>
     * @return string
     */
    public function getRegionCode()
    {
        return $this->region_code;
    }

    /**
     * Required. CLDR region code of the country/region of the address. This
     * is never inferred and it is up to the user to ensure the value is
     * correct. See http://cldr.unicode.org/ and
     * http://www.unicode.org/cldr/charts/30/supplemental/territory_information.html
     * for details. Example: "CH" for Switzerland.
     *
     * Generated from protobuf field <code>string region_code = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setRegionCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->region_code = $var;

        return $this;
    }

    /**
     * Optional. BCP-47 language code of the contents of this address (if
     * known). This is often the UI language of the input form or is expected
     * to match one of the languages used in the address' country/region, or their
     * transliterated equivalents.
     * This can affect formatting in certain countries, but is not critical
     * to the correctness of the data and will never affect any validation or
     * other non-formatting related operations.
     * If this value is not known, it should be omitted (rather than specifying a
     * possibly incorrect default).
     * Examples: "zh-Hant", "ja", "ja-Latn", "en".
     *
     * Generated from protobuf field <code>string language_code = 3;</code>
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->language_code;
    }

    /**
     * Optional. BCP-47 language code of the contents of this address (if
     * known). This is often the UI language of the input form or is expected
     * to match one of the languages used in the address' country/region, or their
     * transliterated equivalents.
     * This can affect formatting in certain countries, but is not critical
     * to the correctness of the data and will never affect any validation or
     * other non-formatting related operations.
     * If this value is not known, it should be omitted (rather than specifying a
     * possibly incorrect default).
     * Examples: "zh-Hant", "ja", "ja-Latn", "en".
     *
     * Generated from protobuf field <code>string language_code = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setLanguageCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->language_code = $var;

        return $this;
    }

    /**
     * Optional. Postal code of the address. Not all countries use or require
     * postal codes to be present, but where they are used, they may trigger
     * additional validation with other parts of the address (e.g. state/zip
     * validation in the U.S.A.).
     *
     * Generated from protobuf field <code>string postal_code = 4;</code>
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Optional. Postal code of the address. Not all countries use or require
     * postal codes to be present, but where they are used, they may trigger
     * additional validation with other parts of the address (e.g. state/zip
     * validation in the U.S.A.).
     *
     * Generated from protobuf field <code>string postal_code = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setPostalCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->postal_code = $var;

        return $this;
    }

    /**
     * Optional. Additional, country-specific, sorting code. This is not used
     * in most regions. Where it is used, the value is either a string like
     * "CEDEX", optionally followed by a number (e.g. "CEDEX 7"), or just a number
     * alone, representing the "sector code" (Jamaica), "delivery area indicator"
     * (Malawi) or "post office indicator" (e.g. Côte d'Ivoire).
     *
     * Generated from protobuf field <code>string sorting_code = 5;</code>
     * @return string
     */
    public function getSortingCode()
    {
        return $this->sorting_code;
    }

    /**
     * Optional. Additional, country-specific, sorting code. This is not used
     * in most regions. Where it is used, the value is either a string like
     * "CEDEX", optionally followed by a number (e.g. "CEDEX 7"), or just a number
     * alone, representing the "sector code" (Jamaica), "delivery area indicator"
     * (Malawi) or "post office indicator" (e.g. Côte d'Ivoire).
     *
     * Generated from protobuf field <code>string sorting_code = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setSortingCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->sorting_code = $var;

        return $this;
    }

    /**
     * Optional. Highest administrative subdivision which is used for postal
     * addresses of a country or region.
     * For example, this can be a state, a province, an oblast, or a prefecture.
     * Specifically, for Spain this is the province and not the autonomous
     * community (e.g. "Barcelona" and not "Catalonia").
     * Many countries don't use an administrative area in postal addresses. E.g.
     * in Switzerland this should be left unpopulated.
     *
     * Generated from protobuf field <code>string administrative_area = 6;</code>
     * @return string
     */
    public function getAdministrativeArea()
    {
        return $this->administrative_area;
    }

    /**
     * Optional. Highest administrative subdivision which is used for postal
     * addresses of a country or region.
     * For example, this can be a state, a province, an oblast, or a prefecture.
     * Specifically, for Spain this is the province and not the autonomous
     * community (e.g. "Barcelona" and not "Catalonia").
     * Many countries don't use an administrative area in postal addresses. E.g.
     * in Switzerland this should be left unpopulated.
     *
     * Generated from protobuf field <code>string administrative_area = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setAdministrativeArea($var)
    {
        GPBUtil::checkString($var, True);
        $this->administrative_area = $var;

        return $this;
    }

    /**
     * Optional. Generally refers to the city/town portion of the address.
     * Examples: US city, IT comune, UK post town.
     * In regions of the world where localities are not well defined or do not fit
     * into this structure well, leave locality empty and use address_lines.
     *
     * Generated from protobuf field <code>string locality = 7;</code>
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Optional. Generally refers to the city/town portion of the address.
     * Examples: US city, IT comune, UK post town.
     * In regions of the world where localities are not well defined or do not fit
     * into this structure well, leave locality empty and use address_lines.
     *
     * Generated from protobuf field <code>string locality = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setLocality($var)
    {
        GPBUtil::checkString($var, True);
        $this->locality = $var;

        return $this;
    }

    /**
     * Optional. Sublocality of the address.
     * For example, this can be neighborhoods, boroughs, districts.
     *
     * Generated from protobuf field <code>string sublocality = 8;</code>
     * @return string
     */
    public function getSublocality()
    {
        return $this->sublocality;
    }

    /**
     * Optional. Sublocality of the address.
     * For example, this can be neighborhoods, boroughs, districts.
     *
     * Generated from protobuf field <code>string sublocality = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setSublocality($var)
    {
        GPBUtil::checkString($var, True);
        $this->sublocality = $var;

        return $this;
    }

    /**
     * Unstructured address lines describing the lower levels of an address.
     * Because values in address_lines do not have type information and may
     * sometimes contain multiple values in a single field (e.g.
     * "Austin, TX"), it is important that the line order is clear. The order of
     * address lines should be "envelope order" for the country/region of the
     * address. In places where this can vary (e.g. Japan), address_language is
     * used to make it explicit (e.g. "ja" for large-to-small ordering and
     * "ja-Latn" or "en" for small-to-large). This way, the most specific line of
     * an address can be selected based on the language.
     * The minimum permitted structural representation of an address consists
     * of a region_code with all remaining information placed in the
     * address_lines. It would be possible to format such an address very
     * approximately without geocoding, but no semantic reasoning could be
     * made about any of the address components until it was at least
     * partially resolved.
     * Creating an address only containing a region_code and address_lines, and
     * then geocoding is the recommended way to handle completely unstructured
     * addresses (as opposed to guessing which parts of the address should be
     * localities or administrative areas).
     *
     * Generated from protobuf field <code>repeated string address_lines = 9;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAddressLines()
    {
        return $this->address_lines;
    }

    /**
     * Unstructured address lines describing the lower levels of an address.
     * Because values in address_lines do not have type information and may
     * sometimes contain multiple values in a single field (e.g.
     * "Austin, TX"), it is important that the line order is clear. The order of
     * address lines should be "envelope order" for the country/region of the
     * address. In places where this can vary (e.g. Japan), address_language is
     * used to make it explicit (e.g. "ja" for large-to-small ordering and
     * "ja-Latn" or "en" for small-to-large). This way, the most specific line of
     * an address can be selected based on the language.
     * The minimum permitted structural representation of an address consists
     * of a region_code with all remaining information placed in the
     * address_lines. It would be possible to format such an address very
     * approximately without geocoding, but no semantic reasoning could be
     * made about any of the address components until it was at least
     * partially resolved.
     * Creating an address only containing a region_code and address_lines, and
     * then geocoding is the recommended way to handle completely unstructured
     * addresses (as opposed to guessing which parts of the address should be
     * localities or administrative areas).
     *
     * Generated from protobuf field <code>repeated string address_lines = 9;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAddressLines($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->address_lines = $arr;

        return $this;
    }

    /**
     * Optional. The recipient at the address.
     * This field may, under certain circumstances, contain multiline information.
     * For example, it might contain "care of" information.
     *
     * Generated from protobuf field <code>repeated string recipients = 10;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Optional. The recipient at the address.
     * This field may, under certain circumstances, contain multiline information.
     * For example, it might contain "care of" information.
     *
     * Generated from protobuf field <code>repeated string recipients = 10;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRecipients($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->recipients = $arr;

        return $this;
    }

    /**
     * Optional. The name of the organization at the address.
     *
     * Generated from protobuf field <code>string organization = 11;</code>
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Optional. The name of the organization at the address.
     *
     * Generated from protobuf field <code>string organization = 11;</code>
     * @param string $var
     * @return $this
     */
    public function setOrganization($var)
    {
        GPBUtil::checkString($var, True);
        $this->organization = $var;

        return $this;
    }

}

