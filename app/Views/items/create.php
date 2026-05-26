<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Item - Campus Lost & Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Post Lost/Found Item</h1>
        <a href="<?= site_url('items') ?>" class="btn btn-outline-secondary">Back to List</a>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <strong>Please fix the following:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ((array) session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc((string) $error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= site_url('items') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="type" class="form-label">Type</label>
                        <select id="type" name="type" class="form-select" required>
                            <option value="lost" <?= old('type', 'lost') === 'lost' ? 'selected' : '' ?>>Lost</option>
                            <option value="found" <?= old('type') === 'found' ? 'selected' : '' ?>>Found</option>
                        </select>
                    </div>

                    <div class="col-md-8">
                        <label for="title" class="form-label">Title</label>
                        <input
                            id="title"
                            type="text"
                            name="title"
                            class="form-control"
                            value="<?= esc((string) old('title')) ?>"
                            maxlength="200"
                            required
                        >
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            rows="4"
                            maxlength="5000"
                        ><?= esc((string) old('description')) ?></textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="category" class="form-label">Category</label>
                        <input
                            id="category"
                            type="text"
                            name="category"
                            class="form-control"
                            value="<?= esc((string) old('category')) ?>"
                            maxlength="100"
                        >
                    </div>

                    <div class="col-md-4">
                        <label for="location" class="form-label">Location</label>
                        <input
                            id="location"
                            type="text"
                            name="location"
                            class="form-control"
                            value="<?= esc((string) old('location')) ?>"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="col-md-4">
                        <label for="date_occurred" class="form-label">Date Occurred</label>
                        <input
                            id="date_occurred"
                            type="date"
                            name="date_occurred"
                            class="form-control"
                            value="<?= esc((string) old('date_occurred')) ?>"
                        >
                    </div>

                    <div class="col-md-4">
                        <label for="contact_name" class="form-label">Contact Name</label>
                        <input
                            id="contact_name"
                            type="text"
                            name="contact_name"
                            class="form-control"
                            value="<?= esc((string) old('contact_name')) ?>"
                            maxlength="100"
                            required
                        >
                    </div>

                    <div class="col-md-4">
                        <label for="contact_email" class="form-label">Contact Email</label>
                        <input
                            id="contact_email"
                            type="email"
                            name="contact_email"
                            class="form-control"
                            value="<?= esc((string) old('contact_email')) ?>"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="col-md-4">
                        <label for="contact_phone" class="form-label">Contact Phone</label>
                        <input
                            id="contact_phone"
                            type="text"
                            name="contact_phone"
                            class="form-control"
                            value="<?= esc((string) old('contact_phone')) ?>"
                            maxlength="50"
                        >
                    </div>

                    <div class="col-12">
                        <label for="photo_file" class="form-label">Photo (optional)</label>
                        <input
                            id="photo_file"
                            type="file"
                            name="photo_file"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp,.gif,image/jpeg,image/png,image/webp,image/gif"
                        >
                        <div class="form-text">Allowed: JPG, PNG, WEBP, GIF. Maximum size: 2 MB.</div>
                    </div>

                    <div class="col-12 d-grid d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary px-4">Submit Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
