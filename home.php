<?php include __DIR__ . '/header.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Golden Bean Cafe</title>
    <!-- Google Fonts for aesthetic typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN for modern styling -->
    <script src="https://cdn.tailwindcss.com"></script>
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

        /* Hero section with a dark, stylish gradient overlay */
        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://placehold.co/1920x1080/282421/E5E5E5?text=Cafe+Interior');
            background-size: cover;
            background-position: center;
        }

        /* Custom scrollbar for a polished look */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #2D2D2D;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #D4A56E;
            border-radius: 10px;
        }

        /* Fade-in animation for a smooth entrance */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
    </style>
</head


><!-- All content is now inside a root div for easier JS manipulation -->
    <div id="app">

  
<body class="antialiased">

    

        <!-- Hero Section -->
        <section class="hero text-center h-screen flex flex-col justify-center items-center text-white px-4">
            <div class="space-y-6 fade-in">
                <h1 class="text-6xl md:text-8xl font-black tracking-wider leading-tight animate-pulse-slow">
                    Sip, Savor, & Stay Awhile
                </h1>
                <p class="text-lg md:text-xl max-w-2xl mx-auto opacity-80 mt-4">
                    Experience the rich aroma of single-origin coffee and the tranquil warmth of our cozy space.
                </p>
                <a href="menu.php" class="inline-block mt-8 bg-[#D4A56E] text-black font-semibold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 hover:bg-[#F2D091]">
                    Explore Our Menu
                </a>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="container mx-auto py-20 px-6">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2 fade-in">
                    <img src="https://placehold.co/800x600/3A3A3A/E5E5E5?text=Cozy+Interior" alt="Cozy cafe interior" class="rounded-3xl shadow-2xl transition-transform hover:scale-105 duration-500">
                </div>
                <div class="md:w-1/2 space-y-6 fade-in" style="animation-delay: 0.2s;">
                    <h2 class="text-4xl font-bold">Our Story</h2>
                    <p class="text-gray-400">
                        The Golden Bean was born from a simple idea: to create a sanctuary where the art of coffee meets the comfort of home. We meticulously source our beans from small farms around the world, ensuring every cup tells a unique story. From the hand-pulled espresso to the perfectly frothed latte, we invite you to taste the passion in every detail.
                    </p>
                    <p class="text-gray-400">
                        Our space is designed for connection and tranquility—a place to work, to relax, or to simply enjoy a moment of peace. Welcome to our haven.
                    </p>
                </div>
            </div>
        </section>

    

        <!-- Gallery Section -->
        <section id="gallery" class="container mx-auto py-20 px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl font-bold">Moments at Our Cafe</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <img src="https://placehold.co/600x800/2A2A2A/E5E5E5?text=Artistic+Coffee" alt="Artistic coffee shot" class="rounded-2xl w-full h-full object-cover shadow-lg transition-transform hover:scale-105 duration-300 fade-in">
                <img src="https://placehold.co/600x800/2A2A2A/E5E5E5?text=Latte+Art" alt="Latte art" class="rounded-2xl w-full h-full object-cover shadow-lg transition-transform hover:scale-105 duration-300 fade-in" style="animation-delay: 0.2s;">
                <img src="https://placehold.co/600x800/2A2A2A/E5E5E5?text=Cozy+Spot" alt="Cozy reading spot" class="rounded-2xl w-full h-full object-cover shadow-lg transition-transform hover:scale-105 duration-300 fade-in" style="animation-delay: 0.4s;">
                <img src="https://placehold.co/600x800/2A2A2A/E5E5E5?text=Book+and+Coffee" alt="Book and coffee" class="rounded-2xl w-full h-full object-cover shadow-lg transition-transform hover:scale-105 duration-300 fade-in" style="animation-delay: 0.6s;">
                <img src="https://placehold.co/600x800/2A2A2A/E5E5E5?text=Coffee+Beans" alt="Coffee beans" class="rounded-2xl w-full h-full object-cover shadow-lg transition-transform hover:scale-105 duration-300 fade-in" style="animation-delay: 0.8s;">
                <img src="https://placehold.co/600x800/2A2A2A/E5E5E5?text=Outdoor+Seating" alt="Outdoor seating" class="rounded-2xl w-full h-full object-cover shadow-lg transition-transform hover:scale-105 duration-300 fade-in" style="animation-delay: 1.0s;">
            </div>
        </section>

        <!-- Contact & Footer -->
        <footer id="contact" class="bg-[#1A1A1A] py-16 px-6 text-center">
            <div class="container mx-auto">
                <h2 class="text-4xl font-bold mb-4">Visit Us</h2>
                <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
                    Discover your new favorite spot. We're open Monday to Saturday from 8 AM to 7 PM.
                </p>
                <div class="flex flex-col md:flex-row justify-center items-center gap-8 text-gray-400">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#D4A56E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>123 Coffee Lane, Brewton, CA 90210</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#D4A56E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>(123) 456-7890</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#D4A56E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>hello@thegoldenbean.com</span>
                    </div>
                </div>
                <div class="flex justify-center items-center space-x-6 mt-8">
                    <!-- Social media icons (SVGs) can be added here -->
                </div>
            </div>
        </footer>
    </div> <!-- End of #app div -->

    <!-- Firebase SDK Imports -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInWithCustomToken, signInAnonymously } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, collection, addDoc, onSnapshot } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // Global variables provided by the Canvas environment.
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : null;
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        let db, auth;
        let userId;

        // Function to set up Firebase and fetch data
        async function initializeAndFetchData() {
            try {
                // Initialize Firebase app and services
                const app = initializeApp(firebaseConfig);
                auth = getAuth(app);
                db = getFirestore(app);

                // Authenticate the user. Use the provided token if available, otherwise sign in anonymously.
                if (initialAuthToken) {
                    await signInWithCustomToken(auth, initialAuthToken);
                } else {
                    await signInAnonymously(auth);
                }
                userId = auth.currentUser?.uid;

                console.log("Firebase initialized and user authenticated. User ID:", userId);

                // Get references to DOM elements
                const menuItemsContainer = document.getElementById('menu-items-container');
                const loadingIndicator = document.getElementById('loading-indicator');
                const form = document.getElementById('add-menu-item-form');
                const formMessage = document.getElementById('form-message');

                // Define the Firestore collection path for public data
                const menuItemsCollection = collection(db, `artifacts/${appId}/public/data/menuItems`);

                // Set up a real-time listener for the menu items collection
                onSnapshot(menuItemsCollection, (querySnapshot) => {
                    const menuItems = [];
                    querySnapshot.forEach((doc) => {
                        menuItems.push({ id: doc.id, ...doc.data() });
                    });

                    // Clear the loading indicator and previous menu items
                    loadingIndicator.classList.add('hidden');
                    menuItemsContainer.innerHTML = '';

                    // If there are no items, display a message
                    if (menuItems.length === 0) {
                        menuItemsContainer.innerHTML = '<p class="text-center text-gray-500 col-span-full">No menu items found. Add one above!</p>';
                    } else {
                        // Render each menu item dynamically
                        menuItems.forEach((item, index) => {
                            const menuItemHtml = `
                                <div class="bg-[#1A1A1A] rounded-2xl p-6 shadow-xl transform transition-transform duration-300 hover:scale-105 fade-in" style="animation-delay: ${index * 0.1}s;">
                                    <img src="https://placehold.co/600x400/3A3A3A/E5E5E5?text=${item.itemName.replace(/\s/g, '+')}" alt="${item.itemName}" class="w-full h-48 object-cover rounded-xl mb-4">
                                    <h3 class="text-2xl font-semibold text-[#D4A56E]">${item.itemName}</h3>
                                    <p class="text-gray-400 mt-2">${item.itemDescription}</p>
                                </div>
                            `;
                            menuItemsContainer.insertAdjacentHTML('beforeend', menuItemHtml);
                        });
                    }
                }, (error) => {
                    console.error("Error fetching menu items: ", error);
                    loadingIndicator.classList.remove('hidden');
                    loadingIndicator.textContent = "Error loading menu. Please try again.";
                });

                // Handle form submission to add new menu items
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const itemName = document.getElementById('item-name').value;
                    const itemDescription = document.getElementById('item-description').value;
                    formMessage.textContent = 'Adding item...';
                    formMessage.classList.remove('text-red-500', 'text-green-500');
                    formMessage.classList.add('text-yellow-500');

                    try {
                        await addDoc(menuItemsCollection, {
                            itemName: itemName,
                            itemDescription: itemDescription,
                            createdAt: new Date().toISOString()
                        });
                        formMessage.textContent = 'Item added successfully!';
                        formMessage.classList.remove('text-yellow-500');
                        formMessage.classList.add('text-green-500');
                        form.reset(); // Clear the form fields
                    } catch (e) {
                        console.error("Error adding document: ", e);
                        formMessage.textContent = 'Failed to add item. Please try again.';
                        formMessage.classList.remove('text-yellow-500');
                        formMessage.classList.add('text-red-500');
                    }
                });

            } catch (error) {
                console.error("Failed to initialize Firebase:", error);
                document.getElementById('loading-indicator').textContent = "Failed to load the application. Check the console for errors.";
            }
        }

        // Start the process when the window loads
        window.onload = initializeAndFetchData;
    </script>
</body>
</html>
