<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        return Topic::all();
    }

    public function store(Request $request)
    {
    }

    public function show(Topic $topic): Topic
    {
        return $topic;
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return response(null, 204);
    }
}
