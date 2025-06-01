<?php

namespace App\Http\Controllers;

use App\Traits\ValidatesData;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

abstract class CommonController extends Controller
{
    use ValidatesData;

    // Child controllers must assign a service instance.
    protected $service;

    /**
     * Each controller must implement this method to provide
     * validation rules.
     */
    abstract public function getRules(bool $isUpdate = false): array;

    protected function index(Request $request): JsonResponse
    {
        $filters = $request->all();
        $data = $this->service->getList($filters);

        return response()->json($data);
    }

    protected function show($id): JsonResponse
    {
        try {
            $model = $this->service->findByID($id);

            return response()->json($model);
        } catch (Exception $e) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
    }

    protected function store(Request $request): JsonResponse
    {
        try {
            // Validate incoming data using the controller's rules.
            $validatedData = $this->validateData($request->all(), $this->getRules(false));
            $model = $this->service->create($validatedData);

            return response()->json($model, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    protected function update(Request $request, $id): JsonResponse
    {
        try {
            $validatedData = $this->validateData($request->all(), $this->getRules(true));
            $model = $this->service->update($id, $validatedData);

            return response()->json($model);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    protected function destroy($id): JsonResponse
    {
        try {
            $deleted = $this->service->delete($id);

            return response()->json(['deleted' => $deleted]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
