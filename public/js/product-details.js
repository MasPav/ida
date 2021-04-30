$(function () {
    $("#product-gallery").lightGallery({
        autoplay: false,
        fullScreen: false,
        pager: false,
        zoom: false,
        hash: false,
        share: false,
        rotate: false,
        download: false,
    });
});

const onGoBack = () => {
    window.history.back();
};
