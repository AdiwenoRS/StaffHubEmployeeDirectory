<?= $this->extend('employees/layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add New Employee</h5>
            </div>
            <div class="card-body">
                
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('employees/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-value form-control" value="<?= old('name') ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control" value="<?= old('department') ?>" placeholder="e.g. IT, HR, Marketing">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control" value="<?= old('position') ?>" placeholder="e.g. Developer, Lead Accountant">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('employees') ?>" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Save Employee</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>