<?php

namespace App\Http\Controllers;

use App\Repository\PostRepository;
use App\Repository\BaseRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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


    public function edit(Request $request)
    {
        try {
            return view('post.edit');
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function viewRoles(Request $request)
    {
        try {
            $roles = Role::WhereNotIn('name', ['admin'])->get();
            return view('admin.view-roles', compact('roles'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }
    public function viewPermissions(Request $request)
    {
        try {
            $permissions = Permission::all();
            return view('admin.view-permissions', compact('permissions'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

}
