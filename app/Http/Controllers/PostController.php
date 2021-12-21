<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function unAuthenticatedList()
    {
        try {

            $posts = Post::orderBy('created_at', 'desc')->paginate(10, ['title', 'description']);

            return $this->successResponse(['post' => $posts]);

        } catch (\Exception $e) {
            return $this->failureResponse($e->getMessage());
        }
    }

    public function store(PostRequest $request)
    {
        try {
            $request->request->add(['user_id' => auth()->user()->id]);

            $post =  Post::create($request->all());

            return $this->successResponse(['post' => $post]);
        } catch (\Exception $e) {
            return $this->failureResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $post = Post::where('id', $id)->first();
            $post['user'] = $post->User;
            return $this->successResponse(['post' => $post]);
        } catch (\Exception $e) {
            return $this->failureResponse($e->getMessage());
        }
    }
}
