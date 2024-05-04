@props(['status'])

<?php
$class = '';
$message = '';

switch ($status) {
    case 'watingforapproval':
        $class = 'warning';
        $message = 'Chờ duyệt';
        break;
    case 'approval':
        $class = 'success';
        $message = 'Đã duyệt';
        break;
    case 'reject':
        $class = 'danger';
        $message = 'Hủy';
        break;
}
?>

<span class="btn btn-{{ $class }} text-white"> {{ $message }}</span>
