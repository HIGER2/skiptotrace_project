@extends('layouts.accountLayout')

@section("account")
 <section class="addcredit">
            <!-- <div class="box-Content">
                <Button>Ajouter un produit</Button>
            </div> -->
            <div class="contentTable">
                <div class="contentfloat">
                    <form action="">
                        <div class="card">
                            <h5>Add Credits</h5>
                            <div class="row">
                                <div class="groupeForm">
                                    <label for="">Choose card</label>
                                    <div class="forminput">
                                        <select name="" id=""></select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="groupeForm">
                                    <label for=""> No. of skips </label>
                                    <div class="forminput">
                                        <input type="number" min="100" placeholder="10000">
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
