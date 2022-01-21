@extends('frontend.frontend-page-master')
@section('site-title')
    {{ 'Login' }}
@endsection
@section('page-title')
    {{ 'Login' }}
@endsection
@section('content')
<div class="text-center border border-light padding-50 mb-4 btn-ds">
    <a href="https://clinic.umdaa.co" class="btn btn-primary active" role="button" aria-pressed="true">Front Office</a>
    <a href="https://doctor.umdaa.co" class="btn btn-primary active" role="button" aria-pressed="true">Doctors</a>
    <a href="https://citizen.umdaa.co" class="btn btn-primary active" role="button" aria-pressed="true">Citizen</a>
</div>
@endsection
