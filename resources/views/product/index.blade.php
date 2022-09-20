@extends('template')

@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
    {{-- <iframe src="https://improduction.io/detail-program" frameborder="0" style="width:100%; height:100vh"></iframe> --}}
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            @if (session('message_success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        <div>{{ session('message_success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if (session('message_failed'))
                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        <div>{{ session('message_failed') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                        src="https://images.unsplash.com/photo-1560343090-f0409e92791a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1528&q=80"
                        alt="product-image" /></div>
                <div class="col-md-6">
                    <div class="btn-group mb-5">
                        <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" id="dropdown-title">
                            Select Currency
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdown-localization">
                            <li><a class="dropdown-item" href="{{ route('change-currency', 'ID') }}">Indonesian - Rupiah</a></li>
                            <li><a class="dropdown-item" href="{{ route('change-currency', 'USD') }}">US - Dollar</a></li>
                        </ul>
                    </div>
                    <div class="small mb-1">SKU: BST-498</div>
                    <h1 class="display-5 fw-bolder">Human Race Dream Project 2022 #001 </h1>
                    <div class="fs-5 mb-3">
                        <span>@if(session()->get("localization_currency") == "USD") $ {{ $data['price'] }} @else Rp. {{ $data['price'] }}  @endif</span>
                    </div>
                    <p class="lead mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem
                        quidem
                        modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus
                        ipsam minima ea iste laborum vero?</p>
                    <div class="d-block">
                        @if(session()->get('localization_currency') == 'USD')
                            {{-- <form action="{{ route('paypal-checkout') }}" method="post">

                                @csrf

                                <input type="hidden" name="amount" value="{{ $data['price'] }}">

                                <button type="submit" class="btn btn-outline-dark flex-shrink-0" id="btn-buy">
                                    <i class="bi-cart-fill me-1"></i>
                                    Buy With Paypal
                                </button>
                            </form> --}}

                            <div id="paypal-button-container" data-amount="{{ $data['price'] }}"></div>

                        @else
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" id="btn-buy"
                        data-bs-toggle="modal" data-bs-target="#modal-shipping-form">
                            <i class="bi-cart-fill me-1"></i>
                            Buy With Xendit
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    {{-- modal --}}
    <div class="modal fade" id="modal-shipping-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="data-content p-2">
                        <h5 class="modal-title">Data Customers</h5>
                        <p class="mb-0">Your Invoices will be send to email and whatsapp</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ url()->route('checkout') }}" method="post" class="needs-validation" novalidate
                        autocomplete="off">
                        @csrf
                        <div class="container">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-group">
                                        @foreach ($errors->all() as $error)
                                            <li class="list-group-item">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row align-items-end mb-3">
                                <div class="col-lg-6 form-group has-validation">
                                    <label for="firstname" class="form-label">Name</label>
                                    <input type="text" name="firstname" placeholder="First Name" class="form-control">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <input type="text" name="lastname" placeholder="Last Name" class="form-control">
                                </div>
                            </div>
                            <div class="row align-items-end mb-3">
                                <div class="col-lg-12 form-group">
                                    <label for="phonenumber" class="form-label">Phone Number</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">+62</span>
                                        <input type="text" name="phonenumber" class="form-control"
                                            placeholder="896-123-456">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12 form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" placeholder="youremail@gmail.com"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12 form-group">
                                    <label for="location" class="form-label">location</label>
                                    <select id="location-form" name="location-form" placeholder="Select your location"
                                        autocomplete="off" class="form-control">
                                        <option value="">Select your location...</option>
                                        <option value="denpasar">Denpasar</option>
                                        <option value="jakarta">Jakarta</option>
                                        <option value="Bandung">bandung</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12 form-group">
                                    <label for="Address" class="form-label">Address</label>
                                    <textarea name="address" id="address" class="form-control"
                                        placeholder="please include street name, house number, etc"></textarea>
                                </div>
                            </div>
                            <div class="btn-group mt-4">
                                <button type="submit" class="btn btn-primary ml-auto">Continue To Payment</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency=USD&disable-funding=credit,card"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('js/main.js') }}"></script>
    @if(session()->get('localization_currency') == 'USD')
    <script src="{{ url('js/paypal.js') }}"></script>
    @endif
@endsection
