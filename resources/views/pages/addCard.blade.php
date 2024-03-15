@extends('layouts.accountLayout')

@section("account")
 <section class="addCard">
            <!-- <div class="box-Content">
                <Button>Ajouter un produit</Button>
            </div> -->
            <div class="contentTable">
                <div class="contentfloat">
                    <form action="">
                        <div class="card">
                            <h5>Add Card</h5>
                                <div class="groupeForm">
                                    <label for="">Full name </label>
                                    <div class="forminput">
                                        <input type="text" placeholder="Full name" min="100" placeholder="10000">
                                    </div>
                                </div>
                                 <div class="groupeForm">
                                    <label for="">Card number</label>
                                    <div class="forminput">
                                        <input type="text" placeholder="Card number" min="100" placeholder="10000">
                                        <div class="cardrow">
                                            <i class="fi fi-brands-cc-visa"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="groupeForm">
                                        <label for="">Expiration</label>
                                        <div class="forminput row">
                                            <select name="" id=""></select>
                                            <select name="" id=""></select>
                                        </div>
                                    </div>
                                    <div class="groupeForm">
                                        <label for="">CVV </label>
                                        <div class="forminput row">
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="groupebtn">
                            <button>
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
@endsection
