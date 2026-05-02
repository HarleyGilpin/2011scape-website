@extends('layouts.secure')

@section('title', 'Submit a Ticket')
@section('crumb', 'Submit a Ticket')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Submit a Ticket</h1>
        </div></div></div>
        <div class="section">
            <div class="article">
                @if ($errors->any())
                    <div class="notice"><p>{{ $errors->first() }}</p></div>
                @endif

                <form method="post" action="/support">
                    @csrf
                    <p>
                        <label for="category"><strong>Category:</strong></label><br>
                        <select id="category" name="category" required>
                            @foreach ($categories as $key => $label)
                                <option value="{{ $key }}" @selected(old('category') === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label for="subject"><strong>Subject:</strong></label><br>
                        <input type="text" id="subject" name="subject" maxlength="120" required value="{{ old('subject') }}" style="width:80%">
                    </p>
                    <p>
                        <label for="body"><strong>Details:</strong></label><br>
                        <textarea id="body" name="body" rows="10" maxlength="5000" required style="width:80%">{{ old('body') }}</textarea>
                    </p>
                    <p><button type="submit">Submit ticket</button> &middot; <a href="/support">Cancel</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection
