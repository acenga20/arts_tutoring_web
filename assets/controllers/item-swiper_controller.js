import { Controller} from "@hotwired/stimulus";
import Swiper, {Navigation, Pagination, Autoplay, EffectCoverflow, EffectFade } from 'swiper';

export default class extends Controller {


    connect() {
    let swiper3 = new Swiper(this.element, {
        modules: [Pagination, Navigation],
        // Optional parameters
        speed: 700,
        initialSlide: 0,
        slidesPerView: 4,
        spaceBetween: 10,
        grabCursor: true,

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        }
        // If we need pagination
    });

    console.log(swiper3)
    }


}