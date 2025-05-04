<?php
session_start();
require_once('../classes/Database.php');
require_once('../controllers/ServiceController.php');

// Check if already logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Set a variable to indicate we are authenticated (for sidebar include)
$isAdminLoggedIn = true;
$activePage = 'services';

// DB connection
$db = (new Database())->connect();

// Create a new instance of the ServiceController
$controller = new ServiceController($db);

$message = '';
$message_type = '';



// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new service
    if (isset($_POST['add_service'])) {
        $service_name = trim($_POST['service_name']);
        $description = trim($_POST['description']);
        $price = floatval($_POST['price']);
        $duration = intval($_POST['duration']);
        
        // Handle file upload for service image
        $image_path = null;
        if (isset($_FILES['service_image']) && $_FILES['service_image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/services/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $file_name = time() . '_' . basename($_FILES['service_image']['name']);
            $target_file = $upload_dir . $file_name;
            
            if (move_uploaded_file($_FILES['service_image']['tmp_name'], $target_file)) {
                $image_path = 'uploads/services/' . $file_name;
            }
        }
        
        // Pass data as an associative array
        $serviceData = [
            'service_name' => $service_name,
            'description' => $description,
            'price' => $price,
            'duration' => $duration,
            'image_path' => $image_path
        ];

        if ($controller->addService($serviceData)) {
            $message = 'Service added successfully!';
            $message_type = 'success';
        } else {
            $message = 'Failed to add service.';
            $message_type = 'danger';
        }
    }
    
    // Update existing service
    elseif (isset($_POST['update_service'])) {
        $service_id = intval($_POST['service_id']);
        $service_name = trim($_POST['service_name']);
        $description = trim($_POST['description']);
        $price = floatval($_POST['price']);
        $duration = intval($_POST['duration']);
        $status = isset($_POST['status']) ? 1 : 0;
        
        // Handle file upload for service image
        $image_path = $_POST['current_image'];
        if (isset($_FILES['service_image']) && $_FILES['service_image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/services/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $file_name = time() . '_' . basename($_FILES['service_image']['name']);
            $target_file = $upload_dir . $file_name;
            
            if (move_uploaded_file($_FILES['service_image']['tmp_name'], $target_file)) {
                // Delete old image if exists and different
                if ($image_path && file_exists('../' . $image_path)) {
                    unlink('../' . $image_path);
                }
                $image_path = 'uploads/services/' . $file_name;
            }
        }
        
        $serviceData = [
            'service_name' => $service_name,
            'description' => $description,
            'price' => $price,
            'duration' => $duration,
            'image_path' => $image_path,
            'status' => $status
        ];

        if ($controller->updateService($service_id, $serviceData)) {
            $message = 'Service updated successfully!';
            $message_type = 'success';
        } else {
            $message = 'Failed to update service.';  
            $message_type = 'danger';
        }
    }
    
    // Delete service
    elseif (isset($_POST['delete_service'])) {
        $service_id = intval($_POST['service_id']);
        $service = $controller->getServiceById($service_id);
        
        if ($controller->deleteService($service_id)) {
            // Delete service image if exists
            if ($service['image_path'] && file_exists('../' . $service['image_path'])) {
                unlink('../' . $service['image_path']);
            }
            
            $message = 'Service deleted successfully!';
            $message_type = 'success';
        } else {
            $message = 'Failed to delete service.';
            $message_type = 'danger';
        }
    }
}

// Get all services
$services = $controller->getAllServices();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services | Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-content {
            min-height: 100vh;
        }
        
        .page-header {
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 2rem;
        }
        
        .service-card {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .service-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .service-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }
        
        .service-status {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .card-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .price-badge {
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .duration-badge {
            font-size: 0.85rem;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }
        
        .preview-image {
            max-height: 150px;
            max-width: 100%;
            border-radius: 5px;
        }
        
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        
        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }
        
        /* DataTables customization */
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            padding: 0.375rem 1.25rem 0.375rem 0.75rem;
        }
        
        div.dataTables_wrapper div.dataTables_filter input {
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
        }
        
        .dataTables_info, .page-link {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<div class="content-wrapper">
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-0">
                <?php include_once('includes/sidebar.php'); ?>
            </div>

            <!-- Main content -->
            <div class="col-md-9 col-lg-10 main-content p-4">
                <div class="page-header d-flex justify-content-between align-items-center">
                    <h2>Manage Services</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                        <i class="fas fa-plus me-2"></i>Add New Service
                    </button>
                </div>
                
                <?php if ($message): ?>
                    <div class="alert alert-<?= $message_type ?> alert-dismissible fade show" role="alert">
                        <?= $message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <!-- Service Listing -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table id="servicesTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Service Name</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?= $service['id'] ?></td>
                                    <td>
                                        <?php if ($service['image_path']): ?>
                                            <img src="../<?= $service['image_path'] ?>" alt="<?= $service['name'] ?>" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light text-center" style="width: 60px; height: 40px; line-height: 40px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $service['name'] ?></td>
                                    <td>₱<?= number_format($service['price'], 2) ?></td>
                                    <td><?= $service['duration'] ?> min</td>
                                    <td>
                                        <?php if ($service['status'] == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-info action-btn view-service" 
                                                data-id="<?= $service['id'] ?>"
                                                data-name="<?= htmlspecialchars($service['name']) ?>"
                                                data-description="<?= htmlspecialchars($service['description']) ?>"
                                                data-price="<?= $service['price'] ?>"
                                                data-duration="<?= $service['duration'] ?>"
                                                data-image="<?= $service['image_path'] ? '../' . $service['image_path'] : '' ?>"
                                                data-status="<?= $service['status'] ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-primary action-btn edit-service" 
                                                data-id="<?= $service['id'] ?>"
                                                data-name="<?= htmlspecialchars($service['name']) ?>"
                                                data-description="<?= htmlspecialchars($service['description']) ?>"
                                                data-price="<?= $service['price'] ?>"
                                                data-duration="<?= $service['duration'] ?>"
                                                data-image="<?= $service['image_path'] ?>"
                                                data-status="<?= $service['status'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-danger action-btn delete-service" 
                                                data-id="<?= $service['id'] ?>"
                                                data-name="<?= htmlspecialchars($service['name']) ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="service_name" class="form-label">Service Name *</label>
                                    <input type="text" class="form-control" id="service_name" name="service_name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price (Peso) *</label>
                                            <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Duration (minutes) *</label>
                                            <input type="number" step="1" min="0" class="form-control" id="duration" name="duration" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="service_image" class="form-label">Service Image</label>
                                    <input type="file" class="form-control" id="service_image" name="service_image" accept="image/*" onchange="previewImage(this, 'add-image-preview')">
                                    <div class="mt-2 text-center">
                                        <img id="add-image-preview" class="img-fluid preview-image d-none" alt="Service Preview">
                                        <div id="add-image-placeholder" class="border rounded p-4 d-flex align-items-center justify-content-center" style="height: 150px;">
                                            <span class="text-muted">Upload Image</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_service" class="btn btn-primary">Add Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="edit_service_id" name="service_id">
                        <input type="hidden" id="current_image" name="current_image">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="edit_service_name" class="form-label">Service Name *</label>
                                    <input type="text" class="form-control" id="edit_service_name" name="service_name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="edit_description" class="form-label">Description</label>
                                    <textarea class="form-control" id="edit_description" name="description" rows="4"></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_price" class="form-label">Price (Peso) *</label>
                                            <input type="number" step="0.01" min="0" class="form-control" id="edit_price" name="price" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_duration" class="form-label">Duration (minutes) *</label>
                                            <input type="number" step="1" min="0" class="form-control" id="edit_duration" name="duration" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="edit_status" name="status">
                                    <label class="form-check-label" for="edit_status">Active</label>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_service_image" class="form-label">Service Image</label>
                                    <input type="file" class="form-control" id="edit_service_image" name="service_image" accept="image/*" onchange="previewImage(this, 'edit-image-preview')">
                                    <div class="mt-2 text-center">
                                        <img id="edit-image-preview" class="img-fluid preview-image" alt="Service Preview">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_service" class="btn btn-primary">Update Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Service Modal -->
    <div class="modal fade" id="viewServiceModal" tabindex="-1" aria-labelledby="viewServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewServiceModalLabel">Service Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="text-center mb-3">
                                <img id="view-image" class="img-fluid rounded" alt="Service Image" style="max-height: 230px;">
                                <div id="no-image" class="d-none border rounded p-5 text-center">
                                    <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                    <p class="text-muted">No image available</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h4 id="view-name" class="mb-3"></h4>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span id="view-price" class="badge bg-primary p-2"></span>
                                <span id="view-duration" class="badge bg-secondary p-2"></span>
                                <span id="view-status"></span>
                            </div>
                            
                            <h6>Description:</h6>
                            <p id="view-description" class="text-muted"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Service Modal -->
    <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteServiceModalLabel">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this service: <strong id="delete-service-name"></strong>?</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <input type="hidden" id="delete_service_id" name="service_id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_service" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#servicesTable').DataTable({
                "order": [[0, "desc"]], // Sort by ID descending
                "pageLength": 10,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
            });
            
            // Edit Service Button Click
            $('.edit-service').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var description = $(this).data('description');
                var price = $(this).data('price');
                var duration = $(this).data('duration');
                var image = $(this).data('image');
                var status = $(this).data('status');
                
                $('#edit_service_id').val(id);
                $('#edit_service_name').val(name);
                $('#edit_description').val(description);
                $('#edit_price').val(price);
                $('#edit_duration').val(duration);
                $('#current_image').val(image);
                
                // Set checkbox based on status
                $('#edit_status').prop('checked', status == 1);
                
                // Show image preview if available
                if (image) {
                    $('#edit-image-preview').attr('src', '../' + image).removeClass('d-none');
                } else {
                    $('#edit-image-preview').addClass('d-none');
                }
                
                $('#editServiceModal').modal('show');
            });
            
            // View Service Button Click
            $('.view-service').on('click', function() {
                var name = $(this).data('name');
                var description = $(this).data('description');
                var price = $(this).data('price');
                var duration = $(this).data('duration');
                var image = $(this).data('image');
                var status = $(this).data('status');
                
                $('#view-name').text(name);
                $('#view-description').text(description ? description : 'No description available.');
                $('#view-price').text('$' + parseFloat(price).toFixed(2));
                $('#view-duration').text(duration + ' minutes');
                
                // Set status badge
                if (status == 1) {
                    $('#view-status').html('<span class="badge bg-success p-2">Active</span>');
                } else {
                    $('#view-status').html('<span class="badge bg-danger p-2">Inactive</span>');
                }
                
                // Show image if available
                if (image) {
                    $('#view-image').attr('src', image).removeClass('d-none');
                    $('#no-image').addClass('d-none');
                } else {
                    $('#view-image').addClass('d-none');
                    $('#no-image').removeClass('d-none');
                }
                
                $('#viewServiceModal').modal('show');
            });
            
            // Delete Service Button Click
            $('.delete-service').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                
                $('#delete_service_id').val(id);
                $('#delete-service-name').text(name);
                
                $('#deleteServiceModal').modal('show');
            });
        });
        
        // Function to preview image before upload
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById('add-image-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.setAttribute('src', e.target.result);
                    preview.classList.remove('d-none');
                    if (placeholder) {
                        placeholder.classList.add('d-none');
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.setAttribute('src', '');
                if (previewId === 'add-image-preview') {
                    preview.classList.add('d-none');
                    placeholder.classList.remove('d-none');
                }
            }
        }
    </script>
</body>
</html>