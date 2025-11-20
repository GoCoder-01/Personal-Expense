<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}">
    <style>
        body {
            box-sizing: border-box;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .pulse-success {
            animation: pulseSuccess 0.6s ease-in-out;
        }
        
        @keyframes pulseSuccess {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .dark .dark-bg {
            background-color: #1f2937;
        }
        
        .dark .dark-card {
            background-color: #374151;
        }
        
        .dark .dark-text {
            color: #f9fafb;
        }
        
        .dark .dark-border {
            border-color: #4b5563;
        }
        
        .input-error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .input-success {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        
        .otp-input {
            width: 3rem;
            height: 3rem;
            text-align: center;
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .loading-spinner {
            border: 2px solid #f3f4f6;
            border-top: 2px solid #0ea5e9;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300 min-h-full">
    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-32 w-80 h-80 gradient-bg rounded-full opacity-10"></div>
        <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-gradient-to-r from-accent to-yellow-500 rounded-full opacity-10"></div>
    </div>

    <!-- Main Container -->
    <div class="relative min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo and Header -->
            <div class="text-center fade-in">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-400">Personal Finance</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Sign in to Manage Your Personal Finance</p>
            </div>
            <!-- Login Form -->
            <div id="loginForm" class="bg-white dark:dark-card rounded-2xl shadow-xl p-8 fade-in">
                <form id="login-form-get-otp" class="space-y-6" method="POST">
                    @csrf
                    <!-- Phone Number Input -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-800 mb-2">
                            Phone Number
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone"
                                class="w-full pl-10 pr-4 py-3 border rounded-lg focus:border-transparent dark:text-gray-800 transition-all duration-200" 
                                placeholder="username"
                                required
                            >
                        </div>
                        <div id="phoneError" class="mt-1 text-sm text-red-600 hidden"></div>
                        <div id="phoneSuccess" class="mt-1 text-sm text-green-600 hidden"></div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-800 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password"
                                class="w-full pl-10 pr-12 py-3 border rounded-lg focus:border-transparent dark:text-gray-800 transition-all duration-200" 
                                placeholder="Enter your password"
                                required
                            >
                            <button 
                                type="button" 
                                id="eyeicon"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            >
                                <i class="fa-solid fa-eye-slash"></i>
                            </button>
                        </div>
                        <div id="passwordError" class="mt-1 text-sm text-red-600 hidden"></div>
                        <div id="passwordSuccess" class="mt-1 text-sm text-green-600 hidden"></div>
                        <div id="otpError" class="mt-1 text-sm text-red-600 hidden"></div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                            >
                            <label for="remember" class="ml-2 block text-sm text-gray-800">
                                Remember me
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-primary hover:text-blue-600 transition-colors">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit" 
                            id="loginButton"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white gradient-bg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-105"
                        >
                            <span id="loginButtonText">Sign in</span>
                            <div id="loginSpinner" class="loading-spinner ml-2 hidden"></div>
                        </button>
                    </div>
                </form>
            </div>

            <!-- OTP Verification Form -->
            <div id="otpForm" class="bg-white dark:dark-card rounded-2xl shadow-xl p-8 hidden">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:dark-text mb-2">Verify Your Phone</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        We've sent a 6-digit code to <span id="maskedPhone" class="font-medium text-gray-900 dark:dark-text"></span>
                    </p>
                </div>

                <form onsubmit="handleOTPVerification(event)" class="space-y-6">
                    <!-- OTP Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 text-center">
                            Enter Verification Code
                        </label>
                        <div class="flex justify-center space-x-2 mb-4">
                            <input type="hidden" name="token" value="" id="token">
                            <input type="text" maxlength="1" class="otp-input border dark:dark-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200" oninput="moveToNext(this, 0)" onkeydown="handleBackspace(this, 0, event)">
                            <input type="text" maxlength="1" class="otp-input border dark:dark-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200" oninput="moveToNext(this, 1)" onkeydown="handleBackspace(this, 1, event)">
                            <input type="text" maxlength="1" class="otp-input border dark:dark-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200" oninput="moveToNext(this, 2)" onkeydown="handleBackspace(this, 2, event)">
                            <input type="text" maxlength="1" class="otp-input border dark:dark-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200" oninput="moveToNext(this, 3)" onkeydown="handleBackspace(this, 3, event)">
                            <input type="text" maxlength="1" class="otp-input border dark:dark-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200" oninput="moveToNext(this, 4)" onkeydown="handleBackspace(this, 4, event)">
                            <input type="text" maxlength="1" class="otp-input border dark:dark-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200" oninput="moveToNext(this, 5)" onkeydown="handleBackspace(this, 5, event)">
                        </div>
                        <div id="otpError" class="text-sm text-red-600 text-center hidden"></div>
                        <div id="otpSuccess" class="text-sm text-green-600 text-center hidden"></div>
                    </div>

                    <!-- Timer and Resend -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                            OTP expires in <span id="timer" class="font-medium text-accent">05:00</span>
                        </p>
                        <button 
                            type="button" 
                            id="resendButton"
                            onclick="resendOTP()" 
                            class="text-sm font-medium text-primary hover:text-blue-600 transition-colors disabled:text-gray-400 disabled:cursor-not-allowed"
                            disabled
                        >
                            Resend Code
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <div class="space-y-3">
                        <button 
                            type="submit" 
                            id="verifyButton"
                            class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-success hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105"
                        >
                            <span id="verifyButtonText">Verify & Continue</span>
                            <div id="verifySpinner" class="loading-spinner ml-2 hidden"></div>
                        </button>
                        
                        <button 
                            type="button" 
                            onclick="backToLogin()"
                            class="w-full py-3 px-4 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200"
                        >
                            Back to Login
                        </button>
                    </div>
                </form>
            </div>

            <!-- Success Message -->
            <div id="successMessage" class="bg-white dark:dark-card rounded-2xl shadow-xl p-8 text-center hidden">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4 pulse-success">
                    <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:dark-text mb-2">Login Successful!</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Redirecting to your dashboard...</p>
                <div class="loading-spinner mx-auto"></div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script>
        $(document).ready(function() {

            // Validate phone number
            function validatePhone(phone) {
                const phoneRegex = /^\+?[\d\s\-\(\)]{10,}$/;
                return phoneRegex.test(phone.replace(/\s/g, ''));
            }

            // Validate password
            function validatePassword(password) {
                return password.length >= 6;
            }

            // Show error message
            function showError(elementId, message) {
                const $errorElement = $('#' + elementId);
                const $inputElement = $('#' + elementId.replace('Error', ''));

                $errorElement.text(message).removeClass('hidden');
                $inputElement.addClass('input-error');
                $inputElement.parent().addClass('shake');

                setTimeout(() => {
                    $inputElement.parent().removeClass('shake');
                }, 500);
            }

            // Show success message
            function showSuccess(elementId, message) {
                const $successElement = $('#' + elementId);
                const $inputElement = $('#' + elementId.replace('Success', ''));

                $successElement.text(message).removeClass('hidden');
                $inputElement.addClass('input-success');
            }

            // Clear previous validation states
            function clearValidation(elementId) {
                const $errorElement = $('#' + elementId + 'Error');
                const $successElement = $('#' + elementId + 'Success');
                const $inputElement = $('#' + elementId);

                $errorElement.addClass('hidden');
                $successElement.addClass('hidden');
                $inputElement.removeClass('input-error input-success');
            }

            // Real-time phone validation
            $('#phone').on('input', function() {
                clearValidation('phone');
                const phone = $.trim($(this).val());

                if (phone.length > 0)
                {
                    if (validatePhone(phone)) 
                    {
                        showSuccess('phoneSuccess', 'Valid phone number');
                    } else if (phone.length >= 5) {
                        showError('phoneError', 'Please enter a valid phone number');
                    }
                }
            });

            // Real-time password validation
            $('#password').on('input', function() {
                clearValidation('password');
                const password = $(this).val();

                if (password.length > 0)
                {
                    if (validatePassword(password)) 
                    {
                        showSuccess('passwordSuccess', 'Strong Password');
                    } else {
                        showError('passwordError', 'Password must be at least 6 characters');
                    }
                }
            });

            // Attach password toggle to button/icon click
            $('#eyeicon').on('click', function(){
                const $passwordInput = $('#password');
                const $eyeicon = $('#eyeicon');

                if ($passwordInput.attr('type') === 'password')
                {
                    $passwordInput.attr('type', 'text');
                    $eyeicon.html(`<i class="fa-solid fa-eye"></i>`);
                } else {
                    $passwordInput.attr('type', 'password');
                    $eyeicon.html(`<i class="fa-solid fa-eye-slash"></i>`);
                }
            });

            $('#login-form-get-otp').on('submit', function(event){
                event.preventDefault();
                const phone = $.trim($('#phone').val());
                const password = $('#password').val();
                const loginButton = $('#loginButton');
                const loginButtonText = $('#loginButtonText');
                const loginSpinner = $('#loginSpinner');

                // Clear previous validations
                clearValidation('phone');
                clearValidation('password');

                let isValid = true;

                // Validate phone
                if (!phone) {
                    showError('phoneError', 'Phone number is required');
                    isValid = false;
                } else if (!validatePhone(phone)) {
                    showError('phoneError', 'Please enter a valid phone number');
                    isValid = false;
                }

                // Validate password
                if (!password) {
                    showError('passwordError', 'Password is required');
                    isValid = false;
                } else if (!validatePassword(password)) {
                    showError('passwordError', 'Password must be at least 6 characters');
                    isValid = false;
                }

                if (!isValid) return;

                // Show loading state
                loginButton.prop('disabled', true);
                loginButtonText.text('Signing in...');
                loginSpinner.removeClass('hidden');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get-otp') }}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        username: phone,
                        password: password
                    },
                    success: function(response) {
                        if(response.error_status == false)
                        {
                            $('#loginForm').addClass('hidden');
                            $('#otpForm').removeClass('hidden').addClass('slide-in');
                            $('#token').val(response.data);
                            $('#maskedPhone').text(maskPhoneNumber(phone));
                            startOTPTimer();
                            $('.otp-input').first().focus();
                        } 
                        else if (response.error_status == true) 
                        {
                            showError('otpError', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        showError('otpError', 'Technical Issue..');
                    }
                    });

                // Simulate API call
                setTimeout(() => {
                    loginButton.prop('disabled', false);
                    loginButtonText.text('Sign in');
                    loginSpinner.addClass('hidden');
                }, 1500);
                
            });
        });

        // Login form submission

        // Mask phone number for display
        function maskPhoneNumber(phone) {
            var cleaned = phone.replace(/\D/g, '');
            if (cleaned.length >= 10) {
                return "******-" + cleaned.slice(-4);
            }
            return phone;
        }

        // OTP input handling
        function moveToNext(current, index) 
        {
            // Convert current to jQuery object
            var $current = $(current);

            if ($current.val().length === 1 && index < 5) {
                var $nextInput = $('.otp-input').eq(index + 1);
                $nextInput.focus();
            }

            // Auto-submit when all fields are filled
            var allFilled = $('.otp-input').toArray().every(function(input){
                return $(input).val().length === 1;
            });

            if (allFilled) 
            {
                $('#otpForm form').trigger('submit');
            }
        }

        function handleBackspace(current, index, event) 
        {
            var $current = $(current);

            if (event.key === "Backspace" && $current.val() === "" && index > 0) 
            {
                var $prevInput = $('.otp-input').eq(index - 1);
                $prevInput.focus();
            }
        }

        // OTP Timer
        let timerInterval;

        function startOTPTimer() 
        {
            let timeLeft = 300; // 5 minutes
            var $timerElement = $('#timer');
            var $resendButton = $('#resendButton');

            timerInterval = setInterval(function () {
                var minutes = Math.floor(timeLeft / 60);
                var seconds = timeLeft % 60;

                $timerElement.text(
                    minutes.toString().padStart(2, '0') + ':' + 
                    seconds.toString().padStart(2, '0')
                );

                if (timeLeft <= 0) 
                {
                    clearInterval(timerInterval);
                    $timerElement.text('00:00');
                    $resendButton.prop('disabled', false);
                    $resendButton.text('Resend Code');
                }

                timeLeft--;
            }, 1000);
        }

        // Resend OTP
        function resendOTP() {
            var $resendButton = $('#resendButton');
            $resendButton.prop('disabled', true);
            $resendButton.text('Sending...');

            // Clear OTP inputs
            $('.otp-input').each(function () {
                $(this).val('');
                $(this).removeClass('input-error input-success');
            });

            // Clear messages
            $('#otpError').addClass('hidden');
            $('#otpSuccess').addClass('hidden');

            setTimeout(function () {
                startOTPTimer();

                // Focus on first OTP input
                $('.otp-input').eq(0).focus();

                // Show success message
                var $successElement = $('#otpSuccess');
                $successElement.text('New code sent successfully!');
                $successElement.removeClass('hidden');

                setTimeout(function () {
                    $successElement.addClass('hidden');
                }, 3000);

            }, 1000);
        }

        // OTP Verification
        function handleOTPVerification(event) 
        {
            event.preventDefault();

            var $otpInputs = $('.otp-input');
            var otp = $otpInputs.map(function () { 
                return $(this).val(); 
            }).get().join('');

            var $token = $('#token');  // hidden token input

            var $verifyButton = $('#verifyButton');
            var $verifyButtonText = $('#verifyButtonText');
            var $verifySpinner = $('#verifySpinner');

            // Clear previous messages
            $('#otpError').addClass('hidden').text('');
            $('#otpSuccess').addClass('hidden').text('');

            // Validate OTP length
            if (otp.length !== 6) {
                $('#otpError').text('Please enter all 6 digits').removeClass('hidden');
                $otpInputs.addClass('input-error');
                return;
            }

            // UI Loading State
            $verifyButton.prop('disabled', true);
            $verifyButtonText.text('Verifying...');
            $verifySpinner.removeClass('hidden');

            $.ajax({
                url: "{{ route('verify-otp') }}",
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    token: $token.val(),   // FIXED
                    otp: otp
                },

                success: function(response) 
                {
                    if (response.error_status === false) 
                    {
                        // success
                        $otpInputs.addClass('input-success');

                        $('#otpForm').addClass('hidden');
                        $('#successMessage').removeClass('hidden').addClass('fade-in');

                        window.location.href = "/dashboard";
                    } 
                    else 
                    {
                        // invalid otp
                        $('#otpError')
                            .text('Invalid verification code. Please try again.')
                            .removeClass('hidden');

                        $otpInputs
                            .val('')
                            .removeClass('input-success')
                            .addClass('input-error');

                        $('.otp-input').eq(0).focus();
                    }
                },

                error: function(xhr) 
                {
                    $('#otpError')
                        .text('Technical issue. Please try again.')
                        .removeClass('hidden');
                },

                complete: function() 
                {
                    // always executed
                    $verifyButton.prop('disabled', false);
                    $verifyButtonText.text('Verify & Continue');
                    $verifySpinner.addClass('hidden');
                }
            });
        }


        // Back to login
        function backToLogin() 
        {
            // Hide OTP form and show Login form
            $('#otpForm').addClass('hidden');
            $('#loginForm').removeClass('hidden').addClass('fade-in');

            // Clear OTP inputs
            $('.otp-input').each(function () {
                $(this).val('');
                $(this).removeClass('input-error input-success');
            });

            // Clear timer
            clearInterval(timerInterval);

            // Clear messages
            $('#otpError').addClass('hidden');
            $('#otpSuccess').addClass('hidden');
        }

        // Prevent form submission on Enter in OTP inputs
        $('.otp-input').on('keydown', function (event) {
            if (event.key === 'Enter') 
            {
                event.preventDefault();
                var form = $(this).closest('form');
                form.trigger('submit');
            }
        });

        // Auto-focus first input on page load
        $(document).ready(function () {
            $('#phone').focus();
        });

    </script>
    
    </body>
</html>
