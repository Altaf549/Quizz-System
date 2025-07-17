@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Category Management</h2>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
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
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created At</th>
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
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold fs-4" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addCategoryForm" method="POST" action="{{ route('dashboard.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold fs-6">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter category name">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold fs-6">Category Image (Optional)</label>
                        <div class="mb-3 d-flex align-items-center gap-3 flex-wrap">
                            <img id="imagePreview" class="rounded border border-2" style="max-width: 150px; max-height: 150px; display: none;">
                            <div class="flex-grow-1">
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted d-block mt-2">Supported: jpg, jpeg, png, gif. Max size: 2MB</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-4 pb-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-lg" style="width: 200px;">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold fs-4" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold fs-6">Category Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required placeholder="Enter category name">
                    </div>

                    <div class="mb-3">
                        <label for="edit_image" class="form-label fw-semibold fs-6">Category Image (Optional)</label>
                        <div class="mb-3 d-flex align-items-center gap-3 flex-wrap">
                            <img id="editImagePreview" class="rounded border border-2" style="width: 120px; height: 120px; object-fit: cover; display: none;">
                            <div class="flex-grow-1">
                                <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                                <small class="text-muted d-block mt-2">Supported: jpg, jpeg, png, gif. Max size: 2MB</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 px-4 pb-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" style="width: 200px;">Update</button>
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
                <form id="deleteCategoryForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this category?')">Delete Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<style>
    .dataTables_filter {
        float: right;
        margin-bottom: 1rem;
    }

    .dataTables_filter label {
        font-weight: 500;
    }

    .dataTables_filter input {
        border-radius: 0.375rem; /* rounded corners */
        padding: 0.5rem 0.75rem;
        border: 1px solid #ced4da;
        width: 250px;
        margin-left: 0.5rem;
    }
</style>
@endpush
@push('scripts')
<script>
$(document).ready(function() {
    // Initialize modals only once
    const addCategoryModal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
    const editCategoryModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));

    // Edit category button click handler
    $(document).on('click', '.edit-category', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ route('dashboard.categories.show', ['category' => ':id']) }}'.replace(':id', id),
            method: 'GET',
            success: function(response) {
                $('#edit_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_status').val(response.status);
                editCategoryModal.show();
            }
        });
    });
    
    // Image preview functionality
    $('#image').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('.image-preview-container').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#imagePreview').attr('src', '');
            $('.image-preview-container').hide();
        }
    });
    
    // Reset image preview when modal is closed
    $('#addCategoryModal').on('hidden.bs.modal', function () {
        $('#imagePreview').attr('src', '');
        $('.image-preview-container').hide();
        $('#image').val('');
    });

    // Handle add category form submission
    $('#addCategoryForm').on('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        $(this).find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    addCategoryModal.hide();
                    $('#addCategoryForm')[0].reset();
                    $('#categoriesTable').DataTable().ajax.reload();
                    toastr.success('Category created successfully.');
                } else {
                    toastr.error('Error creating category.');
                }
            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });
                    toastr.error(errorMessage);
                } else {
                    toastr.error('An error occurred. Please try again.');
                }
            },
            complete: function() {
                // Reset button state
                $('#addCategoryForm').find('button[type="submit"]').prop('disabled', false).html('Save Category');
            }
        });
    });
    // Initialize DataTable first
    let table = $('#categoriesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.categories.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            {
                data: 'image',
                name: 'image',
                render: function(data) {
                    if (data) {
                        return '<img src="' + data + '" alt="Image" style="max-height: 50px;">';
                    }
                    return 'No image';
                },
                orderable: false,
                searchable: false
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    return moment(data).format('DD MMM YYYY, HH:mm');
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    $(document).on('click', '.status-toggle', function() {
        const id = $(this).data('id');
        const status = $(this).data('status');
        // Your AJAX call to toggle the status
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
                
                // Show old image if exists
                if (response.image) {
                    // Prepend base URL to image path
                    let imageUrl = '{{ url('/') }}/' + response.image;
                    $('#editImagePreview').attr('src', imageUrl);
                    $('#editImagePreview').show();
                }
                
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
        let formData = new FormData(this);

        $.ajax({
            url: '{{ route('dashboard.categories.update', ['category' => ':id']) }}'.replace(':id', id),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#editCategoryModal').modal('hide');
                    $('#categoriesTable').DataTable().ajax.reload();
                    toastr.success(response.message);
                } else {
                    toastr.error('Failed to update category');
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    let errorMessages = Object.values(errors).flat();
                    toastr.error(errorMessages.join('<br>'));
                } else {
                    toastr.error('An error occurred while updating the category');
                }
            }
        });
    });
});
</script>
@endpush
