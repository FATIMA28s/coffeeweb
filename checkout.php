<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Golden Bean Cafe Checkout</title>
    <!-- Use Playfair Display for titles and Poppins for body text, as per your menu.php -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles to enhance the aesthetic */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1a1a1a; /* A very dark, almost black background */
            color: #e5e5e5; /* Light gray for text */
        }
        h1, h2, h3, .playfair-display {
            font-family: 'Playfair Display', serif;
            color: #D4A56E; /* A warm golden-brown for headings */
        }
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #2a2a2a;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #d4a56e;
            border-radius: 20px;
            border: 2px solid #1a1a1a;
        }
        /* Custom focus ring color to match the theme */
        input:focus, select:focus, textarea:focus {
            --tw-ring-color: #D4A56E;
            --tw-ring-offset-color: #1a1a1a;
        }
        /* Style for a custom message box instead of alert() */
        #message-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
            background-color: #2a2a2a;
            border: 2px solid #D4A56E;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            max-width: 400px;
            text-align: center;
        }
        
        .radio-card {
            border: 1px solid #4a4a4a;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border-radius: 8px;
        }
        .radio-card input[type="radio"]:checked + label {
            background-color: #D4A56E;
            color: #1a1a1a;
            font-weight: 600;
            border-color: #D4A56E;
        }

    </style>
</head>
<body class="bg-[#1a1a1a] min-h-screen p-4 sm:p-6 lg:p-8">
    
    <!-- Main Container for the entire page -->
    <div class="max-w-7xl mx-auto md:flex md:space-x-8">

        <!-- Left Column: Checkout Form -->
        <main class="md:w-2/3 lg:w-3/5 mb-8 md:mb-0">
            <h1 class="text-3xl sm:text-4xl font-bold mb-6 text-center md:text-left text-[#D4A56E]">Checkout</h1>

            <!-- Form Card Wrapper -->
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8">
                <form id="checkoutForm">
                    
                    <!-- Section: Contact & Delivery Information -->
                    <h2 class="text-2xl font-semibold mb-4 text-[#D4A56E]">Contact Information</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="fullName" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                            <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200">
                        </div>
                        <div>
                            <label for="mobileNumber" class="block text-sm font-medium text-gray-300 mb-1">Mobile Number</label>
                            <input type="tel" id="mobileNumber" name="mobileNumber" placeholder="Enter your mobile number" class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email address" class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200">
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold mb-4 text-[#D4A56E]">Delivery Address</h2>
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <!-- Placeholder for a map or location pin icon -->
                        <div class="w-full h-48 bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 text-lg font-medium">
                            Map Placeholder
                        </div>
                        <div>
                            <label for="building" class="block text-sm font-medium text-gray-300 mb-1">Building/Unit/Floor No.</label>
                            <input type="text" id="building" name="building" placeholder="Enter building/unit/floor no." class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200">
                        </div>
                        <div>
                            <label for="street" class="block text-sm font-medium text-gray-300 mb-1">Street Address</label>
                            <input type="text" id="street" name="street" placeholder="Enter street address" class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-300 mb-1">City</label>
                                <input type="text" id="city" name="city" placeholder="Enter city" class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200">
                            </div>
                            <div>
                                <label for="postalCode" class="block text-sm font-medium text-gray-300 mb-1">Postal Code</label>
                                <input type="text" id="postalCode" name="postalCode" placeholder="Enter postal code" class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200">
                            </div>
                        </div>
                        <div>
                            <label for="deliveryNotes" class="block text-sm font-medium text-gray-300 mb-1">Delivery Notes (Optional)</label>
                            <textarea id="deliveryNotes" name="deliveryNotes" rows="3" placeholder="e.g., Leave at the door, call upon arrival, etc." class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200"></textarea>
                        </div>
                    </div>
                    
                    <!-- Section: Promos and Discounts -->
                    <h2 class="text-2xl font-semibold mb-4 text-[#D4A56E]">Promos and Discounts</h2>
                    <div class="bg-gray-700 rounded-xl p-4 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <label for="promoCode" class="text-gray-300">Apply a Promo Coupon</label>
                            <span class="text-[#D4A56E] font-medium cursor-pointer">Select</span>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <label for="giftCertificate" class="text-gray-300">Apply a Gift Certificate</label>
                            <span class="text-[#D4A56E] font-medium cursor-pointer">Select</span>
                        </div>
                        <div class="flex flex-col space-y-4">
                            <label for="seniorPwd" class="text-gray-300">Senior Citizen / PWD Discount</label>
                            <select id="seniorPwd" class="bg-gray-600 text-gray-300 rounded-lg px-2 py-1 focus:outline-none">
                                <option value="">Select</option>
                                <option value="senior">Senior Citizen</option>
                                <option value="pwd">PWD</option>
                            </select>
                            <input type="text" id="seniorPwdId" name="seniorPwdId" placeholder="ID Number" class="bg-gray-600 text-gray-100 rounded-lg px-2 py-1 hidden focus:outline-none focus:ring-1 focus:ring-[#D4A56E]">
                        </div>
                    </div>
                    
                    <!-- Section: Payment Method -->
                    <h2 class="text-2xl font-semibold mb-4 text-[#D4A56E]">Payment</h2>
                    <div class="space-y-4 mb-6">
                        <!-- Cash on Delivery -->
                        <div class="radio-card p-4">
                            <input type="radio" id="cod" name="paymentMethod" value="Cash on Delivery" class="peer hidden" checked>
                            <label for="cod" class="flex items-center justify-between text-gray-300">
                                <span>Cash on Delivery</span>
                                <!-- A placeholder for an icon could go here if needed -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.057 60.057 0 0115.79-11.399m-1.049-.374a59.065 59.065 0 011.962 3.897M18 10.5a5.25 5.25 0 00-10.5 0v2.25H5.25a2.25 2.25 0 00-2.25 2.25v5.25a2.25 2.25 0 002.25 2.25h13.5a2.25 2.25 0 002.25-2.25V15.75a2.25 2.25 0 00-2.25-2.25H15V10.5z" />
                                </svg>
                            </label>
                            <!-- Change for input, visible only when Cash on Delivery is selected -->
                            <div id="change-for-section" class="mt-4 pl-6">
                                <label for="changeFor" class="block text-sm font-medium text-gray-300 mb-1">Change For</label>
                                <input type="number" id="changeFor" name="changeFor" placeholder="0" class="w-24 px-4 py-2 bg-gray-600 text-gray-100 border border-gray-500 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#D4A56E] transition-colors duration-200">
                            </div>
                        </div>

                        <!-- Paymaya -->
                        <div class="radio-card p-4">
                            <input type="radio" id="paymaya" name="paymentMethod" value="Paymaya" class="peer hidden">
                            <label for="paymaya" class="flex items-center justify-between text-gray-300">
                                <span>Paymaya</span>
                                <!-- Placeholder for Paymaya logo -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                            </label>
                        </div>
                        
                        <!-- Debit / Credit Card -->
                        <div class="radio-card p-4">
                            <input type="radio" id="debitCredit" name="paymentMethod" value="Debit / Credit Card" class="peer hidden">
                            <label for="debitCredit" class="flex items-center justify-between text-gray-300">
                                <span>Debit / Credit Card</span>
                                <!-- Placeholder for Card icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                            </label>
                        </div>

                        <!-- Gcash -->
                        <div class="radio-card p-4">
                            <input type="radio" id="gcash" name="paymentMethod" value="Gcash" class="peer hidden">
                            <label for="gcash" class="flex items-center justify-between text-gray-300">
                                <span>Gcash</span>
                                <!-- Placeholder for Gcash logo -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Submission Button -->
                    <div class="mt-6 flex justify-center">
                        <button type="submit" id="continueToPaymentBtn" class="w-full bg-[#D4A56E] text-gray-900 text-lg font-bold py-3 rounded-lg shadow-lg hover:bg-amber-600 transition-colors duration-200">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Right Column: Order Summary -->
        <aside class="md:w-1/3 lg:w-2/5">
            <h2 class="text-3xl font-semibold mb-4 text-center md:text-left text-[#D4A56E]">Order Summary</h2>
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8">
                <!-- List of items in the cart -->
                <div id="order-items-list" class="space-y-4 max-h-[calc(100vh-250px)] overflow-y-auto mb-4">
                    <!-- Order items will be dynamically populated here -->
                    <p class="text-center text-gray-400 italic">No items in your cart.</p>
                </div>

                <!-- Subtotal, Delivery, and Total -->
                <div class="border-t border-gray-700 pt-4 mt-4">
                    <div class="flex justify-between text-gray-400 mb-2">
                        <span>Subtotal</span>
                        <span id="subtotal-amount">₱0.00</span>
                    </div>
                    <div class="flex justify-between text-gray-400 mb-2">
                        <span>Delivery Fee</span>
                        <span id="delivery-amount">₱49.00</span>
                    </div>
                    <div class="flex justify-between font-bold text-xl text-[#D4A56E] mt-4">
                        <span>Total</span>
                        <span id="total-amount">₱0.00</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    
    <!-- Custom message box -->
    <div id="message-box" class="message-box hidden">
        <p id="message-text" class="text-lg text-white mb-4"></p>
        <button id="close-message-btn" class="bg-[#D4A56E] text-gray-900 font-bold py-2 px-6 rounded-lg hover:bg-amber-600 transition-colors duration-200">OK</button>
    </div>

    <script>
        // Use a self-invoking function to avoid global scope pollution
        (function() {
            // Function to show a custom message box
            const showMessage = (message) => {
                const messageBox = document.getElementById('message-box');
                const messageText = document.getElementById('message-text');
                messageText.textContent = message;
                messageBox.classList.remove('hidden');
            };

            // Function to close the custom message box
            const hideMessage = () => {
                const messageBox = document.getElementById('message-box');
                messageBox.classList.add('hidden');
            };
            
            // Get the cart from localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            // --- Helper Functions ---
            const renderOrderSummary = () => {
                const orderItemsList = document.getElementById('order-items-list');
                const subtotalAmountEl = document.getElementById('subtotal-amount');
                const totalAmountEl = document.getElementById('total-amount');

                orderItemsList.innerHTML = '';
                let subtotal = 0;

                if (cart.length === 0) {
                    orderItemsList.innerHTML = '<p class="text-center text-gray-400 italic">No items in your cart.</p>';
                    subtotalAmountEl.textContent = '₱0.00';
                    totalAmountEl.textContent = '₱0.00';
                    return;
                }

                cart.forEach((item, index) => {
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'flex items-start justify-between py-3 border-b border-gray-700 last:border-b-0';
                    itemDiv.innerHTML = `
                        <div class="flex-1 min-w-0">
                            <h4 class="text-white text-md font-semibold">${item.name}</h4>
                            <p class="text-xs text-gray-400 truncate mt-1">${item.options || 'No options selected'}</p>
                        </div>
                        <span class="text-white font-medium ml-4 flex-shrink-0">₱${item.price.toFixed(2)}</span>
                    `;
                    orderItemsList.appendChild(itemDiv);
                    subtotal += item.price;
                });

                const deliveryFee = 49.00;
                const total = subtotal + deliveryFee;

                subtotalAmountEl.textContent = `₱${subtotal.toFixed(2)}`;
                totalAmountEl.textContent = `₱${total.toFixed(2)}`;
            };

            const handleFormSubmission = (event) => {
                event.preventDefault();

                // Get form data
                const formData = new FormData(document.getElementById('checkoutForm'));
                const orderData = {};
                formData.forEach((value, key) => {
                    orderData[key] = value;
                });
                
                // Get the selected payment method
                const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
                if (selectedPaymentMethod) {
                    orderData.paymentMethod = selectedPaymentMethod.value;
                } else {
                    showMessage("Please select a payment method.");
                    return;
                }

                // Add cart items, total, and changeFor if applicable
                orderData.cart = cart;
                orderData.total = parseFloat(totalAmountEl.textContent.replace('₱', ''));
                if (orderData.paymentMethod === 'Cash on Delivery') {
                    orderData.changeFor = parseFloat(document.getElementById('changeFor').value) || null;
                }
                
                // Add Senior/PWD details
                const seniorPwdSelect = document.getElementById('seniorPwd');
                if (seniorPwdSelect.value !== '') {
                    orderData.seniorPwdType = seniorPwdSelect.value;
                    orderData.seniorPwdId = document.getElementById('seniorPwdId').value;
                }

                // Log the order to the console for demonstration
                console.log('--- Order Submitted ---');
                console.log(JSON.stringify(orderData, null, 2));
                console.log('-----------------------');

                // Show a confirmation message
                showMessage('Thank you! Your order has been placed.');

                // Clear the cart from localStorage after successful submission
                localStorage.removeItem('cart');
            };

            // --- Event Listeners ---
            document.addEventListener('DOMContentLoaded', () => {
                // Initial render of the cart
                renderOrderSummary();

                // Listen for form submission
                const checkoutForm = document.getElementById('checkoutForm');
                const continueToPaymentBtn = document.getElementById('continueToPaymentBtn');
                const closeMessageBtn = document.getElementById('close-message-btn');
                const paymentMethods = document.querySelectorAll('input[name="paymentMethod"]');
                const changeForSection = document.getElementById('change-for-section');
                const seniorPwdSelect = document.getElementById('seniorPwd');
                const seniorPwdIdInput = document.getElementById('seniorPwdId');


                // Initial state for the change for section
                changeForSection.style.display = 'block';

                paymentMethods.forEach(radio => {
                    radio.addEventListener('change', (e) => {
                        if (e.target.value === 'Cash on Delivery') {
                            changeForSection.style.display = 'block';
                        } else {
                            changeForSection.style.display = 'none';
                        }
                    });
                });
                
                // Show/hide ID number input based on dropdown selection
                seniorPwdSelect.addEventListener('change', (e) => {
                    if (e.target.value === 'senior' || e.target.value === 'pwd') {
                        seniorPwdIdInput.classList.remove('hidden');
                    } else {
                        seniorPwdIdInput.classList.add('hidden');
                    }
                });

                if (checkoutForm) {
                    checkoutForm.addEventListener('submit', handleFormSubmission);
                }

                if (continueToPaymentBtn) {
                    continueToPaymentBtn.addEventListener('click', handleFormSubmission);
                }

                // Close the message box
                closeMessageBtn.addEventListener('click', hideMessage);
            });
        })();
    </script>
</body>
</html>
