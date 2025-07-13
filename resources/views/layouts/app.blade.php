<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Task Manager</h1>
    @if(session('success'))<p>{{ session('success') }}</p>@endif
    @yield('content')
    <script src="/js/scripts.js"></script>
</body>
</html>
