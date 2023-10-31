
var categoryCheckboxes = document.querySelectorAll('.checkboxCategory');
var brandCheckboxes = document.querySelectorAll('.checkboxProducer');
var products = document.querySelectorAll('.productLayout');
var productsContainer = document.getElementById('productsContainer');


function sortProducts() {
        var sort = document.getElementById('sort');
        var selectedValue = sort.value;
        var productsArray = Array.from(productsContainer.children);
        console.log(productsArray)

        if (selectedValue === 'A-Z') {
                productsArray.sort(function(a, b) {
                        var productNameA = a.querySelector('.productName').textContent.toLowerCase();
                        var productNameB = b.querySelector('.productName').textContent.toLowerCase();
                        return productNameA.localeCompare(productNameB);
                });
        } else if (selectedValue === 'Z-A') {
                productsArray.sort(function(a, b) {
                        var productNameA = a.querySelector('.productName').textContent.toLowerCase();
                        var productNameB = b.querySelector('.productName').textContent.toLowerCase();
                        return productNameB.localeCompare(productNameA);
                });
        } else if (selectedValue === 'ascending') {
                productsArray.sort(function(a, b) {
                        var productPriceA = parseFloat(a.querySelector('.productPrice').textContent);
                        var productPriceB = parseFloat(b.querySelector('.productPrice').textContent);
                        return productPriceA - productPriceB;
                });
        } else if (selectedValue === 'descending') {
                productsArray.sort(function(a, b) {
                        var productPriceA = parseFloat(a.querySelector('.productPrice').textContent);
                        var productPriceB = parseFloat(b.querySelector('.productPrice').textContent);
                        return productPriceB - productPriceA;
                });
        }

        // TA PĘTLA USUWA WSZYTSKIE PRODUKTY Z HTML
        productsArray.forEach(function(product) {
                product.remove();
        });
        // TA PĘTLA DODAJE DO DIVA POSORTOWANE ELEMENTY
        productsArray.forEach(function(product) {
                productsContainer.appendChild(product);
        });
}
function filterProducts() {
        var selectedCategories = Array.from(categoryCheckboxes).filter(function(checkbox) {
                return checkbox.checked;
        }).map(function(checkbox) {
                return checkbox.value;
        });

        var selectedBrands = Array.from(brandCheckboxes).filter(function(checkbox) {
                return checkbox.checked;
        }).map(function(checkbox) {
                return checkbox.value;
        });

        products.forEach(function(product) {
                var categories = product.className.split(' ').filter(function(className) {
                        return className !== 'productLayout';
                });

                var isCategoryMatched = selectedCategories.length === 0 || selectedCategories.some(function(category) {
                        // console.log("Categories " + categories)
                        return categories.includes(category);
                });

                var isBrandMatched = selectedBrands.length === 0 || selectedBrands.some(function(brand) {
                        return categories.includes(brand);
                });

                if (isCategoryMatched && isBrandMatched) {
                        product.style.display = 'flex';
                } else {
                        product.style.display = 'none';
                }
        })
        sortProducts();
}
