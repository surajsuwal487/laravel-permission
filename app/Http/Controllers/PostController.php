<?php

namespace App\Http\Controllers;

use App\Repository\PostRepository;
use App\Repository\BaseRepository;
use Illuminate\Http\Request;

class PostController extends BaseRepository
{

    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function index(Request $request)
    {
        try {
            $posts = $this->postRepository->all();
            return view('post.view', compact('posts'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function create()
    {
        try {
            return view('post.create');
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }


    // public function edit(Request $request)
    // {
    //     try {
    //         $slug = $request->category;
    //         $category = $this->categoryRepository->findBySlug($slug);
    //         return view('inventorymanagement::backend.category.edit-category', compact('category'));
    //     } catch (\Exception $e) {
    //         $exception = $e->getMessage();
    //         dd($e->getMessage());
    //         return redirect()->back()->with('error', $exception);
    //     }
    // }

}
