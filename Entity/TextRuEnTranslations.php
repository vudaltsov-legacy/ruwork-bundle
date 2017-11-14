<?php

namespace Ruvents\RuworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ruvents\DoctrineBundle\Translations\AbstractTranslations;

/**
 * @ORM\Embeddable()
 */
class TextRuEnTranslations extends AbstractTranslations
{
    /**
     * @ORM\Column(type="text")
     */
    protected $ru = '';

    /**
     * @ORM\Column(type="text")
     */
    protected $en = '';

    public function __construct(string $ru = '', string $en = '')
    {
        $this->ru = $ru;
        $this->en = $en;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public static function getLocalesMap(): array
    {
        return [
            'ru' => true,
            'en' => true,
        ];
    }

    public function __toString()
    {
        return (string)$this->getCurrent(true);
    }

    public function getRu(): string
    {
        return $this->ru;
    }

    public function setRu(string $ru)
    {
        $this->ru = $ru;

        return $this;
    }

    public function getEn(): string
    {
        return $this->en;
    }

    public function setEn(string $en)
    {
        $this->en = $en;

        return $this;
    }
}
