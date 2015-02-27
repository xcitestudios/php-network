<?php
namespace com\xcitestudios\Network\Email;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use InvalidArgumentException;
use JsonSerializable;
use stdClass;

class ContactCollection extends ArrayCollection
    implements SerializationInterface, JsonSerializable
{
    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param string|integer $key   The key/index of the element to set.
     * @param Contact  $value The element to set.
     *
     * @return void
     */
    public function set($key, $value)
    {
        if (!$value instanceof Contact) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s only accepts instances of %s. Tried to to set key %s.',
                    __FUNCTION__, Contact::class, $key
                )
            );
        }

        parent::set($key, $value);
    }

    /**
     * Adds an element at the end of the collection.
     *
     * @param Contact $element The element to add.
     *
     * @return boolean Always TRUE.
     */
    public function add($value)
    {
        if (!$value instanceof Contact) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s only accepts instances of %s.',
                    __FUNCTION__, Contact::class
                )
            );
        }

        return parent::add($value);
    }

    /**
     * Convert stdClass objects to a collection of email body parts.
     *
     * @param stdClass[] $objects
     * @return static|null
     */
    public static function createFromObjects(array $objects = null)
    {
        if ($objects === null) {
            return null;
        }

        $collection = new static();

        foreach ($objects as $v) {
            $part = new Contact();
            $part->updateFromObject($v);

            $collection->add($v);
        }

        return $collection;
    }

    /**
     * Updates the element implementing this interface using a JSON representation.
     * This means updating the state of this object with that defined in the JSON
     * as opposed to returning a new instance of this object.
     *
     * @param string $jsonString Representation of the object
     *
     * @return void
     */
    public function deserializeJSON($jsonString)
    {
        $data = \json_decode($jsonString);

        $this->clear();

        foreach ($data as $v) {

            $part = new Contact();
            $part->updateFromObject($v);

            $this->add($v);
        }
    }

    /**
     * Convert this object into JSON so it can be handled by anything that supports JSON.
     *
     * @return string A JSON representation of this object.
     */
    public function serializeJSON()
    {
        return \json_encode($this->jsonSerialize());
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *       which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $ret = [];

        foreach ($this as $v) { /* @var $v Contact */
            $ret[] = $v->jsonSerialize();
        }

        return $ret;
    }
}