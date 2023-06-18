import {Controller , Application} from '@hotwired/stimulus'

export default class extends Controller {

    connect(){

    }

    orderItem(){
        let inputQuantity = document.getElementById('quantity-value')
        let currentValue = parseInt(inputQuantity.innerHTML)
        console.log(currentValue)
    }

}