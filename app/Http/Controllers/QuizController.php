<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Category;
use Yajra\DataTables\DataTables;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Quiz::with('category')->select('id', 'title', 'category_id', 'time', 'description', 'status', 'created_at')->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-sm edit-quiz" data-id="' . $row->id . '">
                            <i class="fas fa-edit fa-lg text-warning"></i>
                        </button>
                        <button type="button" class="btn btn-sm delete-quiz" data-id="' . $row->id . '">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('status', function($row) {
                    $checked = $row->status === 'active' ? 'checked' : '';
                    $statusClass = $row->status === 'active' ? 'text-success' : 'text-danger';
                    
                    return '
                        <div class="form-check form-switch">
                            <input class="form-check-input status-toggle" 
                                   type="checkbox" 
                                   id="status_' . $row->id . '" 
                                   data-id="' . $row->id . '" 
                                   data-status="' . $row->status . '" 
                                   ' . $checked . '>
                        </div>';
                })
                ->addColumn('category.name', function($row) {
                    return $row->category ? $row->category->name : 'No category';
                })
                ->addColumn('time', function($row) {
                    return $row->time . ' minutes';
                })
                ->addColumn('created_at', function($row) {
                    return $row->created_at->format('DD MMM YYYY, HH:mm');
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        
        $categories = Category::all();
        return view('quizzes.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quizzes.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'title' => 'required|string|max:255',
                'time' => 'required|integer|min:1',
                'description' => 'required|string'
            ]);

            $quiz = Quiz::create($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Quiz created successfully.',
                    'data' => $quiz
                ]);
            }

            return redirect()->route('dashboard.quizzes.index')
                ->with('success', 'Quiz created successfully.');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating quiz: ' . $e->getMessage()
                ], 422);
            }

            return back()->with('error', 'Error creating quiz')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Quiz::findOrFail($id);
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Request $request, string $id)
    {
        try {
            $quiz = Quiz::findOrFail($id);
            $quiz->status = $quiz->status === 'active' ? 'inactive' : 'active';
            $quiz->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'status' => $quiz->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'title' => 'required|string|max:255',
                'time' => 'required|integer|min:1',
                'description' => 'required|string'
            ]);

            $quiz = Quiz::findOrFail($id);
            $quiz->update($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Quiz updated successfully.',
                    'data' => $quiz
                ]);
            }

            return redirect()->route('dashboard.quizzes.index')
                ->with('success', 'Quiz updated successfully.');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating quiz: ' . $e->getMessage()
                ], 422);
            }

            return back()->with('error', 'Error updating quiz')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $quiz = Quiz::findOrFail($id);
            $quiz->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Quiz deleted successfully.'
                ]);
            }

            return redirect()->route('dashboard.quizzes.index')
                ->with('success', 'Quiz deleted successfully.');

        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting quiz: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error deleting quiz');
        }
    }
}
