<?php

namespace App\Services\V1\Registers;

use App\Exceptions\UnprocessableEntityException;
use App\Models\System;
use App\Repositories\Contracts\Registers\SystemRepositoryInterface;
use App\Services\Contracts\Registers\ModuleServiceInterface;
use App\Services\Contracts\Registers\SystemServiceInterface;
use App\Validators\Contracts\Registers\SystemValidatorInterface;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class SystemService implements SystemServiceInterface
{
    private $systemRepository;
    private $systemValidator;
    private $moduleService;

    public function __construct(
        SystemRepositoryInterface $systemRepository,
        SystemValidatorInterface $systemValidator,
        ModuleServiceInterface $moduleService
    ) {
        $this->systemRepository = $systemRepository;
        $this->systemValidator = $systemValidator;
        $this->moduleService = $moduleService;
    }

    public function all(): Collection
    {
        return $this->systemRepository->all();
    }

    public function create(array $data): System
    {
        $validation = $this->systemValidator->onCreate($data);

        if ($validation->fails()) {
            throw new UnprocessableEntityException($validation->getMessageBag()->toArray());
        }

        $system = null;

        $this->systemRepository->beginTransaction();

        try {
            $system = $this->systemRepository->create($data);

            if (isset($data['modules'])) {
                $this->moduleService->createAll($system->id, $data['modules']);
                $system->load('modules');
            }

            $this->systemRepository->commit();
        } catch (Throwable $exception) {
            $this->systemRepository->rollback();
            throw $exception;
        }

        return $system;
    }

    public function find(int $systemId): System
    {
        return $this->systemRepository->find($systemId);
    }

    public function update(int $systemId, array $data): bool
    {
        $validation = $this->systemValidator->onUpdate($data);

        if ($validation->fails()) {
            throw new UnprocessableEntityException($validation->getMessageBag()->toArray());
        }

        return $this->systemRepository->update($systemId, $data);
    }

    public function delete(int $systemId): bool
    {
        return $this->systemRepository->delete($systemId);
    }

    public function deleteAll(array $systemIds): bool
    {
        return $this->systemRepository->deleteAll($systemIds);
    }
}
