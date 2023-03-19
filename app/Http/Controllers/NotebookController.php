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
     * @OA\Get(
     *      path="/api/notebook/",
     *      operationId="index",
     *      tags={"Notebook"},
     *      summary="Получение всех блокнотов",
     *      description=" На одной странице отображается 5 блокнотов",
     *      @OA\Parameter(name="page", in="query", description="The page number", required=false,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200, description="Success",
     *       )
     * )
     */

    public function index()
    {
        return Notebook::simplePaginate(5);
    }

    /**
     * @OA\Post(
     *      path="/api/notebook/",
     *      operationId="store",
     *      tags={"Notebook"},
     *      summary="Добавление блокнота",
     *      description="Store notebook in DB",
     *      @OA\RequestBody(required=true,
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(required={"first_name", "last_name", "third_name", "phone", "email"},
     *            @OA\Property(property="first_name", type="string", format="string", example="Имя"),
     *            @OA\Property(property="last_name", type="string", format="string", example="Фамилия"),
     *            @OA\Property(property="third_name", type="string", format="string", example="Отчество"),
     *            @OA\Property(property="company", type="string", format="string", example="Компания"),
     *            @OA\Property(property="phone", type="string", format="string", example="ххххххххххх"),
     *            @OA\Property(property="email", type="string", format="string", example="Почта"),
     *            @OA\Property(property="date_birth", type="date", format="Y-m-d", example="хххх-хх-хх"),
     *            @OA\Property(property="photo", type="array",
     *                         @OA\Items(type="string", format="binary"),
     *                        ),
     *                      ),
     *                   )
     *                 ),
     *     @OA\Response(
     *          response=200, description="Success"
     *       )
     *  )
     */
    public function store(StoreNotebookRequest $request)
    {
        $notebook = Notebook::create($request->all());

        return $this->photoService->saveNotebook($notebook, $request->file('photo'));
    }

    /**
     * @OA\Get(
     *      path="/api/notebook/{id}",
     *      operationId="show",
     *      tags={"Notebook"},
     *      summary="Получение блокнота по id",
     *      description="",
     *      @OA\Parameter(name="id", in="path", description="Id of Notebook", required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200, description="Success",
     *       )
     *  )
     */
    public function show($id)
    {
        return Notebook::query()->find($id);
    }

    /**
     * @OA\Post(
     *      path="/api/notebook/{id}",
     *      operationId="update",
     *      tags={"Notebook"},
     *      summary="Редактирование блокнота по id",
     *      description="Update notebook in DB",
     *      @OA\Parameter(name="id", in="path", description="Id of Notebook", required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(required=true,
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *            @OA\Property(property="first_name", type="string", format="string", example="Имя"),
     *            @OA\Property(property="last_name", type="string", format="string", example="Фамилия"),
     *            @OA\Property(property="third_name", type="string", format="string", example="Отчество"),
     *            @OA\Property(property="company", type="string", format="string", example="Компания"),
     *            @OA\Property(property="phone", type="string", format="string", example="ххххххххххх"),
     *            @OA\Property(property="email", type="string", format="string", example="Почта"),
     *            @OA\Property(property="date_birth", type="date", format="Y-m-d", example="хххх-хх-хх"),
     *            @OA\Property(property="photo", type="array",
     *                        @OA\Items(type="string", format="binary"),
     *                        ),
     *                     ),
     *                   )
     *                 ),
     *      @OA\Response(
     *          response=200, description="Success",
     *       )
     *  )
     */
    public function update(StoreNotebookUpdateRequest $request, $id)
    {
        $notebook = Notebook::query()->find($id);

        $notebook->update($request->all());
        return $this->photoService->saveNotebook($notebook, $request->file('photo'));
    }

    /**
     * @OA\Delete(
     *      path="/api/notebook/{id}",
     *      operationId="delete",
     *      tags={"Notebook"},
     *      summary="Удаление блокнота по id",
     *      description="",
     *      @OA\Parameter(name="id", in="path", description="Id of Notebook", required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200, description="Success",
     *       )
     *  )
     */
    public function delete($id)
    {
        $notebook = Notebook::query()->find($id);

        $notebook->delete();

        return response()->json(['message' => 'User deleted'],200);
    }
}
