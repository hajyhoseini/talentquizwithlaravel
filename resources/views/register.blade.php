<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-xl font-bold text-center mb-4">فرم ثبت‌نام</h2>

        @if(session('success'))
            <p class="text-green-500 text-center">{{ session('success') }}</p>
        @endif

        <form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="first_name">نام:</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}">
        @error('first_name') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="last_name">نام خانوادگی:</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}">
        @error('last_name') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="phone">شماره تلفن:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
        @error('phone') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="password">رمز عبور:</label>
        <input type="password" id="password" name="password">
        @error('password') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="password_confirmation">تایید رمز عبور:</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
    </div>

    <div>
        <button type="submit">ثبت نام</button>
    </div>
</form>

    </div>

</body>
</html>
