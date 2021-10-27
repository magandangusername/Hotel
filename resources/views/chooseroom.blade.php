@extends('layouts.app')

@section('content')
@php
    $rates = DB::table('rate_descriptions')->get();
    $roomtype = DB::table('room_statuses')->distinct()->get(['room_suite_name']);
@endphp

<div class="container m-0 p-0">
    <h1 class="fw-bold ps-5 pt-5">Rooms & Rates</h1>
    <hr class="mx-5 mb-2 p-1">

    <div class="container m-0 p-0">
        <div class="infotab py-3 text-dark ">
            <div class="row">
                <div class="col-3 text-center">
                    <h4 class="fw-bold">Reservation Number</h4>
                    <h5>21313112313</h5>
                </div>

                <div class="col">
                    <h4 class="fw-bold">Arrival/Departure</h4>
                    <h5>09/10/21-10/10/21 </h5>
                </div>

                <div class="col-1 text-center">
                    <h4 class="fw-bold">Adult</h4>
                    <h5>5</h5>
                </div>

                <div class="col-1 text-center">
                    <h4 class="fw-bold">Children</h4>
                    <h5>5</h5>
                </div>



                <div class=" ms-5 col">
                    <div class="px-5">
                        <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">More Information</button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container mt-5 bg-success">
        <div class="row mx-3 p-5">
            <div class="col">
                <h2 class="fw-bold"> Standard Rate </h2>
                <p>Free Wifi</p>
                <p>Breakfast</p>
                <p>30% Discount on nightly charge </p>
            </div>
            <div class="col">
                <h2 class="fw-bold"> Policies </h2>
                <p>Must cancel prior to 4:00PM one day before arrival to avoid a one night room charge plus surcharge. </p>
                <p class="policies">Reservation must be guaranteed with credit card at time of booking.Room will be held until 12 midnight on the day of the arrival (hotel local time).</p>
            </div>
        </div>

    <div class="container">
        <div class="row">
                <div class="col">

                    <div class="accordion" id="RRlist">

                        <div class="accordion-item ">
                        <h2 class="accordion-header" id="heading-1">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#room-1" aria-expanded="true" aria-controls="room-1">
                            Deluxe Room
                            </button>
                        </h2>
                        <div id="room-1" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#RRlist">
                            <div class="accordion-body">

                            <div class="row text-center">
                                <div class="col col-sm-6" data-toggle="modal" data-target="#DeluxeImgModal">
                                    <img class="w-100" src="{{asset('images/deluxee1.jpg')}}"alt="First slide">
                                </div>
                                <div class="col mt-2 col-sm6 ">
                                    <h3 class="fw-bold">Deluxe Room</h3>
                                    <p class="my-3"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor, culpa eaque ducimus est incidunt architecto ipsa delectus. Architecto cumque libero explicabo reiciendis eligendi eum excepturi voluptas, iste sapiente. Assumenda, sint.</p>
                                    <div class="row mx-5 px-5">
                                        <div class="col">
                                            <li>Amenity 1</li>
                                            <li>Amenity 2</li>
                                            <li>Amenity 3</li>
                                        </div>
                                        <div class="col">
                                            <li>Amenity 4</li>
                                            <li>Amenity 5</li>
                                            <li>Amenity 6</li>
                                        </div>
                                    </div>

                                    <div class="row mt-3 px-5">
                                        <div class="col">
                                                <h2 class="fw-bold">$1,000<h2>
                                                <h5><a href="" data-toggle="modal" data-target="#PBDeluxe">Price Breakdown</a></h5>
                                        </div>
                                    </div>

                                    <hr class="mx-5 mb-2 p-1">

                                    <div class="row mx-5 mt-1 px-5">
                                        <div class="col">
                                                <!-- radio button -->
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">King Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Queen Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                                <label class="form-check-label" for="inlineRadio3">Disabled Sample</label>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary fw-bold">Select Room</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                            </div>

                                <!-- Gallery Modal -->

                                <div class="modal fade" id="DeluxeImgModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <div id="DeluxeModalGallery" class="carousel slide" data-ride="carousel">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{asset('images/deluxee1.jpg')}}" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('images/deluxee2.jpg')}}" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('images/deluxee3.jpg')}}" alt="Third slide">
                                            </div>

                                        </div>
                                        <a class="carousel-control-prev" href="#DeluxeModalGallery" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#DeluxeModalGallery" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <!--Price Breakdown Modal -->

                                <div class="modal fade" id="PBDeluxe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Price Breakdown</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <h5>Room Type: Room</h5>
                                            <h5>Rate Type: Rate</h5>
                                            <h5>Room Total: 2,500</h5>
                                            <h5>Vat: 1,000</h5>
                                            <h5>Service: 1,000</h5>
                                            <h5>City Tax: 1,000</h5>
                                            <h5>Total: 1,000</h5>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                 </div>


                            </div>
                        </div>
                        </div>

                        <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-2">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#room-2" aria-expanded="true" aria-controls="room-2">
                            Joint Room
                            </button>
                        </h2>
                        <div id="room-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#RRlist">
                            <div class="accordion-body">


                            <div class="row text-center">
                                <div class="col col-sm-6" data-toggle="modal" data-target="#JointImgModal">
                                    <img class="w-100" src="{{asset('images/joint1.jpg')}}"alt="First slide">
                                </div>
                                <div class="col mt-2 col-sm6 ">
                                    <h3 class="fw-bold">Joint Room</h3>
                                    <p class="my-3"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor, culpa eaque ducimus est incidunt architecto ipsa delectus. Architecto cumque libero explicabo reiciendis eligendi eum excepturi voluptas, iste sapiente. Assumenda, sint.</p>
                                    <div class="row mx-5 px-5">
                                        <div class="col">
                                            <li>Amenity 1</li>
                                            <li>Amenity 2</li>
                                            <li>Amenity 3</li>
                                        </div>
                                        <div class="col">
                                            <li>Amenity 4</li>
                                            <li>Amenity 5</li>
                                            <li>Amenity 6</li>
                                        </div>
                                    </div>

                                    <div class="row mt-3 px-5">
                                        <div class="col">
                                                <h2 class="fw-bold">$1,000<h2>
                                                <h5><a href="" data-toggle="modal" data-target="#PBJoint">Price Breakdown</a></h5>
                                        </div>
                                    </div>

                                    <hr class="mx-5 mb-2 p-1">

                                    <div class="row mx-5 mt-1 px-5">
                                        <div class="col">
                                                <!-- radio button -->
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">King Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Queen Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                                <label class="form-check-label" for="inlineRadio3">Disabled Sample</label>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary fw-bold">Select Room</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                            </div>

                                <!-- Gallery Modal -->

                                <div class="modal fade" id="JointImgModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <div id="JointModalGallery" class="carousel slide" data-ride="carousel">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{asset('images/joint1.jpg')}}" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('images/joint2.jpg')}}" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('images/joint3.jpg')}}" alt="Third slide">
                                            </div>

                                        </div>
                                        <a class="carousel-control-prev" href="#JointModalGallery" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#JointModalGallery" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <!--Price Breakdown Modal -->

                                <div class="modal fade" id="PBJoint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Price Breakdown</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <h5>Room Type: Room</h5>
                                            <h5>Rate Type: Rate</h5>
                                            <h5>Room Total: 2,500</h5>
                                            <h5>Vat: 1,000</h5>
                                            <h5>Service: 1,000</h5>
                                            <h5>City Tax: 1,000</h5>
                                            <h5>Total: 1,000</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                 </div>




                            </div>
                        </div>
                        </div>

                        <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-3">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#room-3" aria-expanded="true" aria-controls="room-3">
                            Standard Room
                            </button>
                        </h2>
                        <div id="room-3" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#RRlist">
                            <div class="accordion-body">

                            <div class="row text-center">
                                <div class="col col-sm-6" data-toggle="modal" data-target="#StandardImgModal">
                                    <img class="w-100" src="{{asset('images/standee2.jpg')}}"alt="First slide">
                                </div>
                                <div class="col mt-2 col-sm6 ">
                                    <h3 class="fw-bold">Standard Room</h3>
                                    <p class="my-3"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor, culpa eaque ducimus est incidunt architecto ipsa delectus. Architecto cumque libero explicabo reiciendis eligendi eum excepturi voluptas, iste sapiente. Assumenda, sint.</p>
                                    <div class="row mx-5 px-5">
                                        <div class="col">
                                            <li>Amenity 1</li>
                                            <li>Amenity 2</li>
                                            <li>Amenity 3</li>
                                        </div>
                                        <div class="col">
                                            <li>Amenity 4</li>
                                            <li>Amenity 5</li>
                                            <li>Amenity 6</li>
                                        </div>
                                    </div>

                                    <div class="row mt-3 px-5">
                                        <div class="col">
                                                <h2 class="fw-bold">$1,000<h2>
                                                <h5><a href="" data-toggle="modal" data-target="#PBStandard">Price Breakdown</a></h5>
                                        </div>
                                    </div>

                                    <hr class="mx-5 mb-2 p-1">

                                    <div class="row mx-5 mt-1 px-5">
                                        <div class="col">
                                                <!-- radio button -->
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">King Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Queen Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                                <label class="form-check-label" for="inlineRadio3">Disabled Sample</label>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary fw-bold">Select Room</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                            </div>

                                <!-- Gallery Modal -->

                                <div class="modal fade" id="StandardImgModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <div id="StandardModalGallery" class="carousel slide" data-ride="carousel">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{asset('images/standee2.jpg')}}" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('images/standee3.jpg')}}" alt="Second slide">
                                            </div>


                                        </div>
                                        <a class="carousel-control-prev" href="#StandardModalGallery" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#StandardModalGallery" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <!--Price Breakdown Modal -->

                                <div class="modal fade" id="PBStandard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Price Breakdown</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <h5>Room Type: Room</h5>
                                            <h5>Rate Type: Rate</h5>
                                            <h5>Room Total: 2,500</h5>
                                            <h5>Vat: 1,000</h5>
                                            <h5>Service: 1,000</h5>
                                            <h5>City Tax: 1,000</h5>
                                            <h5>Total: 1,000</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                 </div>



                            </div>
                        </div>
                        </div>

                        <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-4">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#room-4" aria-expanded="true" aria-controls="room-4">
                            Executive Suite
                            </button>
                        </h2>
                        <div id="room-4" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#RRlist">
                            <div class="accordion-body">


                            <div class="row text-center">
                                <div class="col col-sm-6" data-toggle="modal" data-target="#ExecutiveImgModal">
                                    <img class="w-100" src="{{asset('images/execute1.jpg')}}"alt="First slide">
                                </div>
                                <div class="col mt-2 col-sm6 ">
                                    <h3 class="fw-bold">Executive Room</h3>
                                    <p class="my-3"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor, culpa eaque ducimus est incidunt architecto ipsa delectus. Architecto cumque libero explicabo reiciendis eligendi eum excepturi voluptas, iste sapiente. Assumenda, sint.</p>
                                    <div class="row mx-5 px-5">
                                        <div class="col">
                                            <li>Amenity 1</li>
                                            <li>Amenity 2</li>
                                            <li>Amenity 3</li>
                                        </div>
                                        <div class="col">
                                            <li>Amenity 4</li>
                                            <li>Amenity 5</li>
                                            <li>Amenity 6</li>
                                        </div>
                                    </div>

                                    <div class="row mt-3 px-5">
                                        <div class="col">
                                                <h2 class="fw-bold">$1,000<h2>
                                                <h5><a href="" data-toggle="modal" data-target="#PBExecutive">Price Breakdown</a></h5>
                                        </div>
                                    </div>

                                    <hr class="mx-5 mb-2 p-1">

                                    <div class="row mx-5 mt-1 px-5">
                                        <div class="col">
                                                <!-- radio button -->
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">King Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Queen Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                                <label class="form-check-label" for="inlineRadio3">Disabled Sample</label>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary fw-bold">Select Room</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                            </div>

                                <!-- Gallery Modal -->

                                <div class="modal fade" id="ExecutiveImgModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <div id="ExecutiveModalGallery" class="carousel slide" data-ride="carousel">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{asset('images/execute1.jpg')}}" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('images/execute2.jpg')}}" alt="Second slide">
                                            </div>

                                        </div>
                                        <a class="carousel-control-prev" href="#ExecutiveModalGallery" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#ExecutiveModalGallery" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <!--Price Breakdown Modal -->

                                <div class="modal fade" id="PBExecutive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Price Breakdown</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <h5>Room Type: Room</h5>
                                            <h5>Rate Type: Rate</h5>
                                            <h5>Room Total: 2,500</h5>
                                            <h5>Vat: 1,000</h5>
                                            <h5>Service: 1,000</h5>
                                            <h5>City Tax: 1,000</h5>
                                            <h5>Total: 1,000</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                 </div>


                            </div>
                        </div>
                        </div>

                        <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-5">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#room-5" aria-expanded="true" aria-controls="room-5">
                            Junior Suite
                            </button>
                        </h2>
                        <div id="room-5" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#RRlist">
                            <div class="accordion-body">

                            <div class="row text-center">
                                <div class="col col-sm-6" data-toggle="modal" data-target="#JuniorImgModal">
                                    <img class="w-100" src="{{asset('images/juniorr1.jpg')}}"alt="First slide">
                                </div>
                                <div class="col mt-2 col-sm6 ">
                                    <h3 class="fw-bold">Junior Suite</h3>
                                    <p class="my-3"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor, culpa eaque ducimus est incidunt architecto ipsa delectus. Architecto cumque libero explicabo reiciendis eligendi eum excepturi voluptas, iste sapiente. Assumenda, sint.</p>
                                    <div class="row mx-5 px-5">
                                        <div class="col">
                                            <li>Amenity 1</li>
                                            <li>Amenity 2</li>
                                            <li>Amenity 3</li>
                                        </div>
                                        <div class="col">
                                            <li>Amenity 4</li>
                                            <li>Amenity 5</li>
                                            <li>Amenity 6</li>
                                        </div>
                                    </div>

                                    <div class="row mt-3 px-5">
                                        <div class="col">
                                                <h2 class="fw-bold">$1,000<h2>
                                                <h5><a href="" data-toggle="modal" data-target="#PBJunior">Price Breakdown</a></h5>
                                        </div>
                                    </div>

                                    <hr class="mx-5 mb-2 p-1">

                                    <div class="row mx-5 mt-1 px-5">
                                        <div class="col">
                                                <!-- radio button -->
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">King Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Queen Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                                <label class="form-check-label" for="inlineRadio3">Disabled Sample</label>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary fw-bold">Select Room</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                            </div>

                                <!-- Gallery Modal -->

                                <div class="modal fade" id="JuniorImgModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <div id="JuniorModalGallery" class="carousel slide" data-ride="carousel">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{asset('images/juniorr1.jpg')}}" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('images/juniorr2.jpg')}}" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('images/juniorr3.jpg')}}" alt="Second slide">
                                            </div>

                                        </div>
                                        <a class="carousel-control-prev" href="#JuniorModalGallery" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#JuniorModalGallery" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <!--Price Breakdown Modal -->

                                <div class="modal fade" id="PBJunior" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Price Breakdown</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <h5>Room Type: Room</h5>
                                            <h5>Rate Type: Rate</h5>
                                            <h5>Room Total: 2,500</h5>
                                            <h5>Vat: 1,000</h5>
                                            <h5>Service: 1,000</h5>
                                            <h5>City Tax: 1,000</h5>
                                            <h5>Total: 1,000</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                 </div>


                            </div>
                        </div>
                        </div>

                        <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-6">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#room-6" aria-expanded="true" aria-controls="room-6">
                            Presidential Suite
                            </button>
                        </h2>
                        <div id="room-6" class="accordion-collapse collapse" aria-labelledby="heading-6" data-bs-parent="#RRlist">
                            <div class="accordion-body">

                            <div class="row text-center">
                                <div class="col col-sm-6" data-toggle="modal" data-target="#PresidentialImgModal">
                                    <img class="w-100" src="{{asset('images/presidential1 (1).jpg')}}"alt="First slide">
                                </div>
                                <div class="col mt-2 col-sm6 ">
                                    <h3 class="fw-bold">Presidential Suite</h3>
                                    <p class="my-3"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor, culpa eaque ducimus est incidunt architecto ipsa delectus. Architecto cumque libero explicabo reiciendis eligendi eum excepturi voluptas, iste sapiente. Assumenda, sint.</p>
                                    <div class="row mx-5 px-5">
                                        <div class="col">
                                            <li>Amenity 1</li>
                                            <li>Amenity 2</li>
                                            <li>Amenity 3</li>
                                        </div>
                                        <div class="col">
                                            <li>Amenity 4</li>
                                            <li>Amenity 5</li>
                                            <li>Amenity 6</li>
                                        </div>
                                    </div>

                                    <div class="row mt-3 px-5">
                                        <div class="col">
                                                <h2 class="fw-bold">$1,000<h2>
                                                <h5><a href="" data-toggle="modal" data-target="#PBPresidential">Price Breakdown</a></h5>
                                        </div>
                                    </div>

                                    <hr class="mx-5 mb-2 p-1">

                                    <div class="row mx-5 mt-1 px-5">
                                        <div class="col">
                                                <!-- radio button -->
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">King Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Queen Bed</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                                <label class="form-check-label" for="inlineRadio3">Disabled Sample</label>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary fw-bold">Select Room</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                            </div>

                                <!-- Gallery Modal -->

                                <div class="modal fade" id="PresidentialImgModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <div id="JuniorModalGallery" class="carousel slide" data-ride="carousel">

                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{asset('images/presidential1 (1).jpg')}}" alt="First slide">
                                                </div>
                                            </div>

                                            <a class="carousel-control-prev" href="#PresidentialModalGallery" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>

                                            <a class="carousel-control-next" href="#PresidentialModalGallery" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <!--Price Breakdown Modal -->

                                <div class="modal fade" id="PBPresidential" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Price Breakdown</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <h5>Room Type: Room</h5>
                                            <h5>Rate Type: Rate</h5>
                                            <h5>Room Total: 2,500</h5>
                                            <h5>Vat: 1,000</h5>
                                            <h5>Service: 1,000</h5>
                                            <h5>City Tax: 1,000</h5>
                                            <h5>Total: 1,000</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                 </div>

                            </div>
                        </div>
                        </div>

                    </div>

            </div>
        </div>
    </div>

 </div>



</div>
    <!-- <section id="availabilityrese">
        <div class="containerrese">
            <div class="titlecheck">
                <h1 class="reservetitle">Rooms & Rates</h1>
            </div>
    </section>

    <section id="useredits">
        <div class="containerchecks">
            <div class="row g-2 justify-content-center">

                <div class="col-auto">
                    <p class="label">Your Stay:
                        @if (isset($book) && $book !== null)
                            {{ date('M d, Y', strtotime($book->arrival_date)) . ' - ' . date('M d, Y', strtotime($book->departure_date)) }}
                        @else
                            {{ date('M d, Y', strtotime(session('CheckIn'))) . ' - ' . date('M d, Y', strtotime(session('CheckOut'))) }}
                        @endif

                    </p>
                </div>
                <div class="col-auto">
                    @if (!isset($book) || $book === null)
                        <p class="label vertical">room(s): {{ session('RoomCount') }}</p>
                    @endif

                </div>
                <div class="col-auto">
                    <p class="label ">adult:
                        @if (isset($book) && $book !== null)
                            {{$book->adult}}
                        @else
                            @if (session('room') !== null && session('room') > 1)
                                @php
                                    $room = session('room');
                                @endphp

                            @else
                                @php
                                    $room = 1;
                                    // session('room') = $room;
                                    Session::put('room', $room);
                                @endphp

                            @endif

                            @if ($room == 1)
                                @php
                                    // session('roomchecker') = true;
                                    // session('roomchecker2') = true;
                                    // session('roomtype2') = '';
                                    // session('ratetyoe2') = '';

                                    Session::put('roomchecker', true);
                                    Session::put('roomchecker2', true);
                                    Session::put('roomtype2', '');
                                    Session::put('ratetype2', '');

                                @endphp
                                {{ session('AdultCount') }}

                            @elseif ($room == 2)
                                {{ session('AdultCount2') }}
                            @elseif ($room == 3)
                                {{ session('AdultCount3') }}
                            @endif

                        @endif

                    </p>
                </div>
                <div class="col-auto" hidden>
                    <p class="label">children</p>
                </div>
                <div class="col-auto" hidden>
                    <p class="label">Total rate: </p>
                </div>
            </div>
        </div>
    </section>
    @if (!isset($book))
        @if (session('RoomCount') > 1)
            <div class="containerish">
                <h1>Room {{ $room }} out of {{ session('RoomCount') }}</h1>
            </div>
        @endif
    @endif


    @php
    $rt = 0;
    $rs = 0;
    $b = 0;
    @endphp

    @foreach ($rates as $rateinfo)


        <section id="sliderish">
            <div class="containerish">
                <div class="row">
                    <div class="col-md-5 ">
                        <h3 class="roomeb1"> {{ $rateinfo->rate_name }} </h3>
                        <p class="roomeb">{{ $rateinfo->rate_offer1 }}</p>
                        <p class="roomeb">{{ $rateinfo->rate_offer2 }}</p>
                        <p class="roomeb">{{ $rateinfo->rate_offer3 }}</p>
                    </div>
                    <div class="col-md-6 ">
                        <div class="termss">
                            <h4 class="policies1"> Policies </h4>
                            <p class="policies">Must cancel prior to 4:00PM one day before arrival to avoid a one
                                night
                                room charge plus surcharge. </p>
                            <p class="policies">Reservation must be guaranteed with credit card at time of booking.
                                Room
                                will be held until 12 midnight on the day of the arrival (hotel local time).</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="sliderearly">
            <div class="containerearly">
                <div class="titlesa">
                    <h4 class="availroom"> Available Rooms </h4>
                </div>


                <div class="row slider">
                    @foreach ($roomtype as $result)
                        <div class="col-md-12" id="avilnows">
                            <div class="cards">
                                @php
                                    $type = $result->room_suite_name;
                                    $base_price = \App\Models\room_description::where('room_name', 'like', $result->room_suite_name)->first();

                                    if ($base_price != null) {
                                        $short_desc = $base_price->room_short_description;
                                        $bed_type = $base_price->bed_type;
                                        $image_name = $base_price->image_name;
                                        $room_size = $base_price->suite_size;
                                        // $base_price = $baseprice->base_price;
                                    } else {
                                        $base_price = \App\Models\suite_description::where('suite_name', 'like', $result->room_suite_name)->first();
                                        $short_desc = $base_price->suite_short_description;
                                        $bed_type = $base_price->bed_type;
                                        $image_name = $base_price->image_name;
                                        $room_size = $base_price->suite_size;
                                        // $base_price = $baseprice->base_price;
                                    }

                                    $roomprice = \App\Models\rate_description::where('rate_name', 'like', $rateinfo->rate_name)->first();

                                    if (session('PromoCode') != '') {
                                        $promodiscount = \App\Models\promotion_description::where('promotion_code', session('PromoCode'))->first();
                                        $promodiscount = $promodiscount->overall_cut;
                                    }
                                    // else {
                                    //     $promodiscount = 1;
                                    // }

                                    $base_discount = $roomprice->base_discount;
                                    $service_rate = $roomprice->service_rate;
                                    $city_tax = $roomprice->city_tax;
                                    $vat = $roomprice->vat;

                                    if ($base_discount === 0) {
                                        $base_discount = $base_price->base_price;
                                    }

                                    $base_discount = $base_price->base_price * $base_discount;
                                    $new_price = $base_price->base_price - $base_discount;

                                    $totalprice = $new_price + $new_price * $service_rate + $new_price * $city_tax + $new_price * $vat;

                                    // $promodiscount = $promodiscount * $totalprice;

                                    // $totalprice = $totalprice - $promodiscount;

                                    if (isset($promodiscount)) {
                                        $promototal = $totalprice * $promodiscount;
                                        $newpromototal = $totalprice - $promototal;
                                    }

                                    if (isset($newpromototal)) {
                                        $totalrate = $newpromototal;
                                    } else {
                                        $totalrate = $totalprice;
                                    }

                                    $nights = (new DateTime(date('Y-m-d', strtotime(session('CheckIn')))))->diff(new DateTime(date('Y-m-d', strtotime(session('CheckOut')))))->days;

                                    $totalrate *= $nights;


                                    // Session::put('downpayment', session('downpayment') + ($totalrate * 0.5));
                                    // Session::put('downpayment', number_format(session('downpayment'), 0, '.', ''));

                                    // $k = 'K';
                                    // $q = 'Q';
                                    // $kq = 'King Bed';
                                    // $beds = '';
                                    // if (preg_match("/{$k}/i", $bed_type)) {
                                    //     $beds = $beds . 'King Bed';
                                    // }

                                    // if (preg_match("/{$q}/i", $bed_type)) {
                                    //     if (preg_match("/{$kq}/i", $beds)) {
                                    //         $beds = $beds . ', ';
                                    //     }
                                    //     $beds = $beds . 'Queen Bed';
                                    // }
                                @endphp

                                <img src="{{ asset('images/' . $image_name) }}" class="card-img-top">
                                <form action="@php
                                    if(isset($book) && $book !== null){
                                        echo '/modify';
                                    } else {
                                        echo '/chooseroom';
                                    }
                                @endphp" method="POST">
                                    @csrf
                                    <div class="card-body text-muted">
                                        <h5 class="card-title">{{ $result->room_suite_name }}</h5>



                                        <p class="sizey">{{ $room_size }} sqm</p>
                                        <p class="none">City View, Free Wifi</p>
                                        <a href="#" class="none"></a>
                                        <a class="isDisabled" data-bs-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Read More
                                        </a>

                                        <div class="collapse" id="collapseExample">
                                            <div class="cards card-body">
                                                this is where to put the pulling data from database.
                                            </div>
                                        </div>
                                        <p class="pricey">{{ $new_price }} PHP/Night</p>
                                        <p class="sizeys">Excluding Taxes and Fee</p>
                                        <a class="isDisabled" id="sizeyss" data-bs-toggle="collapse"
                                            href="#collapseExample" role="button" aria-expanded="false"
                                            aria-controls="collapseExample" Disabled>

                                            <p style="text-align:center">Price Breakdown</p>
                                        </a>

                                        <div class="collapse" id="collapseExample">
                                            <div class="cards card-body">
                                                this is where to put the pulling data from database.
                                            </div>
                                        </div>
                                        <div class="radiobut">
                                            @php
                                                $beds = \App\Models\room_status::where('room_suite_bed', 'like', 'Queen Bed')->where('room_suite_name', '=', $type)->where('status', '=', '0')->count();
                                                // echo $beds;
                                                $b += 1;
                                                $q = $k = true;

                                            @endphp

                                            @if ($beds > 0)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="bed"
                                                        value="Queen Bed" @php
                                                            if (isset($room) && $room == 1) {
                                                                // session('bedcheckerq') = true;
                                                                Session::put('bedcheckerq', true);
                                                                //echo 'yes';
                                                            }
                                                            if (isset($book) && $book !== null) {
                                                                echo 'checked';
                                                            }
                                                            elseif (session('bedcheckerq') !== null && !session('bedcheckerq') && ((session('roomtype2') !== null && session('roomtype2') == $result->room_suite_name) || session('roomtype') == $result->room_suite_name) && (session('bed2') == 'Queen Bed' || session('bed') == 'Queen Bed')) {
                                                                echo 'disabled';
                                                                $q = false;
                                                            }else {
                                                                echo 'checked';
                                                            }
                                                        @endphp>

                                                    <label class="form-check-label">Queen Bed</label>
                                                </div>

                                            @else
                                                @php
                                                    $q = false;
                                                @endphp
                                            @endif


                                            @php
                                                $beds = \App\Models\room_status::where('room_suite_bed', 'like', 'King Bed')
                                                    ->where('room_suite_name', '=', $type)
                                                    ->where('status', '=', '0')
                                                    ->count();
                                                // echo $beds;
                                            @endphp

                                            @if ($beds > 0)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="bed" value="King Bed"
                                                        @php
                                                            if (isset($room) && $room <= 1) {
                                                                // session('bedcheckerk') = true;
                                                                Session::put('bedcheckerk', true);
                                                                //echo 'yes';
                                                            }

                                                            if (session('bedcheckerk') !== null && !session('bedcheckerk') && ((session('roomtype2') !== null && session('roomtype2') == $result->room_suite_name) || session('roomtype') == $result->room_suite_name) && (session('bed2') == 'King Bed' || session('bed') == 'King Bed')) {
                                                                echo 'disabled';
                                                                $k = false;
                                                            } else {
                                                                echo 'checked';
                                                            }
                                                        @endphp>
                                                    <label class="form-check-label">King Bed</label>
                                                </div>

                                            @else
                                                @php
                                                    $k = false;
                                                @endphp

                                            @endif


                                        </div>
                                        <input name="room_type" value="{{ $type }}" hidden>
                                        <input name="rate_type" value="{{ $rateinfo->rate_name }}" hidden>
                                        <input name="total_rate" value={{ $totalrate }} hidden>


                                        @php
                                            $available = \App\Models\room_status::where('status', 0)->where('room_suite_name', '=', $type)->count();

                                            if (session('roomchecker') !== null) {
                                                $roomchecker = session('roomchecker');
                                            }
                                            if (session('roomchecker2') !== null) {
                                                $roomchecker2 = session('roomchecker2');
                                            }



                                        @endphp

                                        @if ($available == 0)
                                            <button id="butbut" class="btn btn-primary"
                                                disabled>ROOM
                                                UNAVAILABLE</button>
                                        @elseif (isset($book) && $book !== null)
                                            <button type="submit" name="chooseroom" id="butbut"
                                            class="btn btn-primary">Select</button>
                                        @elseif ((isset($roomchecker2) && !$roomchecker2 || isset($roomchecker) &&
                                            !$roomchecker)
                                            && (!$q && !$k)
                                            && ((session('roomtype') == $result->room_suite_name)
                                            || (session('roomtype2') !== null && session('roomtype2') ==
                                            $result->room_suite_name))
                                            )

                                            <button name="chooseroom" id="butbut" class="btn btn-primary"
                                                disabled>SELECTED THE LAST AVAILABLE</button>

                                        @else

                                            <button type="submit" name="chooseroom" id="butbut"
                                                class="btn btn-primary">Select</button>

                                        @endif


                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>


        @php
            $rt += 1;
        @endphp


    @endforeach







    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script type="text/javascript">
        $('.slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            centerPadding: 5,
            infinite: false,
        });
    </script> -->




@endsection
