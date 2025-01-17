@extends('layouts.lay')

@section('content')

    <div class="blur-bg-overlay"></div>
    <div class="form-popup">
        <span class="close-btn material-symbols-rounded">close</span>
        <div class="form-box login">
            <div class="form-content">
                <h2>LOGIN</h2>
                <form id="login-form" method="POST" action="{{ route('actionlogin') }}" >
                @csrf
                    <div class="input-field">
                        <input type="text" required>
                        <label>Email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" required>
                        <label>Password</label>
                    </div>
                    <a href="#" class="forgot-pass-link">Forgot password?</a>
                    <button type="submit">Log In</button>
                </form>
                <div class="bottom-link">
                    Don't have an account?
                    <a href="#" id="signup-link">Signup</a>
                </div>
            </div>
        </div>
        <div class="form-box signup">
            <div class="form-content" role="form" method="POST" action="{{ route('register') }}">
                <h2>SIGNUP</h2>
                <form id="signup-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-field">
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                        <label>Enter your first name</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                        <label>Enter your last name</label>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" value="{{ old('email') }}" required>
                        <label>Enter your email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" id="password1" name="password" required>
                        <label>Create password</label>
                        <p id="passwordError1" style="color: red; display: none;">Password setidaknya harus 8 karakter.</p>
                    </div>
                    <div class="input-field">
                        <input type="password" id="password2" name="password_confirmation" required>
                        <label>Confirm password</label>
                        <p id="passwordError2" style="color: red; display: none;">Password tidak sesuai.</p>
                    </div>
                    <button type="submit" id="signup-btn">Sign Up</button>
                </form>
                <div class="bottom-link">
                    Already have an account? 
                    <a href="#" id="login-link">Login</a>
                </div>
            </div>
        </div>
    </div>
<div class="success-popup" style="display: none;">
    <h3>Registration Successful!</h3>
    <!-- Add any additional content or styling for the popup -->
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password1');
            const confirmPasswordInput = document.getElementById('password2');
            const passwordError1 = document.getElementById('passwordError1');
            const passwordError2 = document.getElementById('passwordError2');

            function validatePassword1() {
                if (passwordInput.value.length < 8) {
                    passwordError1.style.display = 'block';
                } else {
                    passwordError1.style.display = 'none';
                    passwordInput.setCustomValidity('');
                }
            }

            function validatePassword2() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    passwordError2.style.display = 'block';
                } else {
                    passwordError2.style.display = 'none';
                    confirmPasswordInput.setCustomValidity('');
                }
            }

            passwordInput.addEventListener('keyup', validatePassword1);
            confirmPasswordInput.addEventListener('keyup', validatePassword2);
    });
</script>
<script>
$(document).ready(function() {
    // Function to handle form submission
    $("#signup-form").submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Send form data to the server using Ajax
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            success: function(response) {
                // If registration is successful, display the popup
                if (response.success) {
                    $(".success-popup").fadeIn(); // You can customize this class or style
                } else {
                    // If there's an error, log it to the console
                    console.log(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle error, if any
                console.log(error);
            }
        });
    });
});
$(document).ready(function() {
        // Function to handle form submission
        $("#login-form").submit(function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Serialize form data
            var formData = $(this).serialize();

            // Send form data to the server using AJAX
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                success: function(response) {
                    // Check if login was successful
                    if (response.success) {
                        // Redirect to dashboard or perform other actions
                        window.location.href = "{{ route('welcome') }}";
                    } else {
                        // Display error message or perform other actions
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error, if any
                    console.log(error);
                }
            });
        });
    });
</script>



