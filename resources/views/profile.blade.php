@extends('layouts.master')
@push('plugin-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/animate/animate.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">
@endpush
@push('custom-styles')
@endpush
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="app-user-view-account">
                    <div class="row justify-content-center">
                        <!-- User Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2" src="{{(Auth::user()->image == NULL) ? '/default.jpg' : '/images/'.Auth::user()->image}}" height="110" width="110" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h4>{{Auth::user()->name}}</h4>
                                                <span class="badge bg-light-secondary">{{Auth::user()->role}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Email:</span>
                                                <span>{{Auth::user()->email}}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Status:</span>
                                                <span class="badge bg-light-success">{{Auth::user()->statu}}</span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="d-flex justify-content-center pt-2">
                                        <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                                            Edit
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /User Card -->
                        </div>
                    </div>
                </section>
                <!-- Edit User Modal -->
                <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pb-5 px-sm-5 pt-50">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">Modification de Password</h1>
                                    
                                </div>
                                <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="oldPassword">Ancien Password</label>
                                        <input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder="Ancien Password" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="newPassword">Nouveau Password</label>
                                        <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="Nouveau Password" />
                                    </div>
                                    <div class="col-12 text-center mt-2 pt-50">
                                        <button type="submit" class="btn btn-primary me-1" id="editSubmit">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                            Discard
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Edit User Modal -->
            </div>
        </div>
    </div>
@endsection
@push('plugin-js')
<script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
@endpush
@push('custom-js')
<script>
$(function () {
    const editUserForm = $('#editUserForm');
  
  console.log(editUserForm);
    // Edit user form validation
    if (editUserForm.length) {
        $('#editSubmit').on('click',function() {
        var oldpass = $('#oldPassword').val();
        var newpass = $('#newPassword').val();
        var id = {!! json_encode(Auth::user()->id) !!}
        if (true) {
          $.ajax({
            type : 'post',
            url : '{{route('users.modifyPassword')}}',
            data : {
                '_token' : '{{csrf_token()}}',
                id : id,
                newpass : newpass,
                oldpass : oldpass
            },
            success : function (res) {
                console.log(res);
                Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: res,
                customClass: {
                confirmButton: 'btn btn-success'
                }
              });
              $('#editUser').modal('hide');
            },
            error : function() {
                Swal.fire({
                    title: 'Failed',
                    text: 'Operation Failed',
                    icon: 'error',
                    customClass: {
                    confirmButton: 'btn btn-success'
                    }
                });
                $('#editUser').modal('hide');
            }
          })

        }
        });
    }
  });
  </script>
@endpush