import {Controller , Application} from '@hotwired/stimulus'
import {Modal } from 'bootstrap'
export default class extends Controller {
    static values = {
        url: String,
    }
    connect(){
        console.log('heey111')
    }
    submitNewItemForm(event){
        let form = document.getElementById('modal-body1').getElementsByTagName('form')[0];
        let data = new URLSearchParams(new FormData(form));
        console.log()
        fetch('/shop/new/1' , {
            method: 'POST',
            body: new URLSearchParams(new FormData(form))
        }).then(function (response) {
            return response.text();
        }).then(function (json_data) {
            location.reload()
        })
    }

    openModal(event){
        let modal = document.getElementById('defaultModal1');
        let modalBody = document.getElementById('modal-body1');
        modal.classList.toggle('hidden');
        console.log(this.urlValue)
        fetch(this.urlValue , {
            method: 'POST',
            body: new URLSearchParams()
        }).then(function (response) {
            return response.text();
        }).then(function (json_data) {
            modalBody.innerHTML = json_data
        })

    }

    closeModal(event){
        let modal = document.getElementById('defaultModal1');
        modal.classList.add('hidden');
    }

}