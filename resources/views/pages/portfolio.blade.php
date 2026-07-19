@extends('layouts.app')

@section('title', 'Ghoza Himma Al Farizqi | Software Developer Portfolio')

@section('meta_description', 'Fresh Graduate D3 Manajemen Informatika dari Politeknik Negeri Jember. Berpengalaman membangun aplikasi web Laravel, mobile Flutter, dan sistem monitoring IoT.')

@section('content')
    <!-- 1. Hero: Who am I? -->
    @include('sections.hero')

    <!-- 2. About: Why should you trust me? -->
    @include('sections.about')

    <!-- 3. Experience: Why am I qualified? -->
    @include('sections.experience')

    <!-- 4. Projects: What have I built? -->
    @include('sections.projects')

    <!-- 5. Skills: How did I build it? -->
    @include('sections.skills')

    <!-- 6. Certificates: How do I keep learning? -->
    @include('sections.certificates')

    <!-- 7. Contact: How can we work together? -->
    @include('sections.contact')

    <!-- 8. Footer -->
    @include('sections.footer')
@endsection
