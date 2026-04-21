const navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {
    navbar.classList.toggle("scrolled", window.scrollY > 100);
});


const searchBtn = document.querySelector(".search-btn");
const searchBox = document.querySelector(".search-box");
const searchInput = searchBox.querySelector("input");
const resultContainer = document.getElementById("search-result");

searchInput.addEventListener("input", () => {
    if (searchInput.value.trim() === "") {
        resultContainer.innerHTML = "";
    }
});

searchBtn.addEventListener("click", (e) => {
    e.stopPropagation();

    if (searchBox.classList.contains("active")) {
        const keyword = searchInput.value.trim();
        if (keyword !== "") searchProduct(keyword);
    } else {
        searchBox.classList.add("active");
        searchInput.focus();
    }
});

searchBox.addEventListener("submit", (e) => {
    e.preventDefault();
    const keyword = searchInput.value.trim();
    if (keyword !== "") searchProduct(keyword);
});

document.addEventListener("click", (e) => {
    if (!searchBox.contains(e.target) && !searchBtn.contains(e.target)) {
        searchBox.classList.remove("active");
        resultContainer.innerHTML = "";
    }
});

function searchProduct(keyword) {
    const results = products.filter(product =>
        product.name.toLowerCase().includes(keyword.toLowerCase())
    );

    let html = `<div class="search-result-box">`;

    if (results.length > 0) {
        results.forEach(product => {
            html += `<div class="result-item">${product.name}</div>`;
        });
    } else {
        html += `<div class="not-found">Produk yang anda cari tidak tersedia</div>`;
    }

    html += `</div>`;
    resultContainer.innerHTML = html;
}


const categories = [
    { id: "cake", name: "Cake" },
    { id: "brownies", name: "Brownies" },
    { id: "pies", name: "Pies" },
    { id: "cupcake", name: "Cupcake" }
];

const getCategoryName = (id) => {
    const cat = categories.find(c => c.id === id);
    return cat ? cat.name : id;
};

const products = [
    { name: "Classic Chocolate Cake", category: "cake", price: 430000, image: "images/chocolate cake square.jpg" },
    { name: "Black Velvet Cake", category: "cake", price: 580000, image: "images/black velvet cake square.jpg" },
    { name: "Red Velvet Cake", category: "cake", price: 600000, image: "images/red velvet cake square.jpg" },
    { name: "Chocolate Strawberrys Cake", category: "cake", price: 650000, image: "images/choco strawberry square.png" },
    { name: "Tiramisu Cake", category: "cake", price: 450000, image: "images/tiramisu cake square.jpg" },
    { name: "Cream Cheese Brownies", category: "brownies", price: 150000, image: "images/cream cheese brownies.png" },
    { name: "Fudgy Chocolate Brownies", category: "brownies", price: 300000, image: "images/fudgy chocolate brownies.jpg" },
    { name: "Strawberry Brownies", category: "brownies", price: 150000, image: "images/strawberry brownies.webp" },
    { name: "Tiramisu Brownies", category: "brownies", price: 150000, image: "images/tiramisu brownie.webp" },
    { name: "Blueberry Pie", category: "pies", price: 200000, image: "images/blueberry pie square.jpg" },
    { name: "Apple Pie", category: "pies", price: 200000, image: "images/apple pie square.jpg" },
    { name: "Chocolate Cream Pie", category: "pies", price: 200000, image: "images/chocolate cream pie.png" },
    { name: "Strawberry Pie", category: "pies", price: 200000, image: "images/strawberry pie square.jpg" },
    { name: "Strawberry Cupcakes", category: "cupcake", price: 80000, image: "images/strawberry cupcakes square.jpg" },
    { name: "Chocolate Cupcake", category: "cupcake", price: 80000, image: "images/chocolate cupcakes square.jpg" },
    { name: "Blueberry Waffle Cupcake", category: "cupcake", price: 80000, image: "images/Blueberry Waffle Cupcakes square.jpg" }
];


const renderProducts = (data) => {
    const container = document.querySelector(".product-list");
    container.innerHTML = "";

    if (data.length === 0) {
        container.innerHTML = "<p>Tidak ada produk</p>";
        return;
    }

    data.forEach(product => {
        const item = document.createElement("div");
        item.classList.add("product-card");

        item.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p class="category">${getCategoryName(product.category)}</p>
            <p class="price">Rp ${product.price.toLocaleString()}</p>
        `;

        container.appendChild(item);
    });
};


const previewProducts = products.slice(0, 8);
renderProducts(previewProducts);

let currentIndex = 0;
const visibleItems = 4;

const slider = document.querySelector(".product-list");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");

const updateSlider = () => {
    const firstItem = document.querySelector(".product-card");
    if (!firstItem) return;

    const itemWidth = firstItem.offsetWidth + 30;
    slider.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
};

nextBtn.addEventListener("click", () => {
    if (currentIndex < previewProducts.length - visibleItems) {
        currentIndex++;
    } else {
        currentIndex = 0;
    }
    updateSlider();
});

prevBtn.addEventListener("click", () => {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = previewProducts.length - visibleItems;
    }
    updateSlider();
});


let autoSlide = setInterval(() => {
    nextBtn.click();
}, 4000);

const wrapper = document.querySelector(".product-slider-wrapper");

wrapper.addEventListener("mouseenter", () => {
    clearInterval(autoSlide);
});

wrapper.addEventListener("mouseleave", () => {
    autoSlide = setInterval(() => {
        nextBtn.click();
    }, 4000);
});