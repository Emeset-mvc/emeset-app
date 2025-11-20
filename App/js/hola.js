import jQuery from "jquery";
window.$ = window.jQuery = jQuery;
import {add, resta} from "./utils/math.js";

export  default function hola() {
    console.log('hola hola');
}
console.log("Hola 2");

$("#missatge").append("<p>Text afegit amb jQuery.</p>");



export {add, resta};
