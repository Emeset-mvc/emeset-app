<<<<<<< HEAD
<<<<<<< HEAD
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;
import {add, resta} from "./utils/math.js";

export  default function hola() {
=======
export default function hola() {
>>>>>>> 00608db (Canvis frontend curs 26/27)
    console.log('hola hola');
=======
import dayjs from "dayjs";
import "dayjs/locale/ca";

export default function hola() {
>>>>>>> cb0d78a (Canvis frontend curs 26/27 (2))
    const message = document.getElementById("missatge");

    if (message) {
        message.textContent = `Avui és ${dayjs().locale("ca").format("dddd, D MMMM YYYY")}.`;
    }
}



export {add, resta};
