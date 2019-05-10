<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaneController extends Controller
{
    public function create()
    {
        $this->authorize('create', Plane::class);

        $plane = new Plane;
        return view('plane.add', compact('user'));
    }
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $plane = new plane();
        $plane->fill($request->all());
        $plane->save();

        return redirect()
            ->route('plane.index')
            ->with('success', 'Plane added successfully!');
    }

    public function destroy(User $user,Plane $plane)
    {
        $this->authorize('delete', $user);

        $plane->delete();
        return redirect()
            ->route('Planes.index')
            ->with('success', 'Plane deleted successfully!');
    }
    public function update(Request $request, User $user,Plane $plane)
    {
        $this->authorize('update', $user);
        $plane->fill($request->validated());
        $plane->save();

        return redirect()
            ->route('planes.index')
            ->with('success', 'Plane updated successfully!');
    }

}
