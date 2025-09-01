<?php
// Start the session at the very beginning of the file to access session variables.
// This is critical for knowing if a user is logged in.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Golden Bean Cafe</title>
    <!-- Use Playfair Display for titles and Poppins for body text -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom styles to enhance the aesthetic */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0A0A0A; /* A very dark, almost black background */
            color: #E5E5E5; /* Light gray for text */
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            color: #D4A56E; /* A warm golden-brown for headings */
        }

        /* Fade-in animation for a smooth entrance */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        
        /* Modal specific styling */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px);
        }
        .social-button:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="antialiased">
    <!-- Header and Navigation -->
    <header class="bg-black/50 backdrop-blur-sm fixed top-0 w-full z-50 p-4 shadow-lg transition-all duration-300">
        <nav class="container mx-auto flex items-center justify-between">
            <a href="#" class="text-3xl font-bold text-white transition-transform hover:scale-105">
                The Golden Bean
            </a>
            <div class="space-x-8 hidden md:flex">
                <a href="home.php" class="text-white hover:text-[#D4A56E] transition-colors">Home</a>
                <a href="menu.php" class="text-white hover:text-[#D4A56E] transition-colors">Menu</a>
                <a href="#gallery" class="text-white hover:text-[#D4A56E] transition-colors">Gallery</a>
                <a href="#contact" class="text-white hover:text-[#D4A56E] transition-colors">Contact</a>
            </div>
            <!-- Container for icons and buttons -->
            <div class="flex items-center space-x-4">
                <!-- My Bag icon with count -->
                <button id="cart-btn" class="relative p-2 rounded-full text-white hover:bg-gray-700 transition-colors focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span id="cart-count" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">0</span>
                </button>
                <!-- PHP logic to check if a user is logged in -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- User is logged in, show profile icon and logout link -->
                    <div id="user-profile" class="flex items-center space-x-2">
                        <img src="https://placehold.co/40x40/D4A56E/0A0A0A?text=U" alt="User Profile" class="h-10 w-10 rounded-full cursor-pointer transition-transform hover:scale-110">
                        <a href="index.php?logout" class="text-white hover:text-[#D4A56E] transition-colors">Logout</a>
                    </div>
                <?php else: ?>
                    <!-- User is not logged in, show login/signup buttons -->
                    <div id="auth-buttons" class="flex items-center space-x-2">
                        <button id="login-btn" class="bg-[#D4A56E] text-black px-4 py-2 rounded-full font-bold shadow-lg hover:bg-yellow-700 transition-colors">
                            Login
                        </button>
                        <button id="signup-btn" class="bg-transparent border border-[#D4A56E] text-[#D4A56E] px-4 py-2 rounded-full font-bold shadow-lg hover:bg-[#D4A56E] hover:text-black transition-colors">
                            Signup
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- The Cart Modal -->
    <div id="cart-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Modal Overlay -->
        <div class="modal-overlay absolute inset-0"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-white p-6 rounded-2xl shadow-2xl max-w-lg w-full" style="background-color: #2a2a2a;">
            <!-- Close button -->
            <button id="close-cart-btn" class="absolute top-4 right-4 text-gray-500 hover:text-gray-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="text-center mb-6">
                <h3 class="text-3xl font-bold playfair-display" style="color: #D4A56E;">My Bag</h3>
            </div>
            
            <!-- Cart items list -->
            <div id="cart-items" class="space-y-4 overflow-y-auto max-h-80">
                <!-- Cart items will be populated here -->
                <p class="text-center text-gray-400 italic">Your bag is empty.</p>
            </div>
            
            <!-- Totals section -->
            <div class="mt-6 border-t pt-4" style="border-color: #3d3d3d;">
                <div class="flex justify-between items-center text-sm">
                    <span style="color: #6c6c6c;">Subtotal</span>
                    <span id="cart-subtotal" style="color: #D4A56E;">₱0.00</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span style="color: #6c6c6c;">Delivery fee</span>
                    <span id="delivery-fee" style="color: #D4A56E;">₱49.00</span>
                </div>
                <div class="flex justify-between items-center font-bold text-lg mt-2">
                    <span>Total</span>
                    <span id="cart-total" style="color: #D4A56E;">₱0.00</span>
                </div>
            </div>
            
            <!-- Action buttons -->
            <div class="mt-6 flex justify-center">
                <button class="w-full bg-yellow-800 text-white font-bold py-3 px-6 rounded-full shadow hover:bg-yellow-700 transition-colors" style="background-color: #D4A56E; color: #0A0A0A;">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- The Login/Signup Modal -->
    <div id="auth-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Modal Overlay -->
        <div class="modal-overlay absolute inset-0"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm" style="background-color: #2a2a2a;">
            <!-- Close button -->
            <button id="close-auth-btn" class="absolute top-4 right-4 text-gray-500 hover:text-gray-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="text-center mb-6">
                <h3 id="auth-title" class="text-3xl font-bold playfair-display" style="color: #D4A56E;">Welcome to Our Cafe</h3>
            </div>
            
            <!-- Login Form (Initially visible) -->
            <form id="login-form" action="index.php" method="POST" class="space-y-4">
                <div>
                    <label for="login-email" class="block text-sm font-medium text-gray-400">Email Address</label>
                    <input type="email" id="login-email" name="login-email" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-yellow-600 focus:ring-yellow-600 sm:text-sm p-2">
                </div>
                <div>
                    <label for="login-password" class="block text-sm font-medium text-gray-400">Password</label>
                    <input type="password" id="login-password" name="login-password" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-yellow-600 focus:ring-yellow-600 sm:text-sm p-2">
                </div>
                <button type="submit" name="login" class="w-full bg-[#D4A56E] text-black px-4 py-3 rounded-full font-bold shadow-lg hover:bg-yellow-700 transition-colors">
                    Log in
                </button>
            </form>

            <!-- Signup Form (Initially hidden) -->
            <form id="signup-form" action="index.php" method="POST" class="space-y-4 hidden">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="signup-first-name" class="block text-sm font-medium text-gray-400">First Name</label>
                        <input type="text" id="signup-first-name" name="signup-first-name" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-yellow-600 focus:ring-yellow-600 sm:text-sm p-2">
                    </div>
                    <div>
                        <label for="signup-last-name" class="block text-sm font-medium text-gray-400">Last Name</label>
                        <input type="text" id="signup-last-name" name="signup-last-name" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-yellow-600 focus:ring-yellow-600 sm:text-sm p-2">
                    </div>
                </div>
                <div>
                    <label for="signup-email" class="block text-sm font-medium text-gray-400">Email Address</label>
                    <input type="email" id="signup-email" name="signup-email" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-yellow-600 focus:ring-yellow-600 sm:text-sm p-2">
                </div>
                <div>
                    <label for="signup-phone" class="block text-sm font-medium text-gray-400">Phone Number</label>
                    <input type="tel" id="signup-phone" name="signup-phone" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-yellow-600 focus:ring-yellow-600 sm:text-sm p-2">
                </div>
                <div>
                    <label for="signup-password" class="block text-sm font-medium text-gray-400">Password</label>
                    <input type="password" id="signup-password" name="signup-password" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-yellow-600 focus:ring-yellow-600 sm:text-sm p-2">
                </div>
                <div>
                    <label for="signup-confirm-password" class="block text-sm font-medium text-gray-400">Confirm Password</label>
                    <input type="password" id="signup-confirm-password" name="signup-confirm-password" required class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white shadow-sm focus:border-yellow-600 focus:ring-yellow-600 sm:text-sm p-2">
                </div>
                <button type="submit" name="signup" class="w-full bg-[#D4A56E] text-black px-4 py-3 rounded-full font-bold shadow-lg hover:bg-yellow-700 transition-colors">
                    Create Account
                </button>
            </form>

            <!-- Social login section -->
            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-700"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="bg-[#2a2a2a] px-2 text-gray-400">Or continue with</span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-3 gap-3">
                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-700 rounded-lg shadow-sm text-sm font-medium text-gray-400 bg-gray-900 hover:bg-gray-800 transition social-button">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    <span class="hidden md:inline">Google</span>
                </a>
                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-700 rounded-lg shadow-sm text-sm font-medium text-gray-400 bg-gray-900 hover:bg-gray-800 transition social-button">
                    <i class="fab fa-facebook-f text-blue-600 mr-2"></i>
                    <span class="hidden md:inline">Facebook</span>
                </a>
                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-700 rounded-lg shadow-sm text-sm font-medium text-gray-400 bg-gray-900 hover:bg-gray-800 transition social-button">
                    <i class="fab fa-apple text-gray-100 mr-2"></i>
                    <span class="hidden md:inline">Apple</span>
                </a>
            </div>

            <!-- Form toggle link -->
            <p id="auth-toggle-text" class="text-center text-sm text-gray-400 mt-4">
                Don't have an account? <a href="#" id="toggle-form" class="font-medium text-amber-600 hover:text-amber-500">Sign up</a>
            </p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let cart = []; // A simple array to store cart items
            const DELIVERY_FEE = 49.00;

            /**
             * Renders the items currently in the cart.
             */
            function renderCart() {
                const cartItemsContainer = document.getElementById('cart-items');
                const cartCountElement = document.getElementById('cart-count');
                const subtotalElement = document.getElementById('cart-subtotal');
                const totalElement = document.getElementById('cart-total');
                let subtotal = 0;

                cartItemsContainer.innerHTML = ''; // Clear previous items

                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = '<p class="text-center text-gray-400 italic">Your bag is empty.</p>';
                } else {
                    cart.forEach(item => {
                        subtotal += item.price;
                        const itemHTML = `
                            <div class="flex justify-between items-center bg-gray-800 p-3 rounded-lg">
                                <div class="flex-1">
                                    <p class="font-semibold" style="color: #D4A56E;">${item.name}</p>
                                    <p class="text-sm text-gray-500">${item.options}</p>
                                </div>
                                <span class="font-bold" style="color: #D4A56E;">₱${item.price.toFixed(2)}</span>
                            </div>
                        `;
                        cartItemsContainer.innerHTML += itemHTML;
                    });
                }

                // Update totals and count
                const total = subtotal + (subtotal > 0 ? DELIVERY_FEE : 0);
                cartCountElement.textContent = cart.length;
                subtotalElement.textContent = `₱${subtotal.toFixed(2)}`;
                totalElement.textContent = `₱${total.toFixed(2)}`;

                document.getElementById('cart-modal').classList.remove('hidden');
            }

            /**
             * Closes the cart modal.
             */
            function closeCartModal() {
                const modal = document.getElementById('cart-modal');
                modal.classList.add('hidden');
            }

            // --- Authentication Modal Functions ---

            /**
             * Opens the authentication modal and displays the specified form.
             * @param {string} formType - The form to show ('login' or 'signup').
             */
            function openAuthModal(formType) {
                const modal = document.getElementById('auth-modal');
                const loginForm = document.getElementById('login-form');
                const signupForm = document.getElementById('signup-form');
                const authTitle = document.getElementById('auth-title');
                const toggleText = document.getElementById('auth-toggle-text');

                if (formType === 'login') {
                    loginForm.classList.remove('hidden');
                    signupForm.classList.add('hidden');
                    authTitle.textContent = 'Welcome to Our Cafe';
                    toggleText.innerHTML = 'Don\'t have an account? <a href="#" id="toggle-form" class="font-medium text-amber-600 hover:text-amber-500">Sign up</a>';
                } else if (formType === 'signup') {
                    loginForm.classList.add('hidden');
                    signupForm.classList.remove('hidden');
                    authTitle.textContent = 'Join Us Today!';
                    toggleText.innerHTML = 'Already have an account? <a href="#" id="toggle-form" class="font-medium text-amber-600 hover:text-amber-500">Log in</a>';
                }

                modal.classList.remove('hidden');
                
                // Add event listener for the new toggle link
                document.getElementById('toggle-form').addEventListener('click', (e) => {
                    e.preventDefault();
                    // Toggle between login and signup forms within the modal
                    if (loginForm.classList.contains('hidden')) {
                        openAuthModal('login');
                    } else {
                        openAuthModal('signup');
                    }
                });
            }

            /**
             * Closes the authentication modal.
             */
            function closeAuthModal() {
                const modal = document.getElementById('auth-modal');
                modal.classList.add('hidden');
            }

            // --- EVENT LISTENERS ---
            
            // Add event listener for the main cart button in the header
            document.getElementById('cart-btn').addEventListener('click', renderCart);

            // Add event listeners for closing the cart modal
            document.getElementById('close-cart-btn').addEventListener('click', closeCartModal);
            document.getElementById('cart-modal').addEventListener('click', (event) => {
                if (event.target.classList.contains('modal-overlay')) {
                    closeCartModal();
                }
            });

            // Add event listeners for the authentication buttons
            document.getElementById('login-btn').addEventListener('click', () => {
                openAuthModal('login');
            });
            document.getElementById('signup-btn').addEventListener('click', () => {
                openAuthModal('signup');
            });

            // Add event listener for closing the authentication modal
            document.getElementById('close-auth-btn').addEventListener('click', closeAuthModal);
            document.getElementById('auth-modal').addEventListener('click', (event) => {
                if (event.target.classList.contains('modal-overlay')) {
                    closeAuthModal();
                }
            });
        });
    </script>
</body>
</html>
