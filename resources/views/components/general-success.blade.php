@props(['message'])
@if ($message)
    <div class="col-lg-12">
        <div class="alert alert-success bg-transparent text-success" role="alert">
            {{ $message }}
        </div>
    </div>
@endif
