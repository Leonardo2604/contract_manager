<?php

namespace App\Http\Controllers\V1\Registers;

use App\Export\Managers\Registers\SystemExportManager;
use App\Http\Controllers\Controller;
use App\Services\Contracts\Registers\SystemServiceInterface;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    private $systemService;

    public function __construct(SystemServiceInterface $systemService)
    {
        $this->systemService = $systemService;
    }

    public function index()
    {
        return response()->json($this->systemService->all());
    }

    public function store(Request $request)
    {
        return response()->json($this->systemService->create($request->all()), 201);
    }

    public function show(int $systemId)
    {
        return response()->json($this->systemService->find($systemId));
    }

    public function update(int $systemId, Request $request)
    {
        $this->systemService->update($systemId, $request->all());
        return response()->json(null, 204);
    }

    public function destroy(int $systemId)
    {
        $this->systemService->delete($systemId);
        return response()->json(null, 204);
    }

    public function destroyAll(Request $request)
    {
        $this->systemService->deleteAll($request->systemIds);
        return response()->json(null, 204);
    }

    public function makeReportPdf(Request $request)
    {
        $systems = $this->systemService->all()->toArray();
        $exportManager = new SystemExportManager($systems);
        return response()->download($exportManager->makeZip($request->types))->deleteFileAfterSend();
    }
}
