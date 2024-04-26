@props(['generalerrors'])
@if($errors->get('general_errors') || $generalerrors)
<?php
    $errors = $errors->get('general_errors') ? $errors->get('general_errors') : $generalerrors;
?>
<div class="col-lg-12">
    <div class="alert alert-danger bg-transparent text-danger" role="alert">
        @foreach ($errors as $error)
            {{ $error }}
        @endforeach
    </div>
</div>
@endif