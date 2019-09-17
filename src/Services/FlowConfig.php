<?php
declare(strict_types=1);

namespace LoyaltyCorp\FlowConfig\Services;

use CodeFoundation\FlowConfig\Interfaces\ConfigRepositoryInterface;
use CodeFoundation\FlowConfig\Interfaces\EntityConfigRepositoryInterface;
use LoyaltyCorp\FlowConfig\Entities\FlowConfigurableInterface;
use LoyaltyCorp\FlowConfig\Services\Interfaces\FlowConfigInterface;

final class FlowConfig implements FlowConfigInterface
{
    /**
     * @var \CodeFoundation\FlowConfig\Interfaces\EntityConfigRepositoryInterface
     */
    private $entityFlowConfig;

    /**
     * @var \CodeFoundation\FlowConfig\Interfaces\ConfigRepositoryInterface
     */
    private $flowConfig;

    /**
     * FlowConfig constructor.
     *
     * @param \CodeFoundation\FlowConfig\Interfaces\EntityConfigRepositoryInterface $entityFlowConfig
     * @param \CodeFoundation\FlowConfig\Interfaces\ConfigRepositoryInterface $flowConfig
     */
    public function __construct(
        EntityConfigRepositoryInterface $entityFlowConfig,
        ConfigRepositoryInterface $flowConfig
    ) {
        $this->entityFlowConfig = $entityFlowConfig;
        $this->flowConfig = $flowConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, ?string $default = null): ?string
    {
        $value = $this->flowConfig->get($key, $default);

        return \is_scalar($value) === true ? (string)$value : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getByEntity(FlowConfigurableInterface $entity, string $key, ?string $default = null): ?string
    {
        return $this->entityFlowConfig->getByEntity($entity, $key, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, string $value): void
    {
        $this->flowConfig->set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function setByEntity(FlowConfigurableInterface $entity, string $key, string $value): void
    {
        $this->entityFlowConfig->setByEntity($entity, $key, $value);
    }
}