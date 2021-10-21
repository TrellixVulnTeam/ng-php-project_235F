<?php

declare(strict_types=1);

namespace Orion\Specs\Builders\Operations\Batch;

use Illuminate\Contracts\Container\BindingResolutionException;
use Orion\Specs\Builders\OperationBuilder;
use Orion\ValueObjects\Specs\Operation;
use Orion\ValueObjects\Specs\Request;
use Orion\ValueObjects\Specs\Requests\Batch\BatchStoreRequest;
use Orion\ValueObjects\Specs\Responses\Error\ValidationErrorResponse;
use Orion\ValueObjects\Specs\Responses\Success\CollectionResponse;

class BatchStoreOperationBuilder extends OperationBuilder
{
    /**
     * @return Operation
     * @throws BindingResolutionException
     */
    public function build(): Operation
    {
        $operation = $this->makeBaseOperation();
        $operation->summary = "Create a batch of {$this->resolveResourceName(true)}";

        return $operation;
    }

    /**
     * @return Request|null
     * @throws BindingResolutionException
     */
    protected function request(): ?Request
    {
        return new BatchStoreRequest($this->resolveResourceComponentBaseName());
    }

    /**
     * @return array
     * @throws BindingResolutionException
     */
    protected function responses(): array
    {
        return array_merge(
            [
                new CollectionResponse($this->resolveResourceComponentBaseName()),
                new ValidationErrorResponse(),
            ],
            parent::responses()
        );
    }
}
