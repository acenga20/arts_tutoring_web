import {Controller , Application} from '@hotwired/stimulus'
import {Modal } from 'bootstrap'
export default class extends Controller {
    static values = {
        url: String,
    }
    connect(){
        console.log('heey')
    }

    openModal(event){
        console.log(this.urlValue)
        let modal = document.getElementById('defaultModal');
        let modalBody = document.getElementById('modal-body');
        modal.classList.toggle('hidden');
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
        let modal = document.getElementById('defaultModal');
        modal.classList.add('hidden');
    }
}