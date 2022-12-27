<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DichesDeleteRequest;
use App\Http\Requests\Api\DichesUpsertRequest;
use App\Models\Category;
use App\Models\Diches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DichesController extends Controller
{
    public function index()
    {
        $disches = Diches::all(['id_diches as id', 'name', 'image', 'price', 'count']);
        return ['success' => true, 'result' => $disches];
    }

    public function upsert(DichesUpsertRequest $request)
    {
        try {
            $data = $request->validated();
            unset($data['token']);
            if (isset($data['id'])) {
                if (isset($data['image'])) {
                    $data['image'] = 'images/diches/' . Storage::disk('diches')->putFileAs('', $request->image, Str::uuid() . '.' . $request->image->getClientOriginalExtension());
                    Storage::delete(Diches::find($data['id'])->image);
                }
                $id_diches = $data['id'];
                unset($data['id']);
                Diches::where('id_diches', $id_diches)->update($data);
            } else {
                $data['image'] = 'images/diches/' . Storage::disk('diches')->putFileAs('', $request->image, Str::uuid() . '.' . $request->image->getClientOriginalExtension());
                Diches::create($data);
            }
            return ['success' => true, 'result' => Diches::where('name', $data['name'])->first()->id_diches];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function delete(DichesDeleteRequest $request)
    {
        try {
            $data = $request->validated();
            $diches = Diches::where('id_diches', $data['id'])->first();
            Storage::disk('public')->delete($diches->image);
            $diches->delete();
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
