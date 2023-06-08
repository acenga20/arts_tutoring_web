import { Controller} from "@hotwired/stimulus";

export default class extends Controller {
    static values = {
        // add identifier here
        identifier: 'news-cards',
    };

    connect() {

    }

    openAppropriateModal(event){
        let data = {}
        let modal_container = document.getElementById('modal');
        data['user_email'] = document.getElementById('user_email').value;
        fetch('/user/verify-user' , {
            method: 'POST',
            body: new URLSearchParams(data)
        }).then(function (response) {
            return response.json();
        }).then(function (json_data) {
            let parser = new DOMParser();
            let doc = parser.parseFromString(json_data.modal_view, 'text/html').body.innerHTML;
            modal_container.innerHTML = doc;
            modal_container.children[0].classList.toggle('hidden');
            document.getElementById('user_email').value = ''
        })
    }



}