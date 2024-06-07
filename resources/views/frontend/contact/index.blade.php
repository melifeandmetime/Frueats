{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contact-container">
        <h2>Contact Us</h2>
        <form action="/submit_contact_form" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html> --}}

@extends('layouts.frontend')

@section('content')
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Mitra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body> --}}
    <div class="mitra-info", align="center">
        <h2 style="margin-bottom: 20px;"><strong>FRUEATS By ARKANA</strong></h2>
        <img src="frontend/img/arkana.jpg" style="width: 300px; height: 350px; margin-bottom: 25px;">
        {{-- <img src="{{ asset('frontend/img/arkana.jpg') }}" alt="" /> --}}
        <div class="mitra-details">
            <div class="detail-item">
                <label>Our Partnership:</label>
                <span>ARKANA BUAH</span>
            </div>
            <div class="detail-item">
                <label>Alamat:</label>
                <span>Jl. Samparangin, RT.4/1/RW.no 148, Tasari, Teluk, Kec. Purwokerto Sel., Kabupaten Banyumas, Jawa Tengah 53145</span>
            </div>
            <div class="detail-item">
                <label>No. HP:</label>
                <span>089530830982</span>
            </div>
        </div>
    </div>
{{-- </body>
</html> --}}
    {{-- <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form">
                        <h2>Contact Us</h2> --}}
                        {{-- <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <input type="text" id="subject" name="subject" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea id="message" name="message" rows="4" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form> --}}
                    {{-- </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection