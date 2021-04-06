<?php

namespace App\Services\V1\Registers;

use App\Exceptions\UnprocessableEntityException;
use App\Models\Module;
use App\Repositories\Contracts\Registers\ModuleRepositoryInterface;
use App\Services\Contracts\Registers\ModuleServiceInterface;
use App\Validators\Contracts\Registers\ModuleValidatorInterface;
use Illuminate\Database\Eloquent\Collection;

class ModuleService implements ModuleServiceInterface
{
    private $moduleRepository;
    private $moduleValidator;

    public function __construct(
        ModuleRepositoryInterface $moduleRepository,
        ModuleValidatorInterface $moduleValidator
    ) {
        $this->moduleRepository = $moduleRepository;
        $this->moduleValidator = $moduleValidator;
    }

    public function all(int $systemId): Collection
    {
        return $this->moduleRepository->all($systemId);
    }

    public function create(int $systemId, array $data): Module
    {
        $validation = $this->moduleValidator->onCreate($data);

        if ($validation->fails()) {
            throw new UnprocessableEntityException($validation->getMessageBag()->toArray());
        }

        return $this->moduleRepository->create($systemId, $data);
    }

    public function createAll(int $systemId, array $data): Collection
    {
        $validation = $this->moduleValidator->onCreateAll($data);

        if ($validation->fails()) {
            throw new UnprocessableEntityException($validation->getMessageBag()->toArray());
        }

        return $this->moduleRepository->createAll($systemId, $data);
    }

    public function find(int $systemId, int $moduleId): Module
    {
        return $this->moduleRepository->find($systemId, $moduleId);
    }

    public function update(int $systemId, int $moduleId, array $data): bool
    {
        $validation = $this->moduleValidator->onUpdate($data);

        if ($validation->fails()) {
            throw new UnprocessableEntityException($validation->getMessageBag()->toArray());
        }

        return $this->moduleRepository->update($systemId, $moduleId, $data);
    }

    public function delete(int $systemId, int $moduleId): bool
    {
        return $this->moduleRepository->delete($systemId, $moduleId);
    }

    public function deleteAll(int $systemId, array $moduleIds): bool
    {
        return $this->moduleRepository->deleteAll($systemId, $moduleIds);
    }
}
