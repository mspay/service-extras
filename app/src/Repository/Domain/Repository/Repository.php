<?php declare(strict_types = 1);

namespace Alroniks\Repository\Domain\Repository;

use Alroniks\Repository\Contracts\EntityInterface;

/**
 * Repository entity
 * @package Alroniks\Repository\Domain\Repository
 */
final class Repository implements EntityInterface
{
    private $id;
    private $name;
    private $description;
    private $createdon;
    private $rank;
    private $templated;

    /**
     * Repository constructor.
     * @param string|null $id
     * @param string $name
     * @param string $description
     * @param string $createdon
     * @param int $rank
     * @param bool $templated
     */
    public function __construct(
        string $id = null, 
        string $name, 
        string $description, 
        string $createdon, 
        int $rank, 
        bool $templated
    ) {
        $this->id = $id ?: substr(md5(md5($name)), 0, 10);
        $this->name = $name;
        $this->description = $description;
        $this->createdon = new \DateTimeImmutable($createdon);
        $this->rank = $rank;
        $this->templated = $templated;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedOn() : \DateTimeImmutable
    {
        return $this->createdon;
    }

    /**
     * @return int
     */
    public function getRank() : int
    {
        return $this->rank;
    }

    /**
     * @return bool
     */
    public function getTemplated() : bool
    {
        return $this->templated;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $array = get_class_vars(__CLASS__);

        foreach ($array as $key => &$value) {
            $value = call_user_func([$this, 'get' . lcfirst($key)]);
            if ($value instanceof \DateTimeImmutable) {
                $value = $value->format(\DateTime::ISO8601);
            }
        }

        return $array;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getId();
    }
}
