import {Controller , Application} from '@hotwired/stimulus'

export default class extends Controller {

    connect(){
        inputQuantity.value = 1
    }

    increaseQuantity(){
        let inputQuantity = document.getElementById('quantity-value')
        let maxValue = parseInt(inputQuantity.getAttribute('data-max'))
        let currentValue = parseInt(inputQuantity.innerHTML)
        if(currentValue < maxValue){
            inputQuantity.innerHTML = String(currentValue + 1)
        }

    }

    decreaseQuantity(){
        let inputQuantity = document.getElementById('quantity-value')
        let currentValue = parseInt(inputQuantity.innerHTML)
        if(currentValue > 1){
            inputQuantity.innerHTML = String(currentValue - 1)
        }
    }

}