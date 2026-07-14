@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.error_404.title'))
@section('meta_description', config('constants.PAGE_SEO.error_404.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.error_404.meta_keywords'))
@section('content')

    <!-- Start 404 Error Section -->
    <section class="py-5" style="min-height:70vh;display:flex;align-items:center;">
        <div class="container py-5 text-center">
            <div class="simple-process-number mx-auto mb-4" style="width:110px;height:110px;font-size:42px;">
                <i class="fas fa-map-signs"></i>
            </div>
            <div class="section-title st-center">
                <h3>{{ \App\Helper::sectionTitle('error_404', 'notice', 'title', '404') }}</h3>
                <p style="font-size:24px;">{{ \App\Helper::sectionTitle('error_404', 'notice', 'subtitle') }}</p>
            </div>
            <a href="{{ route('front.home.index') }}" class="btn btn-main mt-3">Back to Home</a>
        </div>
    </section>
    <!-- End 404 Error Section -->

@endsection
