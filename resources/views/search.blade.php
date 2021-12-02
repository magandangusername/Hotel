@extends('layouts.app')

@section('content')
    <form action="{{ route('search.store') }}" method='POST'>
        @csrf
        <div class="container ">

            <div class="row">

                <div class="col text-center py-5">
                    <h1 class="fw-bold">Modify Reservation</h1>
                </div>

            </div>

            <div class="row sectioncolor mx-5">

                <div class="col"></div>
                <div class="col d-flex flex-column px-5 py-5 my-5">
                    @if (isset($_GET['success']))
                        <p class="alert alert-success">{{ $_GET['success'] }}</p>
                    @endif
                    @if (isset($_GET['error']))
                        <p class="alert alert-danger">{{ $_GET['error'] }}</p>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </div>
                    @endif
                    <p class="searchlabel fw-bold"> Reservation Number:</p>
                    <input pattern="[0-9]+" type="text" id="searching" class="form-control " name="confirmation_number">

                    <p class="searchlabel mt-3">Email:</p>
                    <input type="email" id="searching" class="form-control " name="email">

                    <div class="row mx-5 my-5">
                        <button type='submit' class="btn btn-dark fw-bold">Search</button>
                    </div>
                </div>
                <div class="col"></div>

            </div>

        </div>
    </form>
@endsection
