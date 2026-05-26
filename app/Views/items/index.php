<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Lost & Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Campus Lost & Found</h1>
        <a href="<?= site_url('items/create') ?>" class="btn btn-primary">Post Item</a>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= esc((string) session()->getFlashdata('message')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc((string) session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-body">
            <form method="get" action="<?= site_url('items') ?>" class="row g-2">
                <div class="col-md-6">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search title, description, or location"
                        value="<?= esc((string) ($keyword ?? '')) ?>"
                    >
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="lost" <?= (($type ?? '') === 'lost') ? 'selected' : '' ?>>Lost</option>
                        <option value="found" <?= (($type ?? '') === 'found') ? 'selected' : '' ?>>Found</option>
                    </select>
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Posted</th>
                </tr>
                </thead>
                <tbody>
                <?php if (! empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= esc((string) $item['id']) ?></td>
                            <td>
                                <span class="badge <?= $item['type'] === 'lost' ? 'text-bg-danger' : 'text-bg-success' ?>">
                                    <?= esc(ucfirst((string) $item['type'])) ?>
                                </span>
                            </td>
                            <td><?= esc((string) $item['title']) ?></td>
                            <td><?= esc((string) $item['location']) ?></td>
                            <td><?= ! empty($item['photo']) ? 'Yes' : 'No' ?></td>
                            <td><?= esc(ucfirst((string) $item['status'])) ?></td>
                            <td><?= esc((string) $item['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">No items found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <?= $pager->links() ?>
    </div>
</div>
</body>
</html>
