<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * Import:
 * - exception untuk handle error
 * - repository nya
 */
use Exception;
use App\Services\PostService;

class PostController extends Controller
{
    // buat property nya
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $result = [
            'status' => 200
        ];

        try {
            //code...
            $result['data'] = $this->postService->getAll();
        } catch (Exception $e) {
            //throw $th;
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'description'
        ]);

        $result = ['status' => 201];

        try {
            //code...
            $result['data'] = $this->postService->store($data);
        } catch (\Exception $e) {
            //throw $th;
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
