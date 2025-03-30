
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.users'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.users'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('users.index')); ?>"> <?php echo app('translator')->get('trans..users'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.users'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-success btn-sm mb-3" title="Create User">
                            <i class="fa fa-plus" aria-hidden="true"></i> Create User
                        </a>
                        <div class="table-responsive">




                            <table class="table" id="datatable">
                                <thead>
                                    <tr>

                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>

                                            <td><?php echo e($user->email); ?></td>
                                            <td><?php echo e($user->roles->pluck('name')->join(', ')); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-warning">Edit</a>
                                                <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST"
                                                    style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <!-- DataTables  & Plugins -->
    <script src="<?php echo e(asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
    <script>
        $('#datatable').DataTable();
        $(document).on('click', '.delete', function(e) {

            var form = $(this).parents('form:first');

            var confirmed = false;

            e.preventDefault();

            swal({
                title: 'Are you sure want to delete?',
                text: "Onec Delete, This will be permanently delete!",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    // window.location.href = link;
                    confirmed = true;

                    form.submit();

                } else {
                    swal("Safe Data!");
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/users/index.blade.php ENDPATH**/ ?>