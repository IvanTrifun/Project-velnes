@extends('layouts.app')

<div class="second-sidebar">
    <div>
        <ul>
            <h3 class="me-2">General</h3>
            <br>
            <li>
                <a href="{{ route('generalSettings') }}" class="icon">General Settings</a>
            </li>
            <li>
                <a href="{{ route('userAccounts') }}" class="icon">User Accounts</a>
            </li>
            <h3 class="me-2">Company</h3>
            <br>
            <li>
                <a href="{{ route('companyInfo') }}" class="icon">Company Information</i></a>
            </li>
            <li>
                <a href="{{ route('employeeListing') }}" class="icon">Employees</a>
            </li>
            <li>
                <a href="{{ route('service') }}" class="icon">Services</a>
            </li>
            <li>
                <a href="{{ route('resources.index') }}" class="icon">Resources</a>
            </li>
            <h3 class="me-2">Customers</h3>
            <br>
            <li>
                <a href="{{ route('group') }}" class="icon">Customer Groups</a>
            </li>
        </ul>
    </div>
</div>
