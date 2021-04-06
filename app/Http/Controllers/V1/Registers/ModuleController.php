<?php

namespace App\Http\Controllers\V1\Registers;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Registers\ModuleServiceInterface;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    private $systemService;

    public function __construct(ModuleServiceInterface $systemService)
    {
        $this->systemService = $systemService;
    }

    public function index(int $systemId)
    {
        return response()->json($this->systemService->all($systemId));
    }

    public function store(Request $request, int $systemId)
    {
        return response()->json($this->systemService->create($systemId, $request->all()), 201);
    }

    public function show(int $systemId, int $moduleId)
    {
        return response()->json($this->systemService->find($systemId, $moduleId));
    }

    public function update(int $systemId, int $moduleId, Request $request)
    {
        $this->systemService->update($systemId, $moduleId, $request->all());
        return response()->json(null, 204);
    }

    public function destroy(int $systemId, int $moduleId)
    {
        $this->systemService->delete($systemId, $moduleId);
        return response()->json(null, 204);
    }

    public function destroyAll(Request $request, int $systemId)
    {
        $this->systemService->deleteAll($systemId, $request->moduleIds);
        return response()->json(null, 204);
    }
}
