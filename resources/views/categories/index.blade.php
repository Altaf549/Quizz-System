@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Category Management</h2>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="categoriesTable" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>View Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addCategoryForm" method="POST" action="{{ route('dashboard.categories.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Category Name</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" required placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Status</label>
                        <select class="form-control form-control-lg" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-lg">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_name" class="font-weight-bold">Category Name</label>
                        <input type="text" class="form-control form-control-lg" id="edit_name" name="name" required placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                        <label for="edit_status" class="font-weight-bold">Status</label>
                        <select class="form-control form-control-lg" id="edit_status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info btn-lg">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h5 class="mb-3">Confirm Deletion</h5>
                    <p class="mb-0">Are you sure you want to delete this category? This action cannot be undone.</p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="deleteCategoryForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-lg">Delete Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addCategoryForm" method="POST" action="{{ route('dashboard.categories.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Category Name</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" required placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Status</label>
                        <select class="form-control form-control-lg" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-lg">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_name" class="font-weight-bold">Category Name</label>
                        <input type="text" class="form-control form-control-lg" id="edit_name" name="name" required placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                        <label for="edit_status" class="font-weight-bold">Status</label>
                        <select class="form-control form-control-lg" id="edit_status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info btn-lg">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h5 class="mb-3">Confirm Deletion</h5>
                    <p class="mb-0">Are you sure you want to delete this category? This action cannot be undone.</p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="deleteCategoryForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-lg">Delete Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    let table = $('#categoriesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('dashboard.categories.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    return data === 'active' ? 
                        '<span class="badge badge-success">Active</span>' : 
                        '<span class="badge badge-danger">Inactive</span>';
                }
            },
            { data: 'created_at', name: 'created_at' },
            { 
                data: 'id', 
                name: 'id',
                render: function(data, type, row) {
                    return '<a href="' + '{{ route('dashboard.categories.show', ['category' => ':id']) }}'.replace(':id', data) + '" class="btn btn-sm btn-info">View</a>';
                },
                orderable: false,
                searchable: false
            },
            { 
                data: 'action', 
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    // Edit category
    $(document).on('click', '.edit-category', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ route('dashboard.categories.show', ['category' => ':id']) }}'.replace(':id', id),
            method: 'GET',
            success: function(response) {
                $('#edit_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_status').val(response.status);
                $('#editCategoryModal').modal('show');
            }
        });
    });

    // Delete category
    $(document).on('click', '.delete-category', function() {
        let id = $(this).data('id');
        $('#deleteCategoryForm').attr('action', '{{ route('dashboard.categories.destroy', ['category' => ':id']) }}'.replace(':id', id));
        $('#deleteCategoryModal').modal('show');
    });

    // Update category form submission
    $('#editCategoryForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#edit_id').val();
        $(this).attr('action', '{{ route('dashboard.categories.update', ['category' => ':id']) }}'.replace(':id', id));
        this.submit();
    });
});
</script>
@endpush
