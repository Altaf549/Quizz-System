<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Category::query();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-sm edit-category" data-id="' . $row->id . '">
                            <i class="fas fa-edit fa-lg text-warning"></i>
                        </button>
                        <button type="button" class="btn btn-sm delete-category" data-id="' . $row->id . '">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('image', function($row) {
                    if ($row->image) {
                        return asset($row->image);
                    }
                    return '<span class="text-muted">No Image</span>';
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
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/categories'), $imageName);
                $validated['image'] = 'images/categories/' . $imageName;
            }

            $category = Category::create($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category created successfully.',
                    'data' => $category
                ]);
            }

            return redirect()->route('dashboard.categories.index')
                ->with('success', 'Category created successfully.');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating category: ' . $e->getMessage()
                ], 422);
            }

            return back()->with('error', 'Error creating category')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Request $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->status = $category->status === 'active' ? 'inactive' : 'active';
            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'status' => $category->status
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
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $category = Category::findOrFail($id);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($category->image) {
                    $oldImagePath = public_path($category->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/categories'), $imageName);
                $validated['image'] = 'images/categories/' . $imageName;
            }

            $category->update($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category updated successfully.',
                    'data' => $category
                ]);
            }

            return redirect()->route('dashboard.categories.index')
                ->with('success', 'Category updated successfully.');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating category: ' . $e->getMessage()
                ], 422);
            }

            return back()->with('error', 'Error updating category')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
