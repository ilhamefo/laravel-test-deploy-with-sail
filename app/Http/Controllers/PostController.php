<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // $post = Post::paginate(5);

        $results = null;

        $users = User::all();

        if ($query = $request->get('query')) {
            /**
             * you can do this way,
             *
             * $results = Post::search($query)->where('published', true)->get();
             *
             * or just use shouldBeSearchable()
             * function in the model
             */

            $results = Post::search($query, function ($meilisearch, $query, $options) use ($request) {

                if ($userId = $request->get('user_id')) {
                    $options['filters'] = 'user_id=' . $userId;
                }

                return $meilisearch->search($query, $options);
            })->paginate(10)
                ->withQueryString();
        }

        return view('search', [
            'results' => $results,
            'users' => $users,
        ]);
    }

    public function search(Request $request)
    {
        $results = null;

        $users = User::all();

        if (!$query = $request->get('query')) {
            return $results;
        }

        $results = Post::search($query, function ($meilisearch, $query, $options) use ($request) {

            if ($userId = $request->get('user_id')) {
                $options['filters'] = 'user_id=' . $userId;
            }

            return $meilisearch->search($query, $options);
        })->paginate(10);

        return response()->json($results, 200);
    }
}
