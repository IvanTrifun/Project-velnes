@extends('layouts.app')

<header>

    <div class="icons d-flex flex-row">
        <a href="" class="icon"><i class="fa-solid fa-magnifying-glass"></i></a>
        <a href="" class="icon"><i class="fa-regular fa-bell"></i></a>
        <p hidden>{{$imgSrc = Illuminate\Support\Facades\Auth::user()->profile_picture}}</p>
        <a href="/accountSettings"><img src="{{ $imgSrc }}" alt="Profile Picture" style="width: 50px !important; height: 50px !important; object-fit: cover; border-radius: 50% !important;"></a>
        <form class="m-0" action="{{route('logout')}}" method="post">
            @csrf
            <button class="btn btn-outline-danger" type="submit">Logout</button>
        </form>
    </div>
</header>

<div class="wrapper">
    <div class="sidebar">
        <ul>
            <li>
                <a href="{{ route('home') }}" class="icon"><i class="fa-solid fa-fan"></i></a>
            </li>
            <li>
                <a href="{{ route('calendar') }}" class="icon"><i class="fa-regular fa-calendar"></i></a>
            </li>
            <li>
                <a href="{{ route('product') }}" class="icon"><i class="fa-solid fa-wine-bottle"></i></a>
            </li>
            <li>
                <a href="{{ route('customer') }}" class="icon"><i class="fa-solid fa-user"></i></a>
            </li>
            <li>
                <a href="{{ route('total') }}" class="icon"><i class="fa-solid fa-chart-column"></i></a>
            </li>
            <li class="settings">
                <a href="{{ route('generalSettings') }}" class="icon"><i class="fa-solid fa-gear"></i></a>
            </li>
        </ul>
    </div>

</div>
