@extends('layouts.app')
<div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Join us for free</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" id="name"  required>
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" id="company_name"  required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="address"  required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" id="city"  required>
                        </div>
                        <div class="mb-1">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" id="postal_code"  required>
                        </div>
                        <div class="mb-3">
                            <label for="company_email" class="form-label">Company Email</label>
                            <input type="email" name="company_email" class="form-control" id="company_email"  required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"  required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="pnumber" class="form-label">Phone Number</label>
                            <input type="text" name="work_number" class="form-control" id="pnumber"  required>
                        </div>
                        <div class="mb-5">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="text" name="logo" class="form-control" id="logo"  required>
                        </div>
                        <div class="mb-5">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="text" name="profile_picture" class="form-control" id="profile_picture"  required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                    <a href="/login">LogIn</a>
                </div>
            </div>
        </div>
    </div>
