document.addEventListener('DOMContentLoaded', function() {

    const searchBtn = document.getElementById("searchBtn");
    const searchBox = document.getElementById("searchBox");
    const navSearch = document.getElementById("searchInput");
    const profileBtn = document.getElementById("profileBtn");
    const profileDropdown = document.getElementById("profileDropdown");

    if (searchBtn && searchBox) {
        searchBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            searchBox.classList.toggle("active");
            if(profileDropdown) profileDropdown.classList.remove("active");
        });
        searchBox.addEventListener("click", (e) => e.stopPropagation());
    }

    if (profileBtn && profileDropdown) {
        profileBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle("active");
            if(searchBox) searchBox.classList.remove("active");
        });
        profileDropdown.addEventListener("click", (e) => e.stopPropagation());
    }

    document.addEventListener("click", () => {
        if (searchBox) searchBox.classList.remove("active");
        if (profileDropdown) profileDropdown.classList.remove("active");
    });



    const pageSearch = document.getElementById('pageSearch');
    const filterCat = document.getElementById('filterKategori');
    const cards = document.querySelectorAll('.produk-card');


    if (cards.length > 0) {
        function filterProducts(searchQuery) {
            const query = searchQuery.toLowerCase();
            const category = filterCat ? filterCat.value : 'all';

            cards.forEach(card => {
                const nama = card.getAttribute('data-nama');
                const kode = card.getAttribute('data-kode');
                const cat = card.getAttribute('data-kategori');

                const matchesSearch = nama.includes(query) || kode.includes(query);
                const matchesCategory = category === 'all' || cat === category;

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        if (pageSearch) {
            pageSearch.addEventListener('input', (e) => {
                if(navSearch) navSearch.value = e.target.value;
                filterProducts(e.target.value);
            });
        }

        if (navSearch) {
            navSearch.addEventListener('input', (e) => {
                if(pageSearch) pageSearch.value = e.target.value;
                filterProducts(e.target.value);
            });
        }

        if (filterCat) {
            filterCat.addEventListener('change', () => {
                const currentSearch = pageSearch ? pageSearch.value : (navSearch ? navSearch.value : '');
                filterProducts(currentSearch);
            });
        }
    }
});
