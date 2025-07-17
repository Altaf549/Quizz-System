@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Quiz Management</h2>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuizModal">
                        <i class="fas fa-plus"></i> Add Quiz
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="quizzesTable" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Time (mins)</th>
                            <th>Description</th>
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

<!-- Add Quiz Modal -->
<div class="modal fade" id="addQuizModal" tabindex="-1" aria-labelledby="addQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold fs-4" id="addQuizModalLabel">Add New Quiz</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addQuizForm" method="POST" action="{{ route('dashboard.quizzes.store') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-semibold fs-6">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold fs-6">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required placeholder="Enter quiz title">
                    </div>

                    <div class="mb-3">
                        <label for="time" class="form-label fw-semibold fs-6">Time (minutes)</label>
                        <input type="number" class="form-control" id="time" name="time" required min="1" placeholder="Enter quiz duration">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold fs-6">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Enter quiz description"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-4 pb-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-lg" style="width: 200px;">Save Quiz</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Quiz Modal -->
<div class="modal fade" id="editQuizModal" tabindex="-1" aria-labelledby="editQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold fs-4" id="editQuizModalLabel">Edit Quiz</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editQuizForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <input type="hidden" id="edit_id" name="id">
                    
                    <div class="mb-3">
                        <label for="edit_category_id" class="form-label fw-semibold fs-6">Category</label>
                        <select name="category_id" id="edit_category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_title" class="form-label fw-semibold fs-6">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required placeholder="Enter quiz title">
                    </div>

                    <div class="mb-3">
                        <label for="edit_time" class="form-label fw-semibold fs-6">Time (minutes)</label>
                        <input type="number" class="form-control" id="edit_time" name="time" required min="1" placeholder="Enter quiz duration">
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label fw-semibold fs-6">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="4" required placeholder="Enter quiz description"></textarea>
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
<div class="modal fade" id="deleteQuizModal" tabindex="-1" aria-labelledby="deleteQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteQuizModalLabel">Delete Quiz</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete this quiz? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <form id="deleteQuizForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Quiz</button>
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
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid #ced4da;
        width: 250px;
        margin-left: 0.5rem;
    }

    /* Custom switch colors */
    .form-check-input.status-toggle:checked {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }
    
    .form-check-input.status-toggle {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#quizzesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('dashboard.quizzes.index') }}",
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            error: function(xhr, error, thrown) {
                console.error('DataTables Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Error loading quiz data. Please try refreshing the page.');
            }
        },
        columns: [
            { 
                data: 'DT_RowIndex', 
                name: 'DT_RowIndex', 
                orderable: false, searchable: false 
            },
            { 
                data: 'title', 
                name: 'title' 
            },
            {
                data: 'category.name',
                name: 'category.name',
                render: function(data) {
                    return data || 'No category';
                }
            },
            {
                data: 'time',
                name: 'time',
                render: function(data) {
                    return data + ' minutes';
                }
            },
            { 
                data: 'description', 
                name: 'description' 
            },
            {
                data: 'status',
                name: 'status',
                render: function(data) {
                    return data === 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                }
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

    // Initialize modals only once
    const addQuizModal = new bootstrap.Modal(document.getElementById('addQuizModal'));
    const editQuizModal = new bootstrap.Modal(document.getElementById('editQuizModal'));
    const deleteQuizModal = new bootstrap.Modal(document.getElementById('deleteQuizModal'));

    // Edit quiz button click handler
    $(document).on('click', '.edit-quiz', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ route('dashboard.quizzes.show', ['quiz' => ':id']) }}'.replace(':id', id),
            method: 'GET',
            success: function(response) {
                $('#edit_id').val(response.id);
                $('#edit_category_id').val(response.category_id);
                $('#edit_title').val(response.title);
                $('#edit_time').val(response.time);
                $('#edit_description').val(response.description);
                $('#edit_status').val(response.status);
                editQuizModal.show();
            }
        });
    });

    // Delete quiz button click handler
    $(document).on('click', '.delete-quiz', function() {
        let id = $(this).data('id');
        let url = '{{ route('dashboard.quizzes.destroy', ['quiz' => ':id']) }}'.replace(':id', id);
        $('#deleteQuizForm').attr('action', url);
        deleteQuizModal.show();
    });

    // Status toggle handler
    $(document).on('change', '.status-toggle', function(e) {
        e.preventDefault();
        
        const input = $(this);
        const id = input.data('id');
        const currentStatus = input.data('status');
        const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

        $.ajax({
            url: '{{ route('dashboard.quizzes.toggleStatus', ['quiz' => ':id']) }}'.replace(':id', id),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                input.data('status', newStatus);
                toastr.success(response.message);
                table.ajax.reload();
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message);
            }
        });
    });

    // Form submissions
    $('#addQuizForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                toastr.success(response.message);
                addQuizModal.hide();
                table.ajax.reload();
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message);
            }
        });
    });

    $('#editQuizForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let id = $('#edit_id').val();
        let url = '{{ route('dashboard.quizzes.update', ['quiz' => ':id']) }}'.replace(':id', id);

        $.ajax({
            url: url,
            method: 'PUT',
            data: formData,
            success: function(response) {
                toastr.success(response.message);
                editQuizModal.hide();
                table.ajax.reload();
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message);
            }
        });
    });

    // Delete form submission
    $('#deleteQuizForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'DELETE',
            data: $(this).serialize(),
            success: function(response) {
                toastr.success(response.message);
                deleteQuizModal.hide();
                table.ajax.reload();
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message);
            }
        });
    });
});
</script>
@endpush
