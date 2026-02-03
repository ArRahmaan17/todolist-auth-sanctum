<?php

namespace App\Http\Controllers;

use App\Models\lists as ModelsLists;
use Illuminate\Http\Request;

class Lists extends Controller
{
    public function index()
    {
        $todos = auth()->user()->todos()->latest()->get();
        return view('welcome', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        auth()->user()->todos()->create([
            'name' => $request->name,
            'is_done' => false,
        ]);

        return redirect()->route('lists')->with('success', 'Task created successfully!');
    }

    public function update(Request $request, $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        
        $request->validate(['name' => 'required']);
        
        $todo->update([
            'name' => $request->name,
            'is_done' => $request->has('is_done') ? $request->is_done : $todo->is_done,
        ]);

        return redirect()->route('lists')->with('success', 'Task updated successfully!');
    }
    
    public function toggle($id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo->update(['is_done' => !$todo->is_done]);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_done' => $todo->is_done,
                'message' => 'Status updated'
            ]);
        }

        return back();
    }

    public function destroy($id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo->delete();

        return redirect()->route('lists')->with('success', 'Task deleted successfully!');
    }
}
