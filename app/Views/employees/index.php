<?= $this->extend('employees/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Employee Directory Dashboard</h2>
    <a href="<?= base_url('employees/create') ?>" class="btn btn-primary">+ Add New Employee</a>
</div>

<div class="card mb-4 shadow-sm bg-white">
    <div class="card-body">
        <form action="<?= base_url('employees') ?>" method="GET" class="row g-3">
            
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="<?= esc($search ?? '') ?>">
            </div>
            
            <div class="col-md-4">
                <select name="department" class="form-select">
                    <option value="">All Departments</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= esc($dept) ?>" <?= (isset($selected_dept) && $selected_dept == $dept) ? 'selected' : '' ?>>
                            <?= esc($dept) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-dark w-100">Filter</button>
                <a href="<?= base_url('employees') ?>" class="btn btn-outline-secondary w-100">Reset</a>
            </div>

        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($employees) && is_array($employees)): ?>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?= $employee['id'] ?></td>
                            <td><strong><?= esc($employee['name']) ?></strong></td>
                            <td><?= esc($employee['email']) ?></td>
                            <td><span class="badge bg-secondary"><?= esc($employee['department']) ?></span></td>
                            <td><?= esc($employee['position']) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('employees/edit/' . $employee['id']) ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                                <a href="<?= base_url('employees/delete/' . $employee['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No records found matching your active criteria.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    <?php if ($pager): ?>
        <?= $pager->links() ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>