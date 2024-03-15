@extends("layouts.accountLayout")
@section('account')
 <div class="managecard">
    <div class="d-head">
        <h5>List of All saved card</h5>
        <a href="/add_card">
            <i class="uil uil-card-atm"></i>
            Add Card
        </a>
    </div>

    <div class="box-Content">
        <div class="box">
            <div class="ico">
              <i class="uil uil-credit-card"></i>
            </div>
            <div class="info">
                <div class="libele">**** **** **** 4242</div>
                <div class="element">
                    <div class="item">
                        <span>exp Date</span>
                        <span> 3/2025</span>
                    </div>
                    {{-- <div class="item">
                        <span></span>
                        <span> 3/2025</span>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="box">
            <div class="ico">
              <i class="uil uil-credit-card"></i>
            </div>
            <div class="info">
                <div class="libele">**** **** **** 4242</div>
                <div class="element">
                    <div class="item">
                        <span>exp Date</span>
                        <span> 3/2025</span>
                    </div>
                    {{-- <div class="item">
                        <span></span>
                        <span> 3/2025</span>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="box">
            <div class="ico">
               <i class="uil uil-credit-card"></i>
            </div>
            <div class="info">
                <div class="libele">**** **** **** 4242</div>
                <div class="element">
                    <div class="item">
                        <span>exp Date</span>
                        <span> 3/2025</span>
                    </div>
                    {{-- <div class="item">
                        <span></span>
                        <span> 3/2025</span>
                    </div> --}}
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
