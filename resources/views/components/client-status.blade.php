@props(['status'])
<?php
$label = '';
switch ($status) {
    case config('constants.user.status.created'):
        $class = 'bg-warning text-warning';
        $label = 'Chưa kích hoạt';
        break;
    case config('constants.user.status.active'):
        $class = 'bg-success text-success';
        $label = 'Hoạt động';
        break;

    default:
        $class = 'bg-danger text-danger';
        $label = 'Chặn';
        break;
}
?>
<span class="bg-opacity-10 fs-13 fw-semibold py-1 px-2 rounded-1 {{ $class }} {{$status}}">{{ $label }}</span>
