<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-500 mx-6 border border-gray-200">
        <h2 class="text-4xl text-center font-bold mb-6">Register</h2>
        
        <form action="/auth/register" method="POST">
            <div class="mb-4">
                <input
                    type="text"
                    name="name"
                    placeholder="Full Name"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-indigo-500" required />
            </div>
            <div class="mb-4">
                <input
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-indigo-500" required />
            </div>
            <div class="mb-4">
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-indigo-500" required />
            </div>
            <div class="mb-6">
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-indigo-500" required />
            </div>
            
            <button
                type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded transition duration-200">
                Register
            </button>
            
            <p class="mt-4 text-sm text-gray-600 text-center">
                Already have an account? <a href="/auth/login" class="text-indigo-600 font-bold underline hover:text-indigo-800">Login</a>
            </p>
        </form>
    </div>
</section>

<?php loadPartial('footer-home'); ?>