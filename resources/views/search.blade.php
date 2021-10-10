@extends('layouts.app')

@section('content')
    <form action="/search" method='POST'>
        @csrf
        <section id="all">
            <section id="search">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4">
                            <h1>Modify Reservation</h1>
                        </div>


                        <div class="row">
                            <div class="col-md-6 col-md-offset-5">

                                <p class="searchlabels">Search by confirmation number</p>
                                <p class="searchlabel"> Confirmation number:</p>
                                <div class="col">
                                    <input pattern="[0-9]+" type="text" id="searching" class="form-control " name="confirmation_number">
                                </div>

                                <p class="searchlabel">Email:</p>

                                <div class="col">
                                    <input type="email" id="searching" class="form-control " name="email">
                                </div>
                                <div class="col">
                                    <button type='submit' class="btn btn-info" id="buttsearch">Search</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </section>
        </section>
    </form>
@endsection
