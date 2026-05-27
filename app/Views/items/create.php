<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Lost/Found Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Report an Item</h4>
                </div>
                <div class="card-body">
                    
                    <form action="<?= base_url('/items/store') ?>" method="POST" enctype="multipart/form-data">
                        
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Report Type</label>
                            <select name="type" class="form-select" required>
                                <option value="lost">I lost something</option>
                                <option value="found">I found something</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Item Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Blue Hydroflask" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Where was it lost/found?" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Name</label>
                            <input type="text" name="contact_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo (Optional)</label>
                            <input type="file" name="photo" class="form-control" accept="image/png, image/jpeg">
                        </div>

                        <button type="submit" class="btn btn-success w-100">Submit Report</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>