<?php

namespace Ruvents\RuworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ruvents\DoctrineBundle\Translations\AbstractTranslations;

/**
 * @ORM\Embeddable()
 *
 * @deprecated Since version 0.5.17. To be removed in 0.6.0.
 */
class RuEnTranslations extends AbstractTranslations
{
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $ru;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $en;

    public function __construct(string $ru = null, string $en = null)
    {
        @trigger_error(sprintf('Class %s is deprecated since version 0.5.17. To be removed in 0.6.0. Use %s instead.', __CLASS__, TextRuEnTranslations::class), E_USER_DEPRECATED);

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

    public function getRu(): ?string
    {
        return $this->ru;
    }

    public function setRu(?string $ru)
    {
        $this->ru = $ru;

        return $this;
    }

    public function getEn(): ?string
    {
        return $this->en;
    }

    public function setEn(?string $en)
    {
        $this->en = $en;

        return $this;
    }
}
