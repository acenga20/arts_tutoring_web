import { Controller} from "@hotwired/stimulus";
let container = document.getElementById('description-content')
export default class extends Controller {
    static values = {
        // add identifier here
        identifier: 'news-cards',
    };

    connect() {

    }


    renderDescInput(event){
        let container = document.getElementById('description-content')
        let button = document.getElementById('add_desc')
        let divElement = document.createElement('div')
        divElement.classList.add('flex')
        divElement.classList.add('flex-col')
        divElement.classList.add('space-y-2')
        divElement.classList.add('w-full')
        divElement.classList.add('items-center')
        let input = document.createElement('textarea')
        input.classList.add('w-full')
        input.classList.add('border-2')
        input.classList.add('border-black')
        input.classList.add('p-4')
        input.classList.add('rounded-2xl')
        input.setAttribute('id', 'desc-input')
        let submitButton = document.createElement('button')
        submitButton.innerHTML = "Save"
        submitButton.classList.add('px-4')
        submitButton.classList.add('py-1')
        submitButton.classList.add('bg-mint')
        submitButton.classList.add('rounded-2xl')
        submitButton.classList.add('w-fit')
        submitButton.setAttribute('data-action','click->user#submitDescription')
        divElement.append(input)
        divElement.append(submitButton)
        container.removeChild(button)
        container.append(divElement)
    }

    submitDescription(event){
        let inputValue = document.getElementById('desc-input').value
        let userID = document.getElementById('user-profile').getAttribute('data-user')
        let data = {
            'value' : inputValue
        }
        console.log(inputValue)
        fetch('/user/set-description/'+ userID , {
                method: 'POST',
                body: new URLSearchParams(data)
            }).then(function (response) {
                return response.json();
            }).then(function (json_data) {
            var parser = new DOMParser();
            var desc = parser.parseFromString(json_data.data, 'text/html').body.innerHTML;
            container.innerHTML = desc;

        });
    }

    deleteLecture(event){
        if (confirm("Do you really want to delete this lecture?!")) {
           let lectureId = event.target.getAttribute('data-lecture-id')
            let url = '/lectures/delete/' + lectureId
            fetch(url, {
                method: 'POST',
                body: new URLSearchParams()
            }).then(function (response) {
                return response.json();
            }).then(function (json_data) {
                location.reload()
            });
        } else {

        }
    }
    deleteItem(event){
        if (confirm("Do you really want to delete this item?!")) {
            let itemId = event.target.getAttribute('data-item-id')
            let url = '/shop/delete/' + itemId
            fetch(url, {
                method: 'POST',
                body: new URLSearchParams()
            }).then(function (response) {
                return response.json();
            }).then(function (json_data) {
                location.reload()
            });
        } else {

        }
    }


}