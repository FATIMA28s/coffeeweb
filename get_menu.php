<?php
header('Content-Type: application/json');

// Your menu data as a PHP array
$menuItems = [
    // Use square brackets [] for each item instead of curly braces {}
    [
        "name" => 'Espresso',
        "description" => 'A strong, concentrated shot of our finest beans.',
        "price" => 30.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/C0B29E/333333?text=Espresso'
    ],
    [
        "name" => 'Americano',
        "description" => 'Espresso shots topped with hot water for a rich, bold coffee.',
        "price" => 40.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/D5C8B2/333333?text=Americano'
    ],
    [
        "name" => 'Cappuccino',
        "description" => 'Equal parts espresso, steamed milk, and rich foam.',
        "price" => 55.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/E3DDCF/333333?text=Cappuccino'
    ],
    [
        "name" => 'Latte',
        "description" => 'Espresso with steamed milk, and a thin layer of foam.',
        "price" => 60.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/D4A56E/333333?text=Latte'
    ],
    [
        "name" => 'Macchiato',
        "description" => 'A shot of espresso with just a dash of milk foam.',
        "price" => 50.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/B8A58D/333333?text=Macchiato'
    ],
    [
        "name" => 'Mocha',
        "description" => 'Espresso with rich chocolate sauce and steamed milk.',
        "price" => 75.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/7A5E53/333333?text=Mocha'
    ],
    [
        "name" => 'Flat White',
        "description" => 'A smooth coffee with a velvety microfoam, without the foam cap.',
        "price" => 65.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/C7B39E/333333?text=Flat+White'
    ],
    [
        "name" => 'Cold Brew',
        "description" => 'Coffee steeped in cold water for a smooth, low-acidity brew.',
        "price" => 80.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/A08F7E/333333?text=Cold+Brew'
    ],
    [
        "name" => 'Iced Coffee',
        "description" => 'Our classic brew, served chilled over ice.',
        "price" => 55.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/C9B89E/333333?text=Iced+Coffee'
    ],
    [
        "name" => 'Affogato',
        "description" => 'A scoop of vanilla ice cream drowned in a hot shot of espresso.',
        "price" => 90.00,
        "category" => 'Coffee',
        "image" => 'https://placehold.co/600x400/E0C89F/333333?text=Affogato'
    ],
    // Food items
    [
        "name" => 'Croissant',
        "description" => 'A classic buttery, flaky French pastry.',
        "price" => 35.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/E5D8B4/333333?text=Croissant'
    ],
    [
        "name" => 'Avocado Toast',
        "description" => 'Toasted sourdough topped with fresh avocado, chili flakes, and salt.',
        "price" => 70.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/D4C3A3/333333?text=Avocado+Toast'
    ],
    [
        "name" => 'Chocolate Chip Cookie',
        "description" => 'A classic, warm, and gooey chocolate chip cookie.',
        "price" => 25.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/C0A98F/333333?text=Cookie'
    ],
    [
        "name" => 'Cinnamon Roll',
        "description" => 'Freshly baked cinnamon roll with cream cheese frosting.',
        "price" => 45.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/D8C9B5/333333?text=Cinnamon+Roll'
    ],
    [
        "name" => 'Lemon Muffin',
        "description" => 'A zesty and moist lemon muffin, perfect for a morning treat.',
        "price" => 30.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/F1E8D2/333333?text=Lemon+Muffin'
    ],
    [
        "name" => 'Breakfast Burrito',
        "description" => 'A hearty burrito filled with scrambled eggs, sausage, and cheese.',
        "price" => 95.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/A89B88/333333?text=Burrito'
    ],
    [
        "name" => 'Waffle with Syrup',
        "description" => 'Crispy waffle with butter and a side of maple syrup.',
        "price" => 80.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/BDB2A5/333333?text=Waffle'
    ],
    [
        "name" => 'Fruit Salad',
        "description" => 'A refreshing mix of seasonal fresh fruits.',
        "price" => 60.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/C8B89E/333333?text=Fruit+Salad'
    ],
    [
        "name" => 'Chicken Sandwich',
        "description" => 'Grilled chicken breast with lettuce and tomato on toasted bread.',
        "price" => 110.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/988E7D/333333?text=Sandwich'
    ],
    [
        "name" => 'Brownie',
        "description" => 'A rich and fudgy chocolate brownie.',
        "price" => 40.00,
        "category" => 'Food',
        "image" => 'https://placehold.co/600x400/776B5A/333333?text=Brownie'
    ]
];

echo json_encode($menuItems);
?>
