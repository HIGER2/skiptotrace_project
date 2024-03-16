
@extends('layouts.appLayout')
@section('content')
<nav class="navbar-home">
    <div class="logo">
        <img src="{{asset('/img/logo.png') }}" alt="">
    </div>

    {{-- <ul class="items">
        <a href="">Home</a>
        <a href="">Pricing</a>
    </ul> --}}

    <div class="groupebuton">
        <a href="#home">Home</a>
        <a href="#FAQ">FAQ</a>
        <a href="#pricing">Pricing</a>
        <a href="/auth/login">Sign In</a>
        <a href="/dashboard">Get Started</a>
    </div>
</nav>

<section class="banner" id="home">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Trace Quickly and Accurately with  Our <span>Service SkipToTrace</span>  </h2>
                <p>Discover our best-in-class skip tracing service, designed to provide you with the most accurate and comprehensive data in the industry. Our expert team uses advanced search techniques to quickly and efficiently find the people you are looking for. Locate with confidence thanks to our reliable and professional service</p>
            </div>
            <div class="col">
                <div class="contentImage">
                    <img src="{{asset('/img/banner.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

</section>


<section class="featears">
    <div class="container">
        <h2>Turnkey  <span>service with </span> powerful features.</h2>
        <div class="row">
            <div class="col">
                {{-- <div class="number">1</div> --}}
                <h3>Highly accurate</h3>
                <p>Increase your contact rate and generate more leads with our industry-leading match rate and accuracy.</p>
            </div>
             <div class="col">
                {{-- <div class="number">1</div> --}}
                <h3>Extremely budget-friendly</h3>
                <p>Get the most accurate and reliable data with competitive pricing as low as $0.10 per match.</p>
            </div>
             <div class="col">
                {{-- <div class="number">1</div> --}}
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
                <h3>Bulk skip SkipToTrace  </h3>
                <p>Discover our best-in-class skip tracing service, designed to provide you with the most accurate and comprehensive data in the industry. Our expert team uses advanced search techniques to quickly and efficiently find the people you are looking for. Locate with confidence thanks to our reliable and professional service</p>
            </div>
            <div class="col">
                <div class="contentImage">
                <img srcset="{{asset('/img/left.jpg') }}" src="{{asset('/img/left.jpg') }}" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Single skip SkipToTrace  </h3>
                <p>Discover our best-in-class skip tracing service, designed to provide you with the most accurate and comprehensive data in the industry. Our expert team uses advanced search techniques to quickly and efficiently find the people you are looking for. Locate with confidence thanks to our reliable and professional service</p>
            </div>
            <div class="col">
                <div class="contentImage">
                <img srcset="{{asset('/img/right3.png') }}" src="{{asset('/img/right3.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

</section>


<section class="work">
    <div class="container">
        <h2>How SkipToTrace <span>works</span></h2>
        <div class="row">
            <div class="col">
                <div class="number">1</div>
                <h3>top up your account</h3>
                <p>Get the most accurate and reliable data with competitive pricing as low as $0.10 per match.</p>
            </div>
            <div class="col">
                <div class="number">2</div>
                <h3>Enter Skip</h3>
                <p>Increase your contact rate and generate more leads with our industry-leading match rate and accuracy.</p>
            </div>

             <div class="col">
                <div class="number">3</div>
                <h3>Submit  Skip </h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, accusantium
                </p>
            </div>
             <div class="col">
                <div class="number">4</div>
                <h3>Sit back and let us do the work</h3>
                <p>Once your invoice is paid, we'll process your files through our system.</p>
            </div>
             <div class="col">
                <div class="number">5</div>
                <h3>Get your results</h3>
                <p>You'll receive a secure Dropbox link where you can access your results.</p>
            </div>

        </div>
    </div>

</section>
{{--
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
</section> --}}

<section class="pricing" id="pricing">
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
            <h3>Supercharge your <span>Production</span> Rundown</h3>
            <a href="/dashboard">Get Started</a>
        </div>
    </div>

</section>


<section class="faq" id="FAQ">
    <div class="container">
        <h2>Common <span>Questions</span></h2>
        <ul class="navitem">
            <li class="item">
                <div class="head">
                    <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic, possimus?</span>
                    <i class="uil uil-angle-right"></i>
                </div>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto ut vitae atque. Repellendus obcaecati omnis distinctio debitis, ipsum pariatur ratione!</p>
                </div>
            </li>
               <li class="item">
                <div class="head">
                    <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic, possimus?</span>
                    <i class="uil uil-angle-right"></i>
                </div>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto ut vitae atque. Repellendus obcaecati omnis distinctio debitis, ipsum pariatur ratione!</p>
                </div>
            </li>
               <li class="item">
                <div class="head">
                    <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic, possimus?</span>
                    <i class="uil uil-angle-right"></i>
                </div>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto ut vitae atque. Repellendus obcaecati omnis distinctio debitis, ipsum pariatur ratione!</p>
                </div>
            </li>
               <li class="item">
                <div class="head">
                    <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic, possimus?</span>
                    <i class="uil uil-angle-right"></i>
                </div>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto ut vitae atque. Repellendus obcaecati omnis distinctio debitis, ipsum pariatur ratione!</p>
                </div>
            </li>
               <li class="item">
                <div class="head">
                    <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic, possimus?</span>
                    <i class="uil uil-angle-right"></i>
                </div>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto ut vitae atque. Repellendus obcaecati omnis distinctio debitis, ipsum pariatur ratione!</p>
                </div>
            </li>
        </ul>
    </div>

</section>



<footer>
    <div class="container">
        <div class="row">
            <div class="col">
                <h5>Quick Links</h5>
                <ul>
                    <a href="#princing">Pricing</a>
                    <a href="">FAQ</a>
                </ul>
            </div>
            <div class="col">
                <h5>SkipToTrace</h5>
                <ul>
                    <a href="">support@skipToTrace.com</a>
                    <a href="">+1 00000000</a>
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
