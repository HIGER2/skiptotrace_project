@extends("layouts.appLayout")
@section('content')
 <main class="main">
    <nav class="slidebar" ">
        <div class="header">
            <a href="/">
             <img src="{{asset('/img/logo.png') }}" alt="">
            </a>

        </div>
        <ul class="navItems">
            <li class="navItem active" >
                <a href="/dashboard" class="">
                    <i class="uil uil-create-dashboard"></i>
                    Dashboard
                </a>
            </li>
            <li class="navItem">
                <a href="/singleSkip">
                    <i class="uil uil-columns"></i>
                    Single Skip
                </a>
            </li>
                <li class="navItem">
                <a href="/bulkSkip">
                    <i class="uil uil-table"></i>
                    Bulk Skips
                </a>
            </li>
            {{-- <li class="navItem">
                <a href="/account/client/liste">
                    <i class="uil uil-comment-alt-image"></i>
                    Skip Tracing List
                </a>
            </li> --}}
             <li class="navItem">
                <a href="/billing">
                    <i class="uil uil-invoice"></i>
                    billing
                </a>
            </li>
            <li class="navItem" >
                <a href="/manage_cards">
                    <i class="uil uil-credit-card"></i>
                    Manage Cards
                </a>
            </li>
            <li class="navItem" >
                <a href="/add_credits">
                    <i class="uil uil-card-atm"></i>
                    Add Credit
                </a>
            </li>
        </ul>
        <ul class="navBottom">
            <li class="navItem" >
                <i class="uil uil-signout"></i>
                <span>Logout</span>
            </li>
        </ul>
    </nav>
    <section class="global-content">
        <nav class="navbar" >
            <div class="hamburger" >
                 Balance : <span>$34408 </span>
                {{-- <i class="uil uil-align-justify"></i> --}}
            </div>
            {{-- <div class="search">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Rechercher avec le code d'expedition">
            </div> --}}
            <div class="rightItem">
                <a href="/add_credits" class="envoi">
                    <i class="uil uil-plus"></i>
                     Add Credit</a>
                <div class="user" >
                    <i class="uil uil-user-circle"></i>
                        <!-- Mon Compte -->
                    <!-- <i class="uil uil-angle-down"></i> -->
                    <div class="down" :class="{'active':isVisible}" @click.shrefp="">
                        <a href="">user name</a>
                        <a href="">Edit Profile</a>
                        <a href="">Change password</a>
                    </div>
                </div>
            </div>
        </nav>
        @yield('account')
    </section>
</main>
@endsection
