@extends('front.layouts.app')

@section('title', 'Page Not Found')
@section('content')

    <section class="py-5" style="min-height:70vh;display:flex;align-items:center;">
        <div class="container py-5 text-center">
            <div class="simple-process-number mx-auto mb-4" style="width:110px;height:110px;font-size:42px;">
                <i class="fas fa-map-signs"></i>
            </div>
            <div class="section-title st-center">
                <h3>404</h3>
                <p style="font-size:24px;">The page you're looking for doesn't exist or may have been moved.</p>
            </div>
            <a href="{{ route('front.home.index') }}" class="btn btn-main mt-3">Back to Home</a>
        </div>
    </section>

@endsection
