@extends('layouts.appLayout')
@section('content')
 <main class="login">
        <div class="container">

            <div class="card">
                <div class="logo">
                  <a href="/">
                      <img src="{{asset('/img/logo.png') }}" alt="">
                  </a>
                </div>
                <div class="content">
                    <h4>Singn up</h4>
                    <form action="">
                    <div class="groupeForm">
                            <label for="">Name</label>
                            <div class="forminput">
                                <input type="text" placeholder="Email">
                            </div>
                        </div>
                        <div class="groupeForm">
                            <label for="">Email</label>
                            <div class="forminput">
                                <input type="text" placeholder="Email">
                            </div>
                        </div>
                        <div class="groupeForm">
                            <label for="">Password</label>
                            <div class="forminput">
                                <input type="text" placeholder="Password">
                            </div>
                        </div>
                        <button>
                            sign in
                        </button>
                    </form>
                </div>
                <span class="link">
                  Already have an account ? <a href="/auth/login">Singn in </a>
                </span>
            </div>
        </div>
    </main>
@endsection
