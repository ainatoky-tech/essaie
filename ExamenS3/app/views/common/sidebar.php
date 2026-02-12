<aside class="admin-sidebar" id="admin-sidebar">
            <div class="sidebar-content">
                <nav class="sidebar-nav">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="/metis">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/analytics">
                                <i class="bi bi-graph-up"></i>
                                <span>Analytics</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/products">
                                <i class="bi bi-box"></i>
                                <span>Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/orders">
                                <i class="bi bi-bag-check"></i>
                                <span>Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/forms">
                                <i class="bi bi-ui-checks"></i>
                                <span>Forms</span>
                                <span class="badge bg-success rounded-pill ms-auto">New</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reports">
                                <i class="bi bi-file-earmark-text"></i>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/messages">
                                <i class="bi bi-chat-dots"></i>
                                <span>Messages</span>
                                <span class="badge bg-danger rounded-pill ms-auto">3</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/calendar">
                                <i class="bi bi-calendar-event"></i>
                                <span>Calendar</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/files">
                                <i class="bi bi-folder2-open"></i>
                                <span>Files</span>
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <small class="text-muted px-3 text-uppercase fw-bold">Admin</small>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/settings">
                                <i class="bi bi-gear"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/security">
                                <i class="bi bi-shield-check"></i>
                                <span>Security</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/help">
                                <i class="bi bi-question-circle"></i>
                                <span>Help & Support</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Floating Hamburger Menu -->
            <button class="hamburger-menu" 
                    type="button" 
                    data-sidebar-toggle
                    aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.querySelector('[data-sidebar-toggle]');
    const wrapper = document.getElementById('admin-wrapper');

        if (toggleBtn && wrapper) {
            toggleBtn.addEventListener('click', (e) => {
                e.preventDefault();
                wrapper.classList.toggle('sidebar-collapsed');
                
                // On change l'icône du bouton (optionnel)
                const icon = toggleBtn.querySelector('i');
                if(wrapper.classList.contains('sidebar-collapsed')) {
                    icon.classList.replace('bi-list', 'bi-arrow-right');
                } else {
                    icon.classList.replace('bi-arrow-right', 'bi-list');
                }
            });
        }
    });
</script>
<style>
    /* Transition douce pour le contenu principal */
.admin-main {
    transition: margin-left 0.3s ease;
}

/* Quand la sidebar est réduite */
.sidebar-collapsed .admin-sidebar {
    width: 70px; /* Largeur réduite */
}

.sidebar-collapsed .admin-main {
    margin-left: 70px; /* Le contenu prend plus de place */
}

/* On cache le texte des liens et les badges quand c'est réduit */
.sidebar-collapsed .admin-sidebar span, 
.sidebar-collapsed .admin-sidebar .badge,
.sidebar-collapsed .admin-sidebar small {
    display: none;
}

/* On centre les icônes quand la barre est réduite */
.sidebar-collapsed .nav-link {
    text-align: center;
    padding: 10px 0;
}

.sidebar-collapsed .nav-link i {
    margin-right: 0 !important;
    font-size: 1.5rem;
}
</style>