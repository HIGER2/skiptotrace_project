
@extends('layouts.appLayout')
@section('content')
<nav class="navbar-home">
    <div class="logo">
        <img src="{{asset('/img/logo.png') }}" alt="">
    </div>

    <ul class="items">
        <a href="">Home</a>
        <a href="">Pricing</a>
    </ul>

    <div class="groupebuton">
        <a href="">Sign In</a>
        <a href="">Get Started</a>
    </div>
</nav>

<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Trace Quickly and Accurately with  Our <span>Service SkipToTrace</span>  </h2>
                <p>Discover our best-in-class skip tracing service, designed to provide you with the most accurate and comprehensive data in the industry. Our expert team uses advanced search techniques to quickly and efficiently find the people you are looking for. Locate with confidence thanks to our reliable and professional service</p>
            </div>
            <div class="col">
                <img src="{{asset('/img/banner2.png') }}" alt="">
            </div>
        </div>
    </div>

</section>


<section class="featears">
    <div class="container">
        <h2>Turnkey  <span>service with </span> powerful features.</h2>
        <div class="row">
            <div class="col">
                <div class="number">1</div>
                <h3>Lorem ipsum dolor sit amet.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, accusantium.</p>
            </div>
             <div class="col">
                <div class="number">1</div>
                <h3>Lorem ipsum dolor sit amet.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, accusantium.</p>
            </div>
             <div class="col">
                <div class="number">1</div>
                <h3>Lorem ipsum dolor sit amet.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, accusantium.</p>
            </div>

        </div>
    </div>

</section>


<section class="section2">
    <div class="container">
        {{-- <h2>Turnkey  <span>service with </span> powerful features.</h2> --}}
        <div class="row">
            <div class="col">
                <h3>Trace Quickly SkipToTrace  </h3>
                <p>Discover our best-in-class skip tracing service, designed to provide you with the most accurate and comprehensive data in the industry. Our expert team uses advanced search techniques to quickly and efficiently find the people you are looking for. Locate with confidence thanks to our reliable and professional service</p>
            </div>
            <div class="col">
                <img src="{{asset('/img/banner.svg') }}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Trace Quickly SkipToTrace  </h3>
                <p>Discover our best-in-class skip tracing service, designed to provide you with the most accurate and comprehensive data in the industry. Our expert team uses advanced search techniques to quickly and efficiently find the people you are looking for. Locate with confidence thanks to our reliable and professional service</p>
            </div>
            <div class="col">
                <img src="{{asset('/img/banner.svg') }}" alt="">
            </div>
        </div>
    </div>

</section>
<section class="afterPricing">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>Lorem ipsum dolor sit.</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis, officia?</p>
            </div>
            <div class="col">
                <h4>Lorem ipsum dolor sit.</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis, officia?</p>
            </div>
        </div>
    </div>
</section>

<section class="pricing">
    <div class="container">
        <h2>Pricing</h2>
        <p>How many records do you plan to skip trace?</p>
       <div class="pricing">
            <div class="row">
                <div class="col" v-for="(item,index) in 3" :key="index">
                    <div class="card">
                      <div class="header">
                        {{-- <h5>Basique <span>Le plus populaire</span></h5> --}}
                        <div class="prix">
                            <h3>0.15</h3>
                            <span>/match</span>
                        </div>
                        <div class="buttonGroupe">
                            <button class=""><i class="uil uil-minus"></i></button>
                            <div class="per">12</div>
                            <button><i class="uil uil-plus"></i></button>
                        </div>
                        <div class="total">
                            <span>$</span>
                            <div> 27.00</div>
                        </div>
                        <button class="btn">Commencez premium</button>
                      </div>
                      {{-- <div class="caracteristique">
                        <span class="title">Des fonctionnalités remarquables</span>
                        <ul class="function">
                            <li><i class="uil uil-check"></i> La caisse la plus convertie au monde</li>
                            <li><i class="uil uil-check"></i> La caisse la plus convertie au monde</li>
                            <li><i class="uil uil-check"></i> La caisse la plus convertie au monde</li>
                            <li><i class="uil uil-check"></i> La caisse la plus convertie au monde</li>
                            <li><i class="uil uil-check"></i> La caisse la plus convertie au monde</li>
                        </ul>
                      </div> --}}
                    </div>
                </div>
            </div>
       </div>
    </div>

</section>


<section class="beoreFooter">
    <div class="container">
        <div class="card">
            <h2>Supercharge your <span>Production</span> Rundown</h2>
            <a href="">Get Started</a>
        </div>
    </div>

</section>


<footer>
    <div class="container">
        <div class="row">
            <div class="col">
                <h5>Quick Links</h5>
                <ul>
                    <a href="">Pricing</a>
                    <a href="">FAQ</a>
                </ul>
            </div>
            <div class="col">
                <h5>SkipToTrace</h5>
                <ul>
                    <a href="">support@skipmatrix.com</a>
                    <a href="">+1 (888) 704-0774</a>
                </ul>
            </div>
            <div class="col">
                <h5>Social</h5>
                <ul>
                    <a href="">Facebook</a>
                    <a href="">Instagram</a>
                    <a href="">Twitter/X</a>
                </ul>
            </div>
        </div>
    </div>
</footer>
@endsection
