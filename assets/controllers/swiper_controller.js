import Swiper, {Navigation, Pagination, Autoplay, EffectCoverflow, EffectFade } from 'swiper';

const swiper2 = new Swiper('.swiper.swiper-1', {
    modules: [Pagination, Navigation],
    // Optional parameters
    speed: 700,
    initialSlide: 0,
    slidesPerView: 3.6,
    spaceBetween: 10,
    grabCursor: true,

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    }
    // If we need pagination
});


const swiper5 = new Swiper('.swiper.swiper-2', {
    modules: [Pagination, Navigation],
    // Optional parameters
    speed: 700,
    initialSlide: 0,
    slidesPerView: 1,
    spaceBetween: 10,
    grabCursor: true,

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    }
    // If we need pagination
});

let swiper3 = new Swiper('.swiper-container', {
    modules: [Pagination, Navigation],
    // Optional parameters
    speed: 700,
    initialSlide: 0,
    slidesPerView: 4.2,
    spaceBetween: 10,
    grabCursor: true,

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    }
    // If we need pagination
});