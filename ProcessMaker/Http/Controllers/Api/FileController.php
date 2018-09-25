<?php

namespace ProcessMaker\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Horizon\Http\Controllers\Controller;
use ProcessMaker\Http\Resources\ApiCollection;
use ProcessMaker\Models\Media;
use ProcessMaker\Models\User;
use Spatie\BinaryUuid\HasBinaryUuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Media::query();
        $filter = $request->input('filter', '');

        if (!empty($filter)) {
            $filter = '%' . $filter . '%';
            $query->where(function ($query) use ($filter) {
                $query->Where('file_name', 'like', $filter)
                    ->orWhere('mime_type', 'like', $filter);
            });
        }

        $query->orderBy(
            $request->input('order_by', 'updated_at'),
            $request->input('order_direction', 'asc')
        );

        $response = $query->paginate($request->input('per_page', 10));
        return new ApiCollection($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // We get the model instance with the data that the user sent
        $modelType = 'ProcessMaker\\Models\\' . ucwords($request->query('model', null));
        $modelId = HasBinaryUuid::encodeUuid($request->query('model_uuid', null));
        $model = $modelType::find($modelId);

        // If we can't find the model we can't associate it, so we throw an error
        if ($modelType === null || $modelId === null || $model === null) {
            throw new NotFoundHttpException();
        }

        $model->addMediaFromRequest('file')->toMediaCollection('local');

        return response([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     *
     * @internal param int $id
     */
    public function show(Request $request, Media $file)
    {
        $path = Storage::disk('public')->getAdapter()->getPathPrefix() .
                $file->uuid_text . '/' .
                $file->file_name;
        //$file = Storage::disk('public')->download($file->uuid_text . '/' . $file->file_name);
        return response()->download(($path));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Media $file
     * @return \Illuminate\Http\Response
     *
     * @internal param int $id
     */
    public function destroy(Media $file)
    {
        // We get the model instance with the information that comes in the media
        $modelType = $file->model_type;
        $modelId = $file->model_id;
        $model = $modelType::find($modelId);

        $model->deleteMedia($file->uuid);

        return response([], 204);
    }
}