<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\StoreNotebookUpdateRequest;
use App\Models\Notebook;
use App\Services\NotebookService;

class NotebookController extends Controller
{
    private NotebookService $photoService;

    public function __construct(NotebookService $photoService)
    {
        $this->photoService = $photoService;
    }

    /**
     * Получение всех блокнотов
     */
    public function index()
    {
        return Notebook::simplePaginate(5);
    }

    /**
     * Добавление блокнота
     */
    public function store(StoreNotebookRequest $request)
    {
        $notebook = Notebook::create($request->all());

        return $this->photoService->saveNotebook($notebook, $request->file('photo'));
    }

    /**
     * Получение блокнота по id
     */
    public function show($id)
    {
        return Notebook::query()->find($id);
    }

    /**
     * Редактирование блокнота по id
     */
    public function update(StoreNotebookUpdateRequest $request, $id)
    {
        $notebook = Notebook::query()->find($id);

        $notebook->update($request->all());

        return $this->photoService->saveNotebook($notebook, $request->file('photo'));
    }

    /**
     * Удаление блокнота по id
     */
    public function delete($id)
    {
        $notebook = Notebook::query()->find($id);

        $notebook->delete();

        return response()->json(['message' => 'User deleted'],200);
    }
}
