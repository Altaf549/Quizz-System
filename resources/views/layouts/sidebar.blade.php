<!-- Sidebar -->
<div class="sidebar bg-white shadow-sm">
    <div class="sidebar-header bg-primary text-white p-3">
        <h5 class="mb-0">Quiz Management</h5>
    </div>
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard.categories.*') ? 'active' : '' }}" href="{{ route('dashboard.categories.index') }}">
                    <i class="fas fa-folder me-2"></i> Manage Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard.quizzes.*') ? 'active' : '' }}" href="{{ route('dashboard.quizzes.index') }}">
                    <i class="fas fa-question-circle me-2"></i> Manage Quizzes
                </a>
            </li>
        </ul>
    </nav>
</div>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .sidebar-header {
        border-bottom: 1px solid #e2e8f0;
    }

    .sidebar-nav {
        padding: 1rem;
    }

    .nav-link {
        color: #4a5568;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .nav-link:hover {
        background-color: #f7fafc;
        color: #2d3748;
    }

    .nav-link.active {
        background-color: #e2e8f0;
        color: #2d3748;
    }

    .nav-link i {
        width: 20px;
    }
</style>
