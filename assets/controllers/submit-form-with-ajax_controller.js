import { Controller} from "@hotwired/stimulus";

export default class extends Controller {
    static values = {
        // add identifier here
        identifier: 'news-cards',
    };

    connect() {

    }

    submitSignUp(event){
        alert('inside')
    }


}