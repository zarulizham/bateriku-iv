<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate();

        \Log::info([
            'message' => 'Showing list of all users.',
        ]);

        return response()->json([
            'users' => $users
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info([
            'message' => 'Showing form to create a new user.',
        ]);

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $user = User::create($request->safe()->toArray());

        $data = [
            'user' => $user,
            'message' => __('User successfully created'),
        ];

        \Log::info($data);

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        \Log::info([
            'user' => $user,
            'message' => 'Showing details for user #' . $user->id,
        ]);

        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        \Log::info([
            'user' => $user,
            'message' => 'Showing form to edit user #' . $user->id,
        ]);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->safe()->toArray());

        $data = [
            'user' => $user,
            'message' => __('User successfully updated.'),
        ];

        \Log::info($data);

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'user' => $user,
            'message' => __('User successfully deleted.')
        ], 200);
    }
}
