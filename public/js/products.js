$(function () {
    loadCurrentCategory();
});

const onSelectCategory = (category) => {
    setCurrentCategory(category);
    // toggle products loader
    toggleElements([
        {
            element: $(".products-loader"),
            show: true,
        },
        {
            element: $(".products-wrapper"),
            show: false,
        },
        {
            element: $(".no-products-msg"),
            show: false,
        },
    ]);
    // get products for selected category from API
    getProducts(category.id).then((res) => {
        if (res.length <= 0) {
            toggleElements([
                {
                    element: $(".products-loader"),
                    show: false,
                },
                {
                    element: $(".products-wrapper"),
                    show: false,
                },
                {
                    element: $(".no-products-msg"),
                    show: true,
                },
            ]);
            return;
        }
        updateProductsUI(res);
        toggleElements([
            {
                element: $(".products-loader"),
                show: false,
            },
            {
                element: $(".products-wrapper"),
                show: true,
            },
            {
                element: $(".no-products-msg"),
                show: false,
            },
        ]);
    });
};

const toggleElements = (items = []) => {
    items.forEach((item) => {
        item.show ? item.element.show() : item.element.hide();
    });
};

const getProducts = (categoryId = "") => {
    return new HttpClient().get("products/search", { category_id: categoryId });
};

const updateProductsUI = (products) => {
    $(".products-wrapper").empty();
    let updatedUI = ``;
    products.forEach((product) => {
        updatedUI += `<div class="col-12 col-md-6 col-lg-4">
                        <a href="${productDetailsUrl.replace(
                            "id",
                            product.id
                        )}">
                            <div class="card product-card">
                                <img src="${imagesUrl.concat(
                                    product.images[0]
                                )}" alt="Product image" class="img-fluid card-img-top">
                                <div class="card-body">
                                    <p>
                                        ${product.name}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>`;
    });
    $(".products-wrapper").append(updatedUI);
};

const setCurrentCategory = (category) => {
    $(".current-category-wrapper").find("h1").text(category.title);
    $(".current-category-wrapper").show();
    // set active category in list

    $(".sub-categories-list li")
        .addClass("active")
        .not($(`#categoryEl-${category.id}`))
        .removeClass("active");
    localStorage.setItem("currentCategory", JSON.stringify(category));
};

const loadCurrentCategory = () => {
    if (localStorage.getItem("currentCategory")) {
        const category = JSON.parse(localStorage.getItem("currentCategory"));
        onSelectCategory(category);
        // setCurrentCategory(category.categoryObj, category.categoryEl);
    }
};

class HttpClient {
    baseUrl = window.location.origin;

    get(path = "", params = "") {
        const url = new URL(this.baseUrl.concat(`/${path}`));
        url.search = new URLSearchParams(params);
        return this.makeRequest(url);
    }
    async makeRequest(url, params = "") {
        return await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        }).then((res) => {
            console.log(res);
            if (res.ok) {
                return res.json();
            }
            alert("an error occured");
        });
    }
}
