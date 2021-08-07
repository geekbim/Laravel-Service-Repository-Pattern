<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Api\PostService;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $result = [
                'status'    => 200,
                'message'   => 'Get posts successfully',
                'data'      => $this->postService->getAll()
            ];
        } catch (Exception $e) {
            $result = [
                'status'    => 500,
                'message'   => 'Get posts failed',
                'error'     => $e->getMessage()
            ];
        }

        return response()->json($result, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'content'
        ]);

        try {
            $result = [
                'status'    => true,
                'message'   => 'Create post successfully',
                'data'      => $this->postService->savePostData($data)
            ];
        } catch (Exception $e) {
            $result = [
                'status'    => false,
                'message'   => 'Create post failed',
                'error'     => $e->getMessage()
            ];
        }

        return response()->json($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $result = [
                'status'    => true,
                'message'   => 'Get post successfully',
                'data'      => $this->postService->getById($id)
            ];
        } catch (Exception $e) {
            $result = [
                'status'    => false,
                'message'   => 'Get post failed',
                'error'     => $e->getMessage()
            ];
        }

        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'title',
            'content'
        ]);

        try {
            $result = [
                'status'    => true,
                'message'   => 'Update post successfully',   
                'data'      => $this->postService->updatePost($data, $id)
            ];
        } catch (Exception $e) {
            $result = [
                'status'    => false,
                'message'   => 'Update post failed',   
                'error'     => $e->getMessage()
            ];
        }

        return response()->json($result, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = [
                'status'    => true,
                'message'   => 'Delete post successfully',
                'data'      => $this->postService->deleteById($id),
            ];
        } catch (Exception $e) {
            $result = [
                'status'    => false,
                'message'   => 'Delete post failed',
                'error'     => $e->getMessage()
            ];
        }

        return response()->json($result, 200);
    }
}
