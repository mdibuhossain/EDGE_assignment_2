<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Dashboard</title>
</head>

<body>
    <div class="p-3">
        <h1 class="text-2xl font-bold">Cart:</h1>
        <div class="cartList flex flex-col gap-y-1"></div>

        <div id="admin-panel">
            <div>
                <h1 class="text-2xl font-bold mt-5">Products:</h1>
                <div class="productList flex flex-col gap-y-1"></div>
            </div>

            <div>
                <h1 class="text-2xl font-bold mt-5">Add Product:</h1>
                <form id="addProductForm" class="flex flex-col gap-y-2">
                    <input type="text" name="name" placeholder="Name" class="p-2 border border-gray-300 rounded">
                    <input type="text" name="price" placeholder="Price"
                        class="p-2 border   border-gray-300 rounded">
                    <input type="text" name="description" placeholder="Description"
                        class="p-2 border border-gray-300 rounded">
                    <input type="text" name="category" placeholder="Category"
                        class="p-2 border border-gray-300 rounded">
                    <button type="submit" class="bg-amber-600 text-white px-2 py-1 rounded">Add Product</button>
                </form>
            </div>
        </div>

        <script>
            const fetchCart = () => {
                const cartList = document.querySelector('.cartList');
                fetch('/api/carts')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            const cartItem = `
                                <div class="flex flex-row justify-between">
                                    <div class="flex flex-row justify-start gap-x-2">
                                        <img src="https://via.placeholder.com/150" alt="product" class="w-20 h-20 object-cover">
                                        <div>
                                            <h2 class="text-lg font-bold">${item.name}</h2>
                                            <p class="text-sm text-amber-600">${item.price}</p>
                                            <p class="text-sm">${item.category}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="bg-amber-600 text-white px-2 py-1 rounded">Remove</button>
                                    </div>
                                </div>
                            `;
                            cartList.innerHTML += cartItem;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching cart items:', error);
                    });
            }
            const insertProduct = (product) => {
                const productList = document.querySelector('.productList');
                const productItem = `
                    <div class="flex flex-row justify-between">
                        <div class="flex flex-row justify-start gap-x-2">
                            <img src="https://via.placeholder.com/150" alt="product" class="w-20 h-20 object-cover">
                            <div>
                                <h2 class="text-lg font-bold">${product.name}</h2>
                                <p class="text-sm text-amber-600">${product.price}</p>
                                <p class="text-sm">${product.category}</p>
                            </div>
                        </div>
                        <div>
                            <button class="bg-red-600 text-white px-2 py-1 rounded">Remove</button>
                        </div>
                    </div>
                `;
                productList.innerHTML += productItem;
            }
            const fetchProducts = () => {
                fetch('/api/products')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            insertProduct(item);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                    });
            }

            const addProductForm = document.querySelector('#addProductForm');
            addProductForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = addProductForm.name.value;
                const price = addProductForm.price.value;
                const description = addProductForm.description.value;
                const category = addProductForm.category.value;

                fetch('/api/products', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            name,
                            price,
                            description,
                            category
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.status === 'success') {
                            alert(data.message);
                            insertProduct(data.data);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
            window.onload = function() {
                fetchCart();
                fetchProducts();
            };
        </script>
</body>

</html>
