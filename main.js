// ================= NAVBAR =================
const navbar = document.querySelector(".navbar");

if (navbar) {
    window.addEventListener("scroll", () => {
        navbar.classList.toggle("scrolled", window.scrollY > 100);
    });
}

const searchBtn = document.querySelector(".search-btn");
const searchBox = document.querySelector(".search-box");
const searchInputNav = searchBox ? searchBox.querySelector("input") : null;
const resultContainer = document.getElementById("search-result");

if (searchBtn && searchBox && searchInputNav) {

    searchInputNav.addEventListener("input", () => {
        if (searchInputNav.value.trim() === "") {
            if (resultContainer) resultContainer.innerHTML = "";
        }
    });

    searchBtn.addEventListener("click", (e) => {
        e.stopPropagation();

        if (searchBox.classList.contains("active")) {
            const keyword = searchInputNav.value.trim();
            if (keyword !== "") searchProduct(keyword);
        } else {
            searchBox.classList.add("active");
            searchInputNav.focus();
        }
    });

    searchBox.addEventListener("submit", (e) => {
        e.preventDefault();
        const keyword = searchInputNav.value.trim();
        if (keyword !== "") searchProduct(keyword);
    });

    document.addEventListener("click", (e) => {
        if (!searchBox.contains(e.target) && !searchBtn.contains(e.target)) {
            searchBox.classList.remove("active");
            if (resultContainer) resultContainer.innerHTML = "";
        }
    });
}

function searchProduct(keyword) {
    if (!resultContainer) return;

    const data = productsData;

    const results = data.filter(product =>
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

const defaultProducts = [
    { id: 1, kode: "P001", name: "Classic Chocolate Cake", category: "cake", price: 430000, stock: 10, image: "images/chocolate cake square.jpg" },
    { id: 2, kode: "P002", name: "Black Velvet Cake", category: "cake", price: 580000, stock: 8, image: "images/black velvet cake square.jpg" },
    { id: 3, kode: "P003", name: "Red Velvet Cake", category: "cake", price: 600000, stock: 5, image: "images/red velvet cake square.jpg" },
    { id: 4, kode: "P004", name: "Chocolate Strawberry Cake", category: "cake", price: 650000, stock: 6, image: "images/choco strawberry square.png" },
    { id: 5, kode: "P005", name: "Fudgy Chocolate Brownies", category: "brownies", price: 300000, stock: 3, image: "images/fudgy chocolate brownies.jpg" },
];

let productsData = JSON.parse(localStorage.getItem("products"));

if (!productsData || productsData.length === 0) {
    productsData = defaultProducts;
    localStorage.setItem("products", JSON.stringify(productsData));
}

const saveData = () => {
    localStorage.setItem("products", JSON.stringify(productsData));
};

const productList = document.querySelector(".product-list");

if (productList) {
    const previewProducts = productsData.slice(0, 8);
    renderProducts(previewProducts);

    let currentIndex = 0;
    const visibleItems = 4;

    const nextBtn = document.querySelector(".next");
    const prevBtn = document.querySelector(".prev");

    const updateSlider = () => {
        const firstItem = document.querySelector(".product-card");
        if (!firstItem) return;

        const itemWidth = firstItem.offsetWidth + 30;
        productList.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
    };

    if (nextBtn && prevBtn) {
        nextBtn.addEventListener("click", () => {
            currentIndex = (currentIndex < previewProducts.length - visibleItems)
                ? currentIndex + 1
                : 0;
            updateSlider();
        });

        prevBtn.addEventListener("click", () => {
            currentIndex = (currentIndex > 0)
                ? currentIndex - 1
                : previewProducts.length - visibleItems;
            updateSlider();
        });

        let autoSlide = setInterval(() => nextBtn.click(), 4000);

        const wrapper = document.querySelector(".product-slider-wrapper");

        if (wrapper) {
            wrapper.addEventListener("mouseenter", () => clearInterval(autoSlide));
            wrapper.addEventListener("mouseleave", () => {
                autoSlide = setInterval(() => nextBtn.click(), 4000);
            });
        }
    }
}

function renderProducts(data) {
    const container = document.querySelector(".product-list");
    if (!container) return;

    container.innerHTML = "";

    data.forEach(product => {
        container.innerHTML += `
        <div class="product-card">
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p class="category">${getCategoryName(product.category)}</p>
            <p class="price">Rp ${product.price.toLocaleString()}</p>
        </div>`;
    });
}

const grid = document.getElementById("product-grid");
const form = document.getElementById("form-produk");
const searchInput = document.getElementById("search");
const filter = document.getElementById("filter");
const modal = document.getElementById("modal");

let currentId = null;

if (grid) {
    grid.addEventListener("click", (e) => {
        const btn = e.target.closest(".edit-btn");

            if (btn) {
                const id = Number(btn.dataset.id);
                const p = productsData.find(p => p.id === id);

                document.getElementById("edit-nama").value = p.name;
                document.getElementById("edit-harga").value = p.price;
                document.getElementById("edit-stok").value = p.stock;

                currentId = id;
                modal.classList.remove("hidden");
            }
        });

    const render = (data = productsData) => {
        grid.innerHTML = "";

        data.forEach(p => {
            grid.innerHTML += `
                <div class="product-card">
                    <img src="${p.image || "images/default.jpg"}">
                    
                    <span class="edit-btn" data-id="${p.id}">
                        <span class="mdi-light--pencil"></span>
                    </span>

                    <h3>${p.name}</h3>
                    <p>${getCategoryName(p.category)}</p>
                    <p class="stok">Stok: ${p.stock}</p>
                    <p>Rp ${p.price.toLocaleString()}</p>
                </div>`;
        });

        renderStat();
    };

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();

            const kode = document.getElementById("kode").value.trim();
            const nama = document.getElementById("nama").value.trim();
            const kategori = document.getElementById("kategori").value;
            const stok = Number(document.getElementById("stok").value);
            const harga = Number(document.getElementById("harga").value);  
            const tanggal = document.getElementById("tanggal").value;
            const file = document.getElementById("gambar").files[0];

            let imageURL = "images/default.jpg";

            if (file) {
                if (file && !file.type.startsWith("image/")) {
                    alert("File harus berupa gambar!");
                    return;
                }
                imageURL = URL.createObjectURL(file);
            }

            if (!kode || !nama || !kategori || !stok || !harga || !tanggal) {
                alert("Semua wajib diisi!");
                return;
            }

            if (isNaN(stok) || isNaN(harga)) {
                alert("Stok dan harga harus berupa angka!");
                return;
            }

            if (stok < 0) {
                alert("Stok tidak boleh negatif!");
                return;
            }

            if (harga <= 0) {
                alert("Harga harus lebih dari 0!");
                return;
            }

            productsData.push({
                id: Date.now(),
                kode,
                name: nama,
                category: kategori,
                stock: +stok,
                price: +harga,
                tanggal,
                image: imageURL
            });

            saveData();
            render();
            form.reset();
        });
    }

    document.getElementById("saveEdit").addEventListener("click", () => {

        if (!confirm("Yakin ingin menyimpan perubahan produk?")) {
            return;
        }

        const nama = document.getElementById("edit-nama").value;
        const harga = document.getElementById("edit-harga").value;
        const stok = document.getElementById("edit-stok").value;

        productsData[editIndex].name = nama;
        productsData[editIndex].price = Number(harga);
        productsData[editIndex].stock = Number(stok);

        saveData();
        render();

        document.getElementById("modal").classList.add("hidden");
    });

    document.getElementById("deleteBtn")?.addEventListener("click", () => {
        if (confirm("Hapus produk ini?")) {
            productsData = productsData.filter(p => p.id !== currentId);
            saveData();
            render();
            modal.classList.add("hidden");
        }
    });

    document.getElementById("closeModal")?.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    if (searchInput) {
        searchInput.addEventListener("input", () => {
            const keyword = searchInput.value.toLowerCase();

            const filtered = productsData.filter(p =>
                p.name.toLowerCase().includes(keyword) ||
                p.kode.toLowerCase().includes(keyword)
            );

            render(filtered);
        });
    }

    if (filter) {
        filter.addEventListener("change", () => {
            const val = filter.value;

            const filtered = val
                ? productsData.filter(p => p.category === val)
                : productsData;

            render(filtered);
        });
    }

    const renderStat = () => {
        const el = document.getElementById("statistik");
        if (!el) return;

        const total = productsData.length;
        const totalHarga = productsData.reduce((sum, p) => sum + p.price * p.stock, 0);
        const stokTipis = productsData.filter(p => p.stock < 5).length;

        el.innerHTML = `
            <div>
                <h4>Total Produk</h4>
                <p>${total}</p>
            </div>
            <div>
                <h4>Total Nilai</h4>
                <p>Rp ${totalHarga.toLocaleString()}</p>
            </div>
            <div>
                <h4>Stok Menipis</h4>
                <p>${stokTipis}</p>
            </div>
        `;
    };

    render();
}