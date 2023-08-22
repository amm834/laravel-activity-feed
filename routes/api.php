<?php

use App\Models\Activity;
use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// user -> activityLogs -> action -> post -> user
//                                 -> comments -> user
//                                            -> replies -> user
Route::get('/', function () {
    $user = User::find(1)
        ->activityLogs()
        ->with([
            'action:id,name',
            'post' => [
                'user',
                'comments' => [
                    'user',
                    'replies' => [
                        'user',
                    ],
                ]
            ],
        ])
        ->withCount([
            'post',
        ])
        ->latest('id')
        ->get();


    return response()->json($user);
});
