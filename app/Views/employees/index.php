<?= $this->extend('employees/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Employee List</h2>
    <a href="<?= base_url('employees/create') ?>" class="btn btn-primary">+ Add New Employee</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
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
                        <td colspan="6" class="text-center text-muted py-3">No employees found. Click "Add New Employee" to populate directory.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>