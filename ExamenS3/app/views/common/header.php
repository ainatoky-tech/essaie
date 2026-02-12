<header class="admin-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/metis">
                <img src="/assets/images/logo.svg" alt="Logo" height="32" class="me-2">
                <h1 class="h4 mb-0 fw-bold text-primary">Metis</h1>
            </a>

            <div class="search-container flex-grow-1 mx-4">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Rechercher un produit..." id="main-search">
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <img src="/assets/images/avatar-placeholder.svg" width="24" height="24" class="rounded-circle me-2">
                    <span class="d-none d-md-inline">
                        <?php echo isset($_SESSION['utilisateur']['nom_utilisateur']) ? $_SESSION['utilisateur']['nom_utilisateur'] : 'Admin'; ?>
                    </span>
                    <i class="bi bi-chevron-down ms-1"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Mon Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>