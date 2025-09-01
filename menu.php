
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Golden Bean Cafe</title>
    <!-- Use Playfair Display for titles and Poppins for body text -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles to enhance the aesthetic */
        body {
            font-family: 'Poppins', 'Inter', sans-serif;
            background-color: #0A0A0A; /* A very dark, almost black background */
            color: #E5E5E5; /* Light gray for text */
            line-height: 1.6;
        }

        h1, h2, h3, .playfair-display {
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

        /* Style for the price tag overlay */
        .price-tag {
            background-color: #d4b88c;
            color: #1a1a1a;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            bottom: 0.5rem;
            right: 0.5rem;
        }
        /* Custom scrollbar styling for a cleaner look */
        .horizontal-scroll-container::-webkit-scrollbar {
            height: 8px;
        }
        .horizontal-scroll-container::-webkit-scrollbar-track {
            background: #2a2a2a;
        }
        .horizontal-scroll-container::-webkit-scrollbar-thumb {
            background-color: #d4b88c;
            border-radius: 20px;
            border: 2px solid #1a1a1a;
        }
        /* Custom background pattern for a hand-drawn feel */
        .menu-bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 16.5c-3.59 0-6.5-2.91-6.5-6.5S6.41 3.5 10 3.5s6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5zm-5.45-6.5c0-3.01 2.44-5.45 5.45-5.45s5.45 2.44 5.45 5.45-2.44 5.45-5.45 5.45-5.45-2.44-5.45-5.45zm0 0' stroke='%23362a1e' fill='none' stroke-width='.5'/%3E%3C/svg%3E");
            background-repeat: repeat;
            opacity: 0.2;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        /* Styles for the custom radio buttons */
        .peer:checked + .size-label {
            background-color: #d4b88c;
            color: #1a1a1a;
            font-weight: 600;
        }
        .size-label {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        /* Styles for the custom checkboxes */
        .peer:checked + .addon-label {
            background-color: #d4b88c;
            color: #1a1a1a;
            font-weight: 600;
        }
        .addon-label {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .custom-checkbox {
            color: #d4b88c;
        }
        /* Style for a custom message box instead of alert() */
        .message-box {
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
    </style>
</head>
<body class="antialiased">

    <!-- Header and Navigation -->
    <header class="bg-black/50 backdrop-blur-sm fixed top-0 w-full z-50 p-4 shadow-lg transition-all duration-300">
        <!-- Changed from container mx-auto to w-full px-4 -->
        <nav class="w-full px-4 max-w-7xl mx-auto flex items-center">
            <a href="#" class="text-3xl font-bold text-white transition-transform hover:scale-105">
                The Golden Bean
            </a>
            <!-- Added flex-1 and mx-auto here to push the links to the center -->
            <div class="space-x-8 hidden md:flex flex-1 mx-auto justify-center">
                <a href="#menu-start" class="text-white hover:text-[#D4A56E] transition-colors">Menu</a>
                <a href="#gallery" class="text-white hover:text-[#D4A56E] transition-colors">Gallery</a>
                <a href="#contact" class="text-white hover:text-[#D4A56E] transition-colors">Contact</a>
            </div>
            <!-- My Bag icon with count -->
            <button id="cart-btn" class="relative p-2 rounded-full hover:bg-gray-700 transition-colors focus:outline-none ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span id="cart-count" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">0</span>
            </button>
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
                <!-- Updated the ID to be more descriptive -->
                <button id="proceed-to-payment-btn" class="w-full bg-[#D4A56E] text-gray-900 text-lg font-bold py-3 mt-4 rounded-xl shadow-lg hover:bg-amber-600 transition-colors duration-200">
                    Proceed to Payment
                </button>
            </div>
        </div>
    </div>
    
    <!-- Custom message box -->
    <div id="message-box" class="message-box hidden">
        <p id="message-text" class="text-lg text-white mb-4"></p>
        <button id="close-message-btn" class="bg-[#D4A56E] text-gray-900 font-bold py-2 px-6 rounded-lg hover:bg-amber-600 transition-colors duration-200">OK</button>
    </div>

    <!-- Main content container for the menu -->
    <div id="menu-start" class="min-h-screen flex items-center justify-center p-4 relative pt-24">
        <div class="menu-bg-pattern"></div>
        <!-- Menu Container. Removed max-w-4xl for full-width. -->
        <div class="w-full max-w-11xl mx-auto bg-white p-4 md:p-12 rounded-2xl shadow-xl border border-gray-200" style="background-color: #2a2a2a; border-color: #3d3d3d;">
            <!-- Main title using the new font and color -->
            <p class="text-xl text-center text-gray-500 uppercase tracking-widest mb-2" style="color: #6c6c6c;">The Golden Bean Cafe</p>
            <h1 class="text-6xl md:text-7xl font-bold text-center mb-2 playfair-display" style="color: #d4b88c;">MENU</h1>
            <p class="text-center text-sm md:text-md text-gray-400 max-w-2xl mx-auto mb-10">
                Experience the perfect blend of tradition and innovation. From rich, aromatic espressos to delightful baked goods, every item is crafted with passion and the finest ingredients.
            </p>
            <!-- Categories Navigation -->
            <div class="horizontal-scroll-container overflow-x-auto flex space-x-4 pb-4 scroll-smooth">
                <button class="category-btn flex-shrink-0 text-white font-semibold py-2 px-6 rounded-full transition-all duration-300 hover:bg-[#D4A56E] hover:text-[#1a1a1a] active:scale-95" data-category="All">All</button>
                <button class="category-btn flex-shrink-0 text-white font-semibold py-2 px-6 rounded-full transition-all duration-300 hover:bg-[#D4A56E] hover:text-[#1a1a1a] active:scale-95" data-category="Coffee">Coffee</button>
                <button class="category-btn flex-shrink-0 text-white font-semibold py-2 px-6 rounded-full transition-all duration-300 hover:bg-[#D4A56E] hover:text-[#1a1a1a] active:scale-95" data-category="Non-Coffee">Non-Coffee</button>
                <button class="category-btn flex-shrink-0 text-white font-semibold py-2 px-6 rounded-full transition-all duration-300 hover:bg-[#D4A56E] hover:text-[#1a1a1a] active:scale-95" data-category="Food">Food</button>
            </div>
            <!-- Menu items grid -->
            <div id="menu-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                <!-- Menu items will be dynamically generated here -->
            </div>
        </div>
    </div>
    
    <!-- Item Modal -->
    <div id="item-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Modal Overlay -->
        <div class="modal-overlay absolute inset-0"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-white p-6 rounded-2xl shadow-2xl max-w-xl w-full" style="background-color: #2a2a2a;">
            <!-- Close button -->
            <button id="close-modal-btn" class="absolute top-4 right-4 text-gray-500 hover:text-gray-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="md:flex md:space-x-6">
                <!-- Left: Image -->
                <div class="md:w-1/2 mb-4 md:mb-0">
                    <img id="modal-item-image" src="" alt="" class="rounded-lg w-full h-auto shadow-lg">
                </div>
                
                <!-- Right: Details -->
                <div class="md:w-1/2">
                    <h3 id="modal-item-name" class="text-3xl font-bold playfair-display" style="color: #D4A56E;">Item Name</h3>
                    <p id="modal-item-description" class="text-gray-400 text-sm mt-2">Description</p>
                    <p id="modal-item-price" class="text-2xl font-bold mt-4" style="color: #D4A56E;">₱0.00</p>
                    
                    <!-- Size Options (hidden by default) -->
                    <div id="size-options-container" class="mt-4 hidden">
                        <p class="text-sm font-semibold mb-2" style="color: #6c6c6c;">Select Size</p>
                        <div id="size-options" class="flex flex-wrap gap-2">
                            <!-- Sizes will be injected here -->
                        </div>
                    </div>
                    
                    <!-- Add-on Options (hidden by default) -->
                    <div id="addon-options-container" class="mt-4 hidden">
                        <p class="text-sm font-semibold mb-2" style="color: #6c6c6c;">Add-ons</p>
                        <div id="addon-options" class="flex flex-wrap gap-2">
                            <!-- Add-ons will be injected here -->
                        </div>
                    </div>
                    
                    <!-- Add to Bag Button -->
                    <button id="add-to-cart-btn" class="w-full bg-[#D4A56E] text-gray-900 font-bold py-3 mt-6 rounded-lg shadow-lg hover:bg-amber-600 transition-colors duration-200">
                        Add to Bag
                    </button>
                </div>
            </div>
        </div>
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
            const closeMessage = () => {
                const messageBox = document.getElementById('message-box');
                messageBox.classList.add('hidden');
            };

            const closeMessageBtn = document.getElementById('close-message-btn');
            closeMessageBtn.addEventListener('click', closeMessage);

            let menuData = [];
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let currentItem = {};
            let isModalOpen = false;

            const menuContainer = document.getElementById('menu-container');
            const itemModal = document.getElementById('item-modal');
            const closeItemModalBtn = document.getElementById('close-modal-btn');
            const addToCartBtn = document.getElementById('add-to-cart-btn');
            const cartBtn = document.getElementById('cart-btn');
            const cartModal = document.getElementById('cart-modal');
            const closeCartBtn = document.getElementById('close-cart-btn');
            const cartItemsContainer = document.getElementById('cart-items');
            const proceedToPaymentBtn = document.getElementById('proceed-to-payment-btn');

            // --- Modal Control Functions ---
            const showItemModal = () => {
                itemModal.classList.remove('hidden');
                isModalOpen = true;
            };

            const hideItemModal = () => {
                itemModal.classList.add('hidden');
                isModalOpen = false;
            };
            
            const showCartModal = () => {
                cartModal.classList.remove('hidden');
            };
            
            const hideCartModal = () => {
                cartModal.classList.add('hidden');
            };

            const updateCartCount = () => {
                document.getElementById('cart-count').textContent = cart.length;
            };

            const renderCartItems = () => {
                cartItemsContainer.innerHTML = '';
                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = '<p class="text-center text-gray-400 italic">Your bag is empty.</p>';
                    document.getElementById('cart-subtotal').textContent = `₱0.00`;
                    document.getElementById('cart-total').textContent = `₱0.00`;
                    return;
                }

                let subtotal = 0;
                cart.forEach((item, index) => {
                    subtotal += item.price;
                    const itemElement = document.createElement('div');
                    itemElement.className = 'flex items-center justify-between py-2 border-b border-gray-700 last:border-b-0';
                    itemElement.innerHTML = `
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-400">#${index + 1}</span>
                            <div>
                                <h4 class="text-md font-semibold text-white">${item.name}</h4>
                                <p class="text-xs text-gray-400">${item.options}</p>
                            </div>
                        </div>
                        <span class="text-md font-semibold text-white">₱${item.price.toFixed(2)}</span>
                    `;
                    cartItemsContainer.appendChild(itemElement);
                });

                const deliveryFee = 49.00;
                const total = subtotal + deliveryFee;

                document.getElementById('cart-subtotal').textContent = `₱${subtotal.toFixed(2)}`;
                document.getElementById('cart-total').textContent = `₱${total.toFixed(2)}`;
            };

            // --- Menu Rendering Functions ---
            const createMenuItem = (item) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = `menu-item rounded-2xl overflow-hidden shadow-lg border border-gray-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl cursor-pointer fade-in`;
                itemDiv.dataset.category = item.category;
                itemDiv.innerHTML = `
                    <div class="relative">
                        <img src="${item.image}" alt="${item.name}" class="w-full h-48 object-cover">
                        <div class="price-tag absolute bottom-2 right-2 rounded-full px-4 py-2 font-bold text-lg shadow-md" style="background-color: #D4A56E;">
                            ₱${item.price.toFixed(2)}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold playfair-display" style="color: #D4A56E;">${item.name}</h3>
                        <p class="text-sm text-gray-400 mt-2">${item.description}</p>
                    </div>
                `;
                itemDiv.addEventListener('click', () => {
                    openItemModal(item);
                });
                return itemDiv;
            };

            const renderMenu = (filter = 'All') => {
                menuContainer.innerHTML = '';
                const filteredItems = filter === 'All' ? menuData : menuData.filter(item => item.category === filter);
                if (filteredItems.length === 0) {
                    menuContainer.innerHTML = '<p class="col-span-full text-center text-gray-500 italic">No items found in this category.</p>';
                } else {
                    filteredItems.forEach(item => {
                        menuContainer.appendChild(createMenuItem(item));
                    });
                }
            };
            
            const openItemModal = (item) => {
                currentItem = item;
                
                document.getElementById('modal-item-image').src = item.image;
                document.getElementById('modal-item-image').alt = item.name;
                document.getElementById('modal-item-name').textContent = item.name;
                document.getElementById('modal-item-description').textContent = item.description;
                document.getElementById('modal-item-price').textContent = `₱${item.price.toFixed(2)}`;
                
                const sizeContainer = document.getElementById('size-options-container');
                const sizeOptions = document.getElementById('size-options');
                sizeOptions.innerHTML = '';
                sizeContainer.classList.add('hidden');

                const addonContainer = document.getElementById('addon-options-container');
                const addonOptions = document.getElementById('addon-options');
                addonOptions.innerHTML = '';
                addonContainer.classList.add('hidden');

                // Check for item-specific options
                if (item.name === 'Cappuccino' || item.name === 'Latte' || item.name === 'Espresso') {
                    sizeContainer.classList.remove('hidden');
                    const sizes = ['Small', 'Medium', 'Large'];
                    sizes.forEach(size => {
                        const sizeInput = document.createElement('input');
                        sizeInput.type = 'radio';
                        sizeInput.name = 'size';
                        sizeInput.value = size;
                        sizeInput.id = `size-${size.toLowerCase()}`;
                        sizeInput.className = 'peer hidden';

                        const sizeLabel = document.createElement('label');
                        sizeLabel.htmlFor = `size-${size.toLowerCase()}`;
                        sizeLabel.className = 'size-label px-4 py-2 rounded-full border border-gray-600 text-gray-400 text-sm font-medium';
                        sizeLabel.textContent = size;
                        
                        sizeOptions.appendChild(sizeInput);
                        sizeOptions.appendChild(sizeLabel);
                    });
                    document.getElementById('size-small').checked = true; // Default to small
                } else if (item.name === 'Waffle with Syrup') {
                    addonContainer.classList.remove('hidden');
                    const addons = ['Whipped Cream (+₱20)', 'Strawberry Jam (+₱25)', 'Chocolate Sauce (+₱25)'];
                    addons.forEach(addon => {
                        const addonInput = document.createElement('input');
                        addonInput.type = 'checkbox';
                        addonInput.name = 'addon';
                        addonInput.value = addon;
                        addonInput.id = `addon-${addon.replace(/[^a-zA-Z0-9]/g, '').toLowerCase()}`;
                        addonInput.className = 'peer hidden';
                        
                        const addonLabel = document.createElement('label');
                        addonLabel.htmlFor = `addon-${addon.replace(/[^a-zA-Z0-9]/g, '').toLowerCase()}`;
                        addonLabel.className = 'addon-label px-4 py-2 rounded-full border border-gray-600 text-gray-400 text-sm font-medium';
                        addonLabel.textContent = addon;
                        
                        addonOptions.appendChild(addonInput);
                        addonOptions.appendChild(addonLabel);
                    });
                } else if (item.name === 'Breakfast Burrito' || item.name === 'Lemon Muffin') {
                    addonContainer.classList.remove('hidden');
                    const addons = ['Bacon (+₱20)', 'Avocado (+₱25)'];
                    addons.forEach(addon => {
                        const addonInput = document.createElement('input');
                        addonInput.type = 'checkbox';
                        addonInput.name = 'addon';
                        addonInput.value = addon;
                        addonInput.id = `addon-${addon.replace(/[^a-zA-Z0-9]/g, '').toLowerCase()}`;
                        addonInput.className = 'peer hidden';
                        
                        const addonLabel = document.createElement('label');
                        addonLabel.htmlFor = `addon-${addon.replace(/[^a-zA-Z0-9]/g, '').toLowerCase()}`;
                        addonLabel.className = 'addon-label px-4 py-2 rounded-full border border-gray-600 text-gray-400 text-sm font-medium';
                        addonLabel.textContent = addon;
                        
                        addonOptions.appendChild(addonInput);
                        addonOptions.appendChild(addonLabel);
                    });
                }
                
                showItemModal();
            };

            // --- Event Listeners ---
            document.addEventListener('DOMContentLoaded', () => {
                // Fetch the menu data from the external PHP file
                fetch('get_menu.php')
                    .then(response => response.json())
                    .then(data => {
                        menuData = data;
                        renderMenu();
                        updateCartCount();
                    })
                    .catch(error => console.error('Error fetching menu:', error));
                
                // Add listener to the close button of the item modal
                closeItemModalBtn.addEventListener('click', hideItemModal);

                // Add listener to the add to cart button
                addToCartBtn.addEventListener('click', () => {
                    let itemPrice = currentItem.price;
                    let optionsString = '';

                    // Check for selected size
                    const selectedSize = document.querySelector('input[name="size"]:checked');
                    if (selectedSize) {
                        const size = selectedSize.value;
                        optionsString += `Size: ${size}`;
                        if (size === 'Medium') itemPrice += 10;
                        if (size === 'Large') itemPrice += 20;
                    }
                    
                    // Check for selected add-ons
                    const selectedAddons = document.querySelectorAll('input[name="addon"]:checked');
                    if (selectedAddons.length > 0) {
                        const addons = Array.from(selectedAddons).map(addon => {
                            const addonText = addon.parentElement.querySelector('label').textContent;
                            return addonText.split(' (+')[0];
                        });
                        optionsString += (optionsString ? ', ' : '') + `Add-ons: ${addons.join(', ')}`;
                        
                        selectedAddons.forEach(addon => {
                            if (addon.value.includes('Whipped Cream')) itemPrice += 20;
                            if (addon.value.includes('Strawberry Jam')) itemPrice += 25;
                            if (addon.value.includes('Chocolate Sauce')) itemPrice += 25;
                            if (addon.value === 'Bacon') itemPrice += 20;
                            if (addon.value === 'Avocado') itemPrice += 25;
                        });
                    }
                    
                    // Add the selected item to the cart and save to localStorage
                    const itemToAdd = {
                        name: currentItem.name,
                        price: itemPrice,
                        options: optionsString
                    };
                    cart.push(itemToAdd);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartCount();
                    hideItemModal();
                });
                
                // Add event listener to the "My Bag" button
                cartBtn.addEventListener('click', () => {
                    renderCartItems();
                    showCartModal();
                });
                
                // Add event listener to the close button of the cart modal
                closeCartBtn.addEventListener('click', hideCartModal);
                
                // Add event listeners to category buttons
                document.querySelectorAll('.category-btn').forEach(button => {
                    button.addEventListener('click', (event) => {
                        const category = event.target.dataset.category;
                        renderMenu(category);
                    });
                });
                
                // Listener for the new "Proceed to Payment" button
                proceedToPaymentBtn.addEventListener('click', () => {
                    if (cart.length > 0) {
                        window.location.href = 'checkout.php';
                    } else {
                        showMessage("Your cart is empty. Please add items to proceed to payment.");
                    }
                });
            });
        })();
    </script>
</body>
</html>
