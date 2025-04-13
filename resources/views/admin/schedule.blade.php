@extends('admin.dashboard') @section('content')
<section>
    <x-arena-table :arenas="$data"/>
</section>
@endsection
