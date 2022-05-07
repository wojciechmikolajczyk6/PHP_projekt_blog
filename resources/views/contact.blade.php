@extends('public_template')

@section('content')
    <div class="container mt-4">
        <!-- Success message -->
        @if(Session::has('succes'))
            <div class="alert alert-success">
                {{Session::get('succes')}}
            </div>
        @endif
        <form action="" method="post" action="{{ route('contact.store') }}">
            <!-- CROSS Site Request Forgery Protection -->
            @csrf


            <div class="form-group col-7">
                <label>Name</label>
                <input type="text" class="form-control {{ $errors->has('name' ? 'error' : '') }}" name="name" id="name">
                @if ($errors->has('name'))
                    <div class="error">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
            </div>


            <div class="form-group col-7">
                <label>Email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email" id="email">
                @if ($errors->has('email'))
                    <div class="error">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
            </div>


            <div class="form-group col-7">
                <label>Subject</label>
                <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" name="subject" id="subject">
                @if ($errors->has('subject'))
                    <div class="error">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
            </div>


            <div class="form-group col-8">
                <label>Message</label>
                <textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" name="message" id="message" rows="4"></textarea>
                @if ($errors->has('message'))
                    <div class="error">
                        {{ $errors->first('message') }}
                    </div>
                @endif

            </div>
            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>




    @endsection
