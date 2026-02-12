<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Catalogue Produits - Statique</title>
    <link rel="stylesheet" href="/assets/css/main-QD_VOj1Y.css">
    
    <style>
        .product-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 12px;
            overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .product-img-container {
            height: 180px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .product-img-container i {
            font-size: 3rem;
            color: #cbd5e1;
        }
        .price-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 700;
            color: #6366f1;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .description-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 0.9rem;
            color: #64748b;
        }
    </style>
</head>

<body class="admin-layout">
    <div class="admin-wrapper" id="admin-wrapper">
        
        <!--header class="admin-header d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
            <button class="btn btn-link p-0" id="sidebar-toggle">
                <i class="bi bi-list fs-3"></i>
            </button>
            <div class="user-profile d-flex align-items-center gap-2">
                <span class="fw-medium">Admin Mode</span>
                <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                    <i class="bi bi-person-fill text-primary"></i>
                </div>
            </div>
        </header-->
        <?php require_once("common/header.php") ?>
        <?php require_once("common/sidebar.php") ?>

        <main class="admin-main">
            <div class="container-fluid p-4 p-lg-5">
                
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h1 class="h3 mb-1">Mes Produits</h1>
                        <p class="text-muted small mb-0">Visualisation de vos articles en vente ou échange.</p>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="bi bi-plus-circle me-2"></i>Nouveau Produit
                    </button>
                </div>

                <div class="row g-4">
                    
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card product-card h-100 bg-white">
                            <div class="product-img-container">
                                <i class="bi bi-image"></i> <span class="price-badge">150.00 €</span>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Électronique</span>
                                </div>
                                <h6 class="card-title mb-2">Smartphone Galaxy S21</h6>
                                <p class="description-truncate">
                                    Excellent état, vendu avec chargeur d'origine. Écran sans aucune rayure.
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 d-flex gap-2 pb-3">
                                <button class="btn btn-sm btn-outline-primary flex-grow-1">Editer</button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card product-card h-100 bg-white">
                            <div class="product-img-container">
                                <i class="bi bi-image"></i>
                                <span class="price-badge">45.00 €</span>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge bg-success bg-opacity-10 text-success">Maison</span>
                                </div>
                                <h6 class="card-title mb-2">Lampe de bureau LED</h6>
                                <p class="description-truncate">
                                    Luminosité réglable, port USB intégré pour recharger votre téléphone.
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 d-flex gap-2 pb-3">
                                <button class="btn btn-sm btn-outline-primary flex-grow-1">Editer</button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card product-card h-100 bg-white">
                            <div class="product-img-container">
                                <i class="bi bi-image"></i>
                                <span class="price-badge">850.00 €</span>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge bg-warning bg-opacity-10 text-warning">Sport</span>
                                </div>
                                <h6 class="card-title mb-2">VTT Rockrider 520</h6>
                                <p class="description-truncate">
                                    Très peu utilisé, révision faite le mois dernier. Pneus neufs.
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 d-flex gap-2 pb-3">
                                <button class="btn btn-sm btn-outline-primary flex-grow-1">Editer</button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Détails du produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nom du produit</label>
                        <input type="text" class="form-control" placeholder="Nom">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label small fw-bold">Prix (€)</label>
                            <input type="number" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold">Catégorie</label>
                            <select class="form-select">
                                <option>Choisir...</option>
                                <option>Électronique</option>
                                <option>Maison</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Image</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea class="form-control" rows="3" placeholder="Description courte..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary px-4">Créer</button>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("footer/footer.php") ?>

    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', () => {
            document.getElementById('admin-wrapper').classList.toggle('sidebar-collapsed');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>