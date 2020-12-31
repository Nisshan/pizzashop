@extends('layouts.master')
@section('title', config('app.name'))
@section('content')

<header class="fixed-top">
    @include('partials.topHeader')
</header>

<section class="wrap px-4 mx-auto my-2 elevate-1 my-2">
    <div class="row h-100v">
        <div class="col-12 col-md-4 col-lg-3 p-3 text-center border-end">
            <div class="affix">
                <figure class="mb-0 position-relative img-170 mx-auto">
                    <img class="img-fluid img-170 rounded-circle obj-fit-cover"
                        src="https://www.jpal.co.jp/storage/profile/male.png">
                    <div class="change-profile-btn-container">
                        <div class="file-upload">
                            <i class="fa fa-pencil font-medium"></i>
                            <input type="file" id="userProfilePicture" name="myImage" accept="image/*" data-url="">
                        </div>
                    </div>
                </figure>
                <div class="mt-3">
                    <h4 class="font-weight-normal">User Name</h4>
                    <h6 class="fw-normal">189 Queen Street, Melbourne</h6>
                </div>
                <button type="button" class="btn btn-primary rounded-pill mb-3" data-bs-toggle="modal"
                    data-bs-target="#editProfileModal">
                    Edit Profile
                </button>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-9 pl-3">
            <div class="col-12 mb-3 p-0">
                <ul class="nav nav-tabs overflow-x" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 font-medium rounded-0 active"
                            id="recent-activity-tab" data-bs-toggle="tab" href="#recent-activity" role="tab"
                            aria-controls="recent-activity" aria-selected="true">
                            <i class="fa fa-history me-2 font-large"></i>
                            Previous Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 font-medium rounded-0" id="home-tab"
                            data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">
                            <i class="fa fa-user me-2 font-large"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 font-medium rounded-0" id="setting-tab"
                            data-bs-toggle="tab" href="#setting" role="tab" aria-controls="setting"
                            aria-selected="false">
                            <i class="fa fa-shield me-2 font-large"></i>
                            Change Password</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active" id="recent-activity" role="tabpanel"
                    aria-labelledby="recent-activity">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="elevate-1 rounded bg-white overflow-x">
                                <div class="px-3 py-3 border-bottom">
                                    <h5 class="mb-0">Recent Activity</h5>
                                </div>
                                <div class="px-3 py-3 d-flex align-items-center border-bottom">
                                    <table class="table overflow-x table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Item</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="d-flex">
                                                    <figure class="mb-0 me-2">
                                                        <img class="img-small obj-fit-cover rounded"
                                                            src="https://picsum.photos/800/800" alt="">
                                                    </figure>
                                                    <div>
                                                        <h6>Curry Veggie Delight</h6>
                                                        <h6 class="text-success font-small">
                                                            <span class="">Category:</span>
                                                            Pizza
                                                        </h6>
                                                    </div>
                                                </th>
                                                <td>$ 10.00</td>
                                                <td>10</td>
                                                <td>$ 100.00</td>
                                                <td>2020-10-12</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="elevate-1 rounded bg-white">
                                <div class="px-3 py-3 border-bottom">
                                    <h5 class="mb-0">Personal Information</h5>
                                </div>
                                <div class="px-3 py-3 d-flex align-items-center border-bottom">
                                    <div class="align-self-start mr-3">
                                        <i class="fa fa-user-circle me-2 font-large"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted">User Name</h6>
                                        <h6 class="mb-0">John Doe</h6>
                                    </div>
                                </div>
                                <div class="px-3 py-3 d-flex align-items-center border-bottom">
                                    <div class="align-self-start mr-3">
                                        <i class="fa fa-location-arrow me-2 font-large"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted">Location</h6>
                                        <h6 class="mb-0">189 Queen Street, Melbourne</h6>
                                    </div>
                                </div>
                                <div class="px-3 py-3 d-flex align-items-center">
                                    <div class="align-self-start mr-3">
                                        <i class="fa fa-phone me-2 font-large"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted">Contact</h6>
                                        <h6 class="mb-0">9801231132</h6>
                                    </div>
                                </div>
                                <div class="px-3 py-3 d-flex align-items-center">
                                    <div class="align-self-start mr-3">
                                        <i class="fa fa-envelope me-2 font-large"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted">Email Id</h6>
                                        <h6 class="mb-0">abc@gmail.com</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                    <div class="elevate-1 rounded">
                        <div class="px-3 py-3 mb-3 border-bottom">
                            <h5 class="mb-0">Change Password</h5>
                        </div>
                        <form class="col-12 mb-3" action="" method="post">
                            <div class="pb-3 px-3 mb-3 border-bottom">
                                <label for="currentPassword" class="form-label fw-bold">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" placeholder="Password"
                                    name="current_password" required="">
                            </div>
                            <div class="pb-3 px-3 mb-3 border-bottom">
                                <label for="newPassword" class="form-label fw-bold">New Password</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="New Password"
                                    required="" minlength="6" name="password">
                            </div>
                            <div class="pb-3 px-3 mb-3 border-bottom">
                                <label for="verifyPassword" class="form-label fw-bold">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="verifyPassword" placeholder="Confirm Password" required="" minlength="6">
                            </div>
                            <div class="px-3 pb-3 w-100 text-right">
                                <button type="submit" class="btn btn-primary mr-auto">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">
                        Edit Profile
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="profileUpdateForm">
                        <div class="mb-3">
                            <label for="UserName">User Name</label>
                            <input type="text" class="form-control" id="UserName" placeholder="Enter Your Name"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="UserName">Contact Number</label>
                            <input type="text" class="form-control" id="UserName" placeholder="Enter Your Name"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="city">Location</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter Your City" value="">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary" id="updateProfileBtn">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection