<<<<<<< HEAD
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;
import {add, resta} from "./utils/math.js";

export  default function hola() {
=======
export default function hola() {
>>>>>>> 00608db (Canvis frontend curs 26/27)
    console.log('hola hola');
    const message = document.getElementById("missatge");

    if (message) {
        const paragraph = document.createElement("p");
        paragraph.textContent = "Text afegit amb JavaScript.";
        message.append(paragraph);
    }
}



export {add, resta};
